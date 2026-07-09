@extends('layouts.app')

@section('content')

<div class="container">

    <div class="row justify-content-center">

        <div class="col-md-8">

            <div class="card">

                <div class="card-header">
                    Dashboard
                </div>

                <div class="card-body">

                    {{-- Pesan Berhasil --}}
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    {{-- Pesan Error --}}
                    @if(session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                    <h3>Selamat Datang</h3>

                    <p>
                        Anda berhasil login ke sistem.
                    </p>

                    <table class="table table-bordered">

                        <tr>
                            <th width="30%">Nama</th>
                            <td>{{ auth()->user()->name }}</td>
                        </tr>

                        <tr>
                            <th>Email</th>
                            <td>{{ auth()->user()->email }}</td>
                        </tr>

                        <tr>
                            <th>Role</th>
                            <td>{{ auth()->user()->role }}</td>
                        </tr>

                        <tr>
                            <th>Usia</th>
                            <td>{{ auth()->user()->usia }} Tahun</td>
                        </tr>

                    </table>

                    {{-- BAGIAN INI SUDAH DIPERBAIKI MENJADI FORM POST --}}
                    <form action="{{ route('logout') }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-danger">
                            Logout
                        </button>
                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection