@extends('components.layouts.main')

@section('content')
    <audio id="successSound" src="{{ asset('sounds/dtr_success.wav') }}" preload="auto"></audio>
    <audio id="errorSound" src="{{ asset('sounds/dtr_error.wav') }}" preload="auto"></audio>
    @include('employee.dtr-data.employee-dtr')
@endsection

@push('js')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        let isProcessing = false; // Flag to prevent multiple requests

        // Function to handle QR code scanning from the scanner device
        $(document).ready(function() {
            $("#scannerInput").on("keypress", function(event) {console.log('haha');
                if (event.which === 13) { // Enter key pressed
                    event.preventDefault(); // Prevent form submission
                    const qrCode = $(this).val().trim();
                    if (qrCode && !isProcessing) {
                        isProcessing = true; // Prevent further input processing
                        processQRCode(qrCode); // Call function to process QR code
                        $(this).val(''); // Clear the input field
                    }
                }
            });
        });

        function processQRCode(qrCode) {
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

        function handleScanResponse(data) {
            if (data.success) {
                document.getElementById('successSound').play();
                const resultsDiv = $("#qr-reader-results");
                resultsDiv.empty(); // Clear previous results

                // Loop through each `dtrData` record and display it
                data.dtrData.forEach(record => {
                    const recordHtml = `
                        <tr class="dtr-record">
                            <td>${record.fullname}</td>
                            <td>${record.in ? formatTime(record.in) : ""}</td>
                            <td>${record.out ? formatTime(record.out) : ""}</td>
                            <td>${record.in2 ? formatTime(record.in2) : ""}</td>
                            <td>${record.out2 ? formatTime(record.out2) : ""}</td>
                        </tr>
                    `;
                    resultsDiv.append(recordHtml);
                });

                // Show SweetAlert after updating the table data
                Swal.fire({
                    title: 'Success!',
                    text: 'Press (ENTER) to scan another QR code',
                    icon: 'success',
                    willClose: () => {
                        isProcessing = false; // Re-enable processing after the alert is closed
                    }
                });
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
                    isProcessing = false; // Re-enable processing after the alert is closed
                }
            });
        }

        function formatTime(dateString) {
            const date = new Date(dateString);
            let hours = date.getHours();
            const minutes = date.getMinutes().toString().padStart(2, '0');
            const ampm = hours >= 12 ? 'pm' : 'am';
            hours = hours % 12;
            hours = hours ? hours : 12; // the hour '0' should be '12'
            return `${hours}:${minutes} ${ampm}`;
        }

        function updateClock() {
            const now = new Date();

            // Get the date parts
            const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
            const formattedDate = now.toLocaleDateString('en-US', options);

            // Get the time parts
            const hours = now.getHours();
            const minutes = now.getMinutes();
            const seconds = now.getSeconds();

            // Format time to display in hh:mm:ss AM/PM
            const formattedTime = `${formatTime(hours)}:${formatTime(minutes)}:${formatTime(seconds)} ${hours >= 12 ? 'PM' : 'AM'}`;

            // Display both date and time
            document.getElementById('clock').innerText = `${formattedDate} | ${formattedTime}`;
        }

        function formatTime(num) {
            return num < 10 ? '0' + num : num; // Pad single digit with zero
        }

        // Initialize clock
        setInterval(updateClock, 1000);
        updateClock(); // Call once to set initial time

        // Search functionality
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

