@extends('components.layouts.main')
@section('content')
    <audio id="successSound" src="{{ asset('sounds/dtr_success.wav') }}" preload="auto"></audio>
    <audio id="errorSound" src="{{ asset('sounds/dtr_error.wav') }}" preload="auto"></audio>
    @include('employee.dtr-data.employee-dtr')

    @push('js')
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script>
            let isProcessing = false; // Flag to prevent multiple requests
            let canScan = true; // Flag to enable/disable scanning
            let lastScanTime = null; // Store the time of the last scan
            let lastScannedId = null; // Store the last scanned Employee ID
            const photoBaseUrl = "{{ asset('photos/photos') }}/"; // Base URL for employee photos
            const countdownDuration = 1; // Countdown duration in seconds

            $(document).ready(function() {
                focusScannerInput();

                $("#scannerInput").on("keypress", function(event) {
                    if (event.which === 13) { // Enter key pressed
                        event.preventDefault(); // Prevent form submission
                        const qrCode = $(this).val().trim();
                        if (qrCode && canScan && !isProcessing) {
                            isProcessing = true;
                            processQRCode(qrCode);
                        }
                    }
                }).on("input", function() {
                    $(this).val($(this).val().toUpperCase()); // Convert input to uppercase on input
                });
            });

            function processQRCode(qrCode) {
                const now = new Date();

                // Check if the scanned ID matches the last one and if 60 seconds have passed
                if (qrCode === lastScannedId && lastScanTime && (now - lastScanTime < 60000)) {
                    document.getElementById('errorSound').play();
                    Swal.fire({
                        title: 'Error',
                        text: 'Same Employee ID. Please wait 60 seconds before rescanning.',
                        icon: 'error',
                        willClose: () => {
                            canScan = true;
                            isProcessing = false;
                            $("#scannerInput").val(''); // Clear input
                            focusScannerInput(); // Refocus
                        }
                    });
                } else {
                    // Proceed with scanning and store the current ID and time
                    lastScannedId = qrCode;
                    lastScanTime = now;

                    $.ajax({
                        url: "/verify-qr-code",
                        type: "POST",
                        dataType: "json",
                        headers: {
                            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
                        },
                        data: { qrCode: qrCode },
                        success: function(data) {
                            handleScanResponse(data);
                        },
                        error: function(jqXHR) {
                            handleErrorResponse(jqXHR);
                        }
                    });

                }
            }

            function showCountdownAlert(seconds) {
                let countdownValue = seconds;
                Swal.fire({
                    title: 'Please Wait',
                    icon: 'success',
                    showConfirmButton: false,
                    html: `<strong id="countdown" style="font-size: 35px">${countdownValue}</strong>`,
                    timer: seconds * 1000,
                    timerProgressBar: true,
                    didOpen: () => {
                        const countdownInterval = setInterval(() => {
                            countdownValue--;
                            $("#countdown").text(countdownValue);
                            if (countdownValue <= 0) {
                                clearInterval(countdownInterval);
                                Swal.close(); // Close alert after countdown
                                canScan = true; // Re-enable scanning
                                isProcessing = false; // Reset processing flag
                                $("#scannerInput").val(''); // Clear input
                                focusScannerInput(); // Refocus on the input field
                            }
                        }, 1000);
                    },
                    willClose: () => {
                        isProcessing = false; // Reset processing flag
                        $("#scannerInput").val(''); // Clear input
                        canScan = true; // Re-enable scanning
                        focusScannerInput(); // Refocus input for next scan
                    }
                });
            }

            function handleScanResponse(data) {
                if (data.success) {
                    // Disable scanning for the countdown duration
                    canScan = false;
                    showCountdownAlert(countdownDuration);
                    document.getElementById('successSound').play();
                    const resultsDiv = $("#qr-reader-results");
                    resultsDiv.empty(); // Clear existing results first

                    // Sort and display data
                    const sortedData = data.dtrData.sort((a, b) => new Date(b.updated_at) - new Date(a.updated_at));
                    sortedData.forEach(record => {
                        const earlyOutBadge = record.isEarlyOut === 1
                            ? `<b style="color: white; background-color: red;" class="px-2">Early out</b>`
                            : "";

                        const adjustedBadge = record.is_edited === 1
                            ? `<b style="color: blue" class="fst-italic">(Adjusted)</b>`
                            : "";

                        const recordHtml = `
        <tr class="dtr-record">
            <td>${record.fullname}</td>
            <td>${record.in ? formatTime(record.in) : ""}</td>
            <td>${record.out ? formatTime(record.out) : ""}</td>
            <td>${record.in2 ? formatTime(record.in2) : ""}</td>
            <td>${record.out2 ? formatTime(record.out2) : ""}</td>
            <td>${earlyOutBadge} ${adjustedBadge}</td>
        </tr>
    `;
                        resultsDiv.append(recordHtml);
                    });

                    // Set photo for the latest scanned employee
                    const latestEmployee = sortedData[0]; // Get the latest scanned employee
                    const employeePhotoUrl = photoBaseUrl + latestEmployee.photo; // Construct full path using `photo`
                    $('#employeePhoto').attr('src', employeePhotoUrl); // Update the employee photo display
                    $('#employeeFullName').text(latestEmployee.fullname); // Update the employee full name display
                    $('#headCount').text(sortedData.length); // Update the employee full name display
                    isProcessing = false; // Reset processing flag
                    $("#scannerInput").val(''); // Clear input
                    focusScannerInput(); // Refocus on the input field



                } else {
                    showErrorAlert('Report error to IT/Development Team for troubleshooting and resolution.');
                }
            }

            function handleErrorResponse(jqXHR) {
                const errorMessage = jqXHR.responseJSON && jqXHR.responseJSON.message
                    ? jqXHR.responseJSON.message
                    : 'An unexpected error occurred.';
                showErrorAlert(errorMessage);
            }

            function showErrorAlert(message) {
                document.getElementById('errorSound').play();
                Swal.fire({
                    title: 'Failed',
                    text: message,
                    icon: 'error',
                    willClose: () => {
                        isProcessing = false; // Reset processing flag
                        $("#scannerInput").val('');
                        focusScannerInput();
                    }
                });
            }

            function formatTime(dateString) {
                const date = new Date(dateString);
                let hours = date.getHours();
                const minutes = date.getMinutes().toString().padStart(2, '0');
                const ampm = hours >= 12 ? 'pm' : 'am';
                hours = hours % 12 || 12;
                return `${hours}:${minutes} ${ampm}`;
            }

            function focusScannerInput() {
                $("#scannerInput").focus();
            }

            function updatePhilippineTime() {
                const options = { timeZone: 'Asia/Manila', hour12: true, hour: 'numeric', minute: 'numeric', year: 'numeric', month: 'numeric', day: 'numeric' };
                const now = new Date().toLocaleString('en-US', options);
                document.getElementById('philippine-time').textContent = now;
            }

            setInterval(updatePhilippineTime, 1000);

            $(document).ready(function() {
                $("#searchInput").on("keyup", function() {
                    let value = $(this).val().toLowerCase();
                    $("#qr-reader-results tr").filter(function() {
                        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
                    });
                });
            });
        </script>
    @endpush
@endsection
