@extends('layout.app')
@section('title', 'Ubah Akun')
@section('content')
@php
$roles = auth()->user();
@endphp
<!-- Breadcrumb -->
@IT
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
            <a>Ubah Akun</a>
        </li>
    </ol>
</nav>
@else
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
            <a>Data Profil</a>
        </li>
    </ol>
</nav>
@endIT
<!-- Content Row -->
<div class="row">
    <div class="col-lg-4">
        <!-- Overflow Hidden -->
        <div class="card mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Profil Akun</h6>
            </div>
            <div class="card-body text-center">
                <i class="far fa-id-card  fa-3x text-primary mb-3"></i>

                <h5 class="card-title">{{ ucwords($user->name) }}</h5>
                <p class="card-text">{{ $user->email }}</p>

                <p class="card-text">
                    <span class="badge badge-info">
                        {{ auth()->user()?->roleName() }}
                    </span>
                </p>

                <small class="text-muted">
                    Ditambahkan pada: {{ $user->created_at->translatedFormat('d F Y') }}
                </small>
            </div>
        </div>
        @IT
        <div class="card mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Reset Kata Sandi</h6>
            </div>
            <div class="card-body text-center">
                <section class="space-y-2">
                    <header>
                        <h2 class="text-lg font-medium text-gray-900">
                            Reset Kata Sandi Akun
                        </h2>
                        <p class="mt-1 text-sm text-gray-600">
                            Kata Sandi akan direset ke <strong>password</strong> default:
                            <code>gudanglion{{ date('my') }}</code>.
                        </p>
                    </header>
                    <form action="{{ route('pengguna.reset', Crypt::encrypt($user->id)) }}" method="post">
                        @csrf
                        <button type="submit" class="btn btn-warning">
                            Reset Kata Sandi
                        </button>
                    </form>
                </section>
            </div>
        </div>
        @endIT
    </div>
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Form Ubah Data Akun</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('pengguna.update', Crypt::encrypt($user->id)) }}" method="POST">
                    @csrf
                    @method('patch')
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="name">Username</label>
                                <input type="text" name="name" class="form-control"
                                    value="{{ old('name', $user->name) }}" required autofocus>
                            </div>
                            @if($roles && ($roles->isIT()))
                            <div class="form-group">
                                <label for="role">Role</label>
                                <select name="role" id="role" class="form-control select2">
                                    <option value="">Pilih Role</option>
                                    <option value="3" {{ $user->role == 3 ? 'selected' : '' }}> User</option>
                                    <option value="2" {{ $user->role == 2 ? 'selected' : '' }}>Admin</option>
                                    @if($user->isIT())
                                    <option value="1" {{ $user->role == 1 ? 'selected' : '' }}>IT</option>
                                    @endif
                                </select>
                            </div>
                            @endif
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="name">Email</label>
                                <input type="email" name="email" class="form-control"
                                    value="{{ old('email', $user->email) }}" required>
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
        <div class="card mt-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Form Kata Sandi Akun</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('pengguna.password', Crypt::encrypt($user->id)) }}" method="POST">
                    @csrf
                    @method('put')
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="current_password">Current Password</label>
                                <input type="password" class="form-control" id="current_password"
                                    name="current_password" autocomplete="current-password">
                            </div>

                            <div class="form-group">
                                <label for="password">New Password</label>
                                <input type="password" class="form-control" id="password" name="password"
                                    autocomplete="password">
                            </div>

                            <div class="form-group">
                                <label for="password_confirmation">Confirm Password</label>
                                <input type="password" class="form-control" id="password_confirmation"
                                    name="password_confirmation" autocomplete="new-password">
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
