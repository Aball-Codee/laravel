<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
// Hapus dulu import DataTables karena kita pakai Solusi 1 (data langsung)
// use Yajra\DataTables\Facades\DataTables; 

class UserController extends Controller
{
    // Tugas 1 & 3: Tampilkan halaman user beserta datanya
    public function index(Request $request)
    {
        // Ambil semua data user dari database
        $users = User::all();

        // Kirim data users ke view menggunakan compact()
        return view('users.index', compact('users'));
    }

    public function create()
    {
        return view('users.create');
    }

    // Tugas 2: Notifikasi Sukses setelah Create
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users',
            'level' => 'required',
            'password' => 'required|min:8',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'level' => $request->level,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('users.index')->with('success', 'User created successfully.');
    }

    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    // Tugas 2: Notifikasi Sukses setelah Update
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'level' => 'required',
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'level' => $request->level,
            'password' => $request->password ? Hash::make($request->password) : $user->password,
        ]);

        return redirect()->route('users.index')->with('success', 'User updated successfully.');
    }

    // Tugas 2: Konfirmasi Hapus dengan SweetAlert (via AJAX di View)
    public function destroy(User $user)
    {
        $user->delete();
        return response()->json(['success' => true]);
    }
}