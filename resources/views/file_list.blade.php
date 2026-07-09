<!DOCTYPE html>
<html>
<head>
    <title>Daftar File</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .card-img-top { height: 200px; object-fit: cover; }
    </style>
</head>
<body>
    <div class="container mt-5">
        <div class="card">
            <div class="card-header bg-primary text-white">Daftar File yang Diupload</div>
            <div class="card-body">
                
                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <a href="{{ route('upload.form') }}" class="btn btn-primary mb-3">Upload File Baru</a>

                <div class="row">
                    @forelse($files as $file)
                        <div class="col-md-4 mb-4">
                            <div class="card h-100">
                                
                                {{-- AMBIL GAMBAR DARI URL PUBLIC LANGSUNG --}}
                                {{-- Karena kita pindahkan ke folder public, kita bisa akses lewat asset() --}}
                                <img src="{{ asset('uploads/' . $file->getFilename()) }}" class="card-img-top" alt="Gambar">
                                
                                <div class="card-body">
                                    <p class="card-text text-truncate">{{ $file->getFilename() }}</p>
                                    
                                    <div class="d-flex justify-content-between">
                                        
                                        {{-- TOMBOL DOWNLOAD --}}
                                        <a href="{{ asset('uploads/' . $file->getFilename()) }}" download class="btn btn-success btn-sm flex-grow-1 mr-1">
                                            Download
                                        </a>

                                        {{-- TOMBOL HAPUS --}}
                                        <form action="{{ route('files.delete', $file->getFilename()) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12 text-center">Belum ada file yang diupload.</div>
                    @endforelse
                </div>

            </div>
        </div>
    </div>
</body>
</html>