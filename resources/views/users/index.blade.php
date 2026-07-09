@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1>Data Users</h1>
        <a href="{{ route('users.create') }}" class="btn btn-primary">Tambah User</a>
    </div>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Level</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->level }}</td>
                <td>
                    {{-- KITA GUNAKAN DATA-ID, BUKAN ONCLICK LANGSUNG --}}
                    <button class="btn btn-danger btn-sm delete-btn" data-id="{{ $user->id }}">Hapus</button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    // Tangani klik tombol hapus menggunakan event listener
    document.addEventListener('click', function(e) {
        if (e.target.classList.contains('delete-btn')) {
            const userId = e.target.getAttribute('data-id');
            confirmDelete(userId);
        }
    });

    function confirmDelete(userId) {
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Data user ini akan dihapus permanen!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                fetch(`/users/${userId}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                })
                .then(response => {
                    location.reload();
                    Swal.fire('Terhapus!', 'User telah dihapus.', 'success');
                    showConfirmButton: true
                }).then(() => {
                        location.reload();
                })
                .catch(error => {
                    Swal.fire('Gagal!', 'Terjadi kesalahan.', 'error');
                });
            }
        });
    }
</script>
@endsection