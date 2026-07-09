<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Praktikum 1 - Scan QR/Barcode</title>
    <!-- Tambahkan Bootstrap agar rapi -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Library HTML5 QR Code -->
    <script src="https://unpkg.com/html5-qrcode@2.3.8/html5-qrcode.min.js"></script>
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow">
                    <div class="card-header bg-primary text-white text-center">
                        <h3>Praktikum 1: Scan QR / Barcode</h3>
                    </div>
                    <div class="card-body text-center">
                        
                        <!-- Tempat kamera akan muncul -->
                        <div id="reader" style="width: 100%; max-width: 500px; margin: 0 auto;"></div>
                        
                        <!-- Tempat hasil scan ditampilkan -->
                        <div id="result" class="mt-3 fw-bold text-success"></div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function onScanSuccess(decodedText, decodedResult) {
            // Tampilkan hasil scan di layar
            document.getElementById('result').innerText = "Berhasil Scan: " + decodedText;
        }

        // Inisialisasi kamera
        let html5QrcodeScanner = new Html5QrcodeScanner(
            "reader", { fps: 10, qrbox: 250 });
        html5QrcodeScanner.render(onScanSuccess);
    </script>
</body>
</html>