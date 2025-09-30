@extends('layout.app')
@section('title', 'Tambah Akun')
@section('content')
<!-- Breadcrumb -->
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{ route('index') }}">
                <i class="fas fa-home"></i>
            </a>
        </li>
        <li class="breadcrumb-item">
            <a href="{{ route('home.master') }}">
                <i class="fas fa-database"></i> Master
            </a>
        </li>
        <li class="breadcrumb-item active" aria-current="page">
            <a href="{{ route('pengguna.index') }}">Data Akun</a>
        </li>
        <li class="breadcrumb-item active" aria-current="page">
            <a>Tambah Akun</a>
        </li>
    </ol>
</nav>
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Form Tambah Akun</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('pengguna.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="name">Username</label>
                                <input type="text" name="name" class="form-control"
                                    placeholder="Username" required>
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control"
                                    name="password" placeholder="Password Akun" required>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="name">Email</label>
                                <input type="email" name="email" class="form-control"
                                    placeholder="Email" required>
                            </div>
                            <div class="form-group">
                                <label for="password_confirmation">Password</label>
                                <input type="password" class="form-control"
                                    name="password_confirmation" placeholder="Password Akun" required>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="role">Role</label>
                                <select name="role" id="role" class="form-control select2">
                                    <option value="">Pilih Role</option>
                                    @IT
                                    <option value="1">IT</option>
                                    @endIT
                                    <option value="3">User</option>
                                    <option value="2">Admin</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="d-grid gap-3 d-md-flex justify-content-md-end">
                        <button class="btn btn-primary" type="submit">
                            <i class="fas fa-save"></i> Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
