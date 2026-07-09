<!DOCTYPE html>
<html>
<head>
    <title>Upload File - Tugas Modul 8</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">Form Upload Gambar</div>
            <div class="card-body">
                
                <!-- Pesan Sukses/Error -->
                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                @if($errors->any())
                    <div class="alert alert-danger">{{ $errors->first() }}</div>
                @endif

                <!-- Form Upload (WAJIB ada enctype dan @csrf) -->
                <form action="{{ route('upload.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label>Pilih Gambar (JPG, PNG, max 2MB)</label>
                        <input type="file" name="file" class="form-control">
                    </div>
                    <button type="submit" class="btn btn-primary">Upload</button>
                    <a href="{{ route('files.list') }}" class="btn btn-secondary">Lihat Daftar File</a>
                </form>

            </div>
        </div>
    </div>
</body>
</html>