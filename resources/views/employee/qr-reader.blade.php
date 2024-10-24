@extends('components.layouts.main')

@section('content')
    <div id="qr-reader" style="width: 500px; border: solid black 2px; height: 500px;"></div>
    <div id="qr-reader-results"></div>
@endsection
@push('js')
    <script src="{{asset('js/qr_code.min.js')}}"></script>
    <script>
        function onScanSuccess(decodedText, decodedResult) {
            // Handle the result here
            console.log(`Code scanned = ${decodedText}`, decodedResult);

            // Send the decoded QR code to the backend for verification
            fetch("/verify-qr-code", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({ qrCode: decodedText })
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert("Time-in successful");
                    } else {
                        alert("Invalid QR code");
                    }
                });
        }

        var html5QrcodeScanner = new Html5QrcodeScanner("qr-reader", { fps: 10, qrbox: 250 });
        html5QrcodeScanner.render(onScanSuccess);
    </script>
@endpush
