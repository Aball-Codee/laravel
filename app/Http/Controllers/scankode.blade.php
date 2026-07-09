<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Barcode/QR Code Scanner</title>
    <!-- Library HTML5 QR Code dari modul -->
    <script src="https://unpkg.com/html5-qrcode@2.3.8/html5-qrcode.min.js"></script>
</head>
<body>
    <h1>Scan Barcode/QR Code (Praktikum 1)</h1>
    
    <!-- Tempat kamera akan muncul -->
    <div id="reader" style="width: 500px;"></div>
    
    <!-- Tempat hasil scan ditampilkan -->
    <div id="result"></div>

    <script>
        function onScanSuccess(decodedText, decodedResult) {
            // Tampilkan hasil scan di layar
            document.getElementById('result').innerText = "Scanned Code: " + decodedText;
            
            // Kirim data ke server (Laravel) via AJAX seperti di modul
            fetch('/scan', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ code: decodedText })
            })
            .then(response => response.json())
            .then(data => {
                // Tampilkan respon dari server di console log browser
                console.log("Server Response:", data);
            })
            .catch(error => console.error('Error: ', error));
        }

        // Inisialisasi kamera
        let html5QrcodeScanner = new Html5QrcodeScanner(
            "reader", { fps: 10, qrbox: 250 });
        html5QrcodeScanner.render(onScanSuccess);
    </script>
</body>
</html>