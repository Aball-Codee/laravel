<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Scan Barcode Produk</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Library QR Scanner -->
    <script src="https://unpkg.com/html5-qrcode@2.3.8/html5-qrcode.min.js"></script>
    <style>
        body { background-color: #f8f9fa; padding-top: 50px; font-family: 'Segoe UI', sans-serif; }
        .main-card { border: none; border-radius: 15px; box-shadow: 0 10px 30px rgba(0,0,0,0.08); }
        .card-header { background: linear-gradient(135deg, #0d6efd 0%, #0a58ca 100%); color: white; border-radius: 15px 15px 0 0 !important; padding: 20px 25px; font-weight: 600; }
        .product-img { width: 100%; max-height: 200px; object-fit: contain; border: 1px solid #e9ecef; border-radius: 10px; padding: 10px; background-color: white; margin-top: 5px; }
        .qr-img { max-width: 100px; height: auto; border: 1px solid #ddd; border-radius: 8px; padding: 5px; margin-top: 5px; background: white; }
        .table thead th { background-color: #f1f3f5; font-weight: 600; color: #495057; }
        .custom-kbd { background-color: #e9ecef; color: #0d6efd; font-weight: 700; border: 1px solid #0d6efd; padding: 2px 8px; border-radius: 4px; font-size: 0.85em; font-family: inherit; }
        .scanner-box { border: 2px dashed #0d6efd; border-radius: 10px; padding: 10px; background: #f8faff; display: none; margin-bottom: 15px; }
        .detail-card { background-color: #ffffff; border: 1px solid #e9ecef; border-radius: 10px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-11">
                <div class="card main-card">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col-md-8">
                                <h4 class="m-0"><i class="bi bi-upc-scan"></i> Scan / Input Barcode Produk & QR</h4>
                            </div>
                        </div>
                    </div>
                    <div class="card-body p-4">
                        <div class="row g-4">
                            <!-- Bagian Kiri: Input & Tabel -->
                            <div class="col-md-7">
                                <div class="mb-3">
                                    <label for="barcodeInput" class="form-label fw-bold">Masukkan Kode SKU / Scan QR</label>
                                    <div class="input-group">
                                        <input type="text" id="barcodeInput" class="form-control form-control-lg" placeholder="Contoh: ASUS-001" autofocus>
                                        <button class="btn btn-outline-primary" type="button" id="btnOpenScanner">
                                            <i class="bi bi-qr-code-scan"></i> Scan QR
                                        </button>
                                    </div>
                                    <div class="form-text mt-2">Tekan <span class="custom-kbd">Enter</span> atau klik <b>Scan QR</b>.</div>
                                </div>
                                
                                <!-- Kotak Scanner Kamera (Akan muncul saat tombol ditekan) -->
                                <div class="scanner-box" id="scannerBox">
                                    <div id="reader" style="width: 100%;"></div>
                                    <button class="btn btn-danger btn-sm mt-2" id="btnCloseScanner">Tutup Scanner</button>
                                </div>

                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover align-middle">
                                        <thead class="table-light">
                                            <tr><th>Nama</th><th>SKU</th><th>Harga</th><th>Qty</th><th>Total</th></tr>
                                        </thead>
                                        <tbody id="cartTableBody"></tbody>
                                        <tfoot class="table-group-divider fw-bold">
                                            <tr><td colspan="4" class="text-end">Total Akhir:</td><td id="sumTotal">Rp 0</td></tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>

                            <!-- Bagian Kanan: Detail Produk & QR -->
                            <div class="col-md-5">
                                <div class="card detail-card shadow-sm h-100">
                                    <div class="card-body text-center">
                                        <h5 class="card-title fw-bold text-primary border-bottom pb-2 mb-3">Detail & QR Produk</h5>
                                        
                                        <div class="mb-3">
                                            <img id="productImage" src="" class="product-img" alt="Gambar Produk" style="display:none;">
                                        </div>
                                        
                                        <div class="text-start">
                                            <p class="mb-1"><strong>Nama:</strong> <span id="productName" class="text-secondary fw-normal">-</span></p>
                                            <p class="mb-1"><strong>SKU:</strong> <span id="productSku" class="text-secondary fw-normal">-</span></p>
                                            <p class="mb-0"><strong>Harga:</strong> <span id="productPrice" class="text-secondary fw-normal">-</span></p>
                                        </div>

                                        <!-- Bagian QR Code (Hanya muncul jika produk ditemukan) -->
                                        <div id="qrSection" style="display: none; margin-top: 15px; border-top: 1px solid #eee; padding-top: 15px;">
                                            <h6 class="text-primary fw-bold">QR Code Produk</h6>
                                            <img id="qrImage" class="qr-img" src="" alt="QR Code">
                                            <div class="mt-2">
                                                <a id="downloadQrBtn" href="#" download="qr-code.png" class="btn btn-sm btn-success">
                                                    <i class="bi bi-download"></i> Download QR
                                                </a>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        let cart = [];
        let html5QrcodeScanner = null;

        // --- LOGIKA SCANNER KAMERA ---
        document.getElementById('btnOpenScanner').addEventListener('click', function() {
            const box = document.getElementById('scannerBox');
            box.style.display = 'block';
            
            if (!html5QrcodeScanner) {
                html5QrcodeScanner = new Html5QrcodeScanner("reader", { fps: 10, qrbox: 250 });
                html5QrcodeScanner.render(onScanSuccess);
            }
        });

        document.getElementById('btnCloseScanner').addEventListener('click', function() {
            const box = document.getElementById('scannerBox');
            box.style.display = 'none';
            if (html5QrcodeScanner) {
                html5QrcodeScanner.clear();
                html5QrcodeScanner = null;
            }
        });

        function onScanSuccess(decodedText, decodedResult) {
            // Saat QR berhasil di-scan, masukkan kodenya ke input, lalu tutup scanner
            document.getElementById('barcodeInput').value = decodedText;
            document.getElementById('btnCloseScanner').click(); // Tutup scanner
            triggerSearch(decodedText); // Langsung cari produk
        }

        // --- LOGIKA INPUT MANUAL ---
        document.getElementById('barcodeInput').addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                const code = this.value.trim();
                if(code === '') return;
                triggerSearch(code);
            }
        });

        function triggerSearch(code) {
            fetch('/scan-produk', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ code: code })
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    const p = data.product;
                    
                    document.getElementById('productName').innerText = p.name;
                    document.getElementById('productSku').innerText = p.sku;
                    document.getElementById('productPrice').innerText = 'Rp ' + p.price;
                    
                    const imgEl = document.getElementById('productImage');
                    if (p.image) {
                        imgEl.src = '/uploads/' + p.image.replace('uploads/', '');
                        imgEl.style.display = 'block';
                    } else {
                        imgEl.style.display = 'none';
                    }

                    // Generate QR Code
                    const qrSection = document.getElementById('qrSection');
                    const qrImg = document.getElementById('qrImage');
                    const downloadBtn = document.getElementById('downloadQrBtn');
                    
                    const qrUrl = `https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=${encodeURIComponent(p.sku)}`;
                    qrImg.src = qrUrl;
                    downloadBtn.href = qrUrl;
                    qrSection.style.display = 'block';

                    // Tambah ke Cart
                    cart.push({ name: p.name, sku: p.sku, price: p.price, qty: 1 });
                    updateTable();
                    document.getElementById('barcodeInput').value = ''; 
                } else {
                    alert(data.message);
                    document.getElementById('qrSection').style.display = 'none';
                }
            })
            .catch(err => console.error(err));
        }

        function updateTable() {
            let html = '';
            let total = 0;
            cart.forEach(item => {
                total += item.price * item.qty;
                html += `<tr>
                            <td>${item.name}</td>
                            <td>${item.sku}</td>
                            <td>Rp ${item.price.toLocaleString()}</td>
                            <td>${item.qty}</td>
                            <td>Rp ${(item.price * item.qty).toLocaleString()}</td>
                        </tr>`;
            });
            document.getElementById('cartTableBody').innerHTML = html;
            document.getElementById('sumTotal').innerText = 'Rp ' + total.toLocaleString();
        }
    </script>
</body>
</html>