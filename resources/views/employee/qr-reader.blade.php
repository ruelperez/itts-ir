@extends('components.layouts.main')

@section('content')
    @include('employee.dtr-data.employee-dtr')
@endsection
@push('js')
    <script src="{{ asset('js/qr_code.min.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        let isScanning = false; // Flag to prevent multiple requests

        function onScanSuccess(decodedText, decodedResult) {
            if (isScanning) return; // If already scanning, skip further scans
            isScanning = true;

            // Show loading indicator
            $("#loading").show();

            // Send the decoded QR code to the backend for verification
            $.ajax({
                url: "/verify-qr-code",
                type: "POST",
                dataType: "json",
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
                },
                data: { qrCode: decodedText },
                success: function(data) {
                    if (data.success) {
                        // Disable scanning while the alert is shown
                        isScanning = true;

                        Swal.fire({
                            title: 'Success!',
                            text: 'Press (ENTER) to start scan',
                            icon: 'success',
                            willClose: () => {
                                // Re-enable scanning after the alert is closed
                                isScanning = false;
                            }
                        }).then(() => {
                            const resultsDiv = $("#qr-reader-results");
                            resultsDiv.empty(); // Clear any previous results

                            // Loop through each `dtrData` record and display it
                            data.dtrData.forEach(record => {
                                const recordHtml = `
                    <tr class="dtr-record">
                        <td>${record.fullname}</td>
                        <td>${record.in ? formatTime(record.in) : ""}</td>
                        <td>${record.out}</td>
                        <td>${record.in2 ? formatTime(record.in2) : ""}</td>
                        <td>${record.out2}</td>
                    </tr>
                `;
                                resultsDiv.append(recordHtml);
                            });

                            // Hide loading indicator after processing
                            setTimeout(() => {
                                $("#loading").hide(); // Hide loading
                            }, 2000); // Hide after 2 seconds
                        });
                    } else {
                        alert("Invalid QR code");
                        // Re-enable scanning for invalid QR code
                        isScanning = false;
                    }
                },
                error: function() {
                    alert("An error occurred while processing the QR code.");
                    $("#loading").hide(); // Hide loading on error
                    isScanning = false; // Reset flag in case of error
                }
            });
        }

        function formatTime(dateString) {
            const date = new Date(dateString);
            // Get the hours and minutes
            let hours = date.getHours();
            const minutes = date.getMinutes().toString().padStart(2, '0'); // Pad minutes with leading zero
            // Determine AM or PM suffix
            const ampm = hours >= 12 ? 'pm' : 'am';
            // Convert hours from 24-hour format to 12-hour format
            hours = hours % 12;
            hours = hours ? hours : 12; // the hour '0' should be '12'
            // Return formatted time
            return `${hours}:${minutes} ${ampm}`;
        }

        // Initialize the QR code scanner
        var html5QrcodeScanner = new Html5QrcodeScanner("qr-reader", { fps: 10, qrbox: 250 });
        html5QrcodeScanner.render(onScanSuccess);
    </script>
@endpush
