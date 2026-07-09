<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File; // Tambahkan ini

class FileUploadController extends Controller
{
    // 1. Tampilkan Form Upload
    public function showUploadForm()
    {
        return view('upload');
    }

    // 2. Proses Upload
    public function storeFile(Request $request)
    {
        // Validasi
        $request->validate([
            'file' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $file = $request->file('file');
        
        // Simpan langsung ke folder public/uploads
        // Buat nama file unik agar tidak bentrok
        $filename = time() . '_' . $file->getClientOriginalName();
        
        // Pindahkan file ke C:\xampp\htdocs\nama_projek\public\uploads
        $file->move(public_path('uploads'), $filename);

        return redirect()->route('files.list')->with('success', 'File berhasil diupload!');
    }

    // 3. Tampilkan Daftar File
    public function listFiles()
    {
        // Ambil daftar file dari folder public/uploads
        // Gunakan File::files agar mendapatkan path lengkap
        $files = File::files(public_path('uploads'));
        
        return view('file_list', compact('files'));
    }

    // 4. Hapus File
    public function deleteFile($filename)
    {
        // Hapus file dari folder public/uploads
        $filePath = public_path('uploads/' . $filename);
        
        if (file_exists($filePath)) {
            unlink($filePath); // Menghapus file fisik
        }
        
        return redirect()->route('files.list')->with('success', 'File berhasil dihapus!');
    }
}