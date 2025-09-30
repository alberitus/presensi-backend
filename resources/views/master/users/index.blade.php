@extends('layout.app')
@section('title', 'Pegawai')
@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Tabel Pegawai</h6>
            <a href="{{ route('users.create') }}" class="btn btn-sm btn-primary">
                <i class="fas fa-plus"></i> Tambah Pegawai</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama Lengkap</th>
                            <th>NIK</th>
                            <th>Bagian</th>
                            <th>Status</th>
                            <th>Tanggal Masuk</th>
                            <th>Posisi</th>
                            <th width="10%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $data)
                            <tr>
                                <td class="center-table wd-5">{{ $loop->iteration }}</td>
                                <td>{{ $data->nama_lengkap }}</td>
                                <td class="center-table">{{ $data->nik }}</td>
                                <td>{{ $data->division }}</td>
                                <td>{{ $data->status_karyawan }}</td>
                                <td>{{ $data->tanggal_masuk->format('d F Y') }}</td>
                                <td>{{ $data->role }}</td>
                                <td class="center-table wd-5">
                                    <div class="dropdown">
                                        <button class="btn btn-sm btn-outline-primary dropdown-toggle" type="button"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-cogs"></i>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a class="dropdown-item"
                                                href="{{ route('users.edit', Crypt::encrypt($data->id)) }}">
                                                <i class="fas fa-edit me-1"></i> Edit
                                            </a>
                                            
                                            <form action="{{ route('users.destroy', Crypt::encrypt($data->id)) }}"
                                                method="POST" class="delete-form d-inline">
                                                @csrf
                                                @method('DELETE')
                                                @if (auth()->id() !== $data->id)
                                                    <button type="button" class="dropdown-item btn-delete text-danger"
                                                        data-id="{{ $data->id }}">
                                                        <i class="fas fa-trash me-1"></i> Delete
                                                    </button>
                                                @endif
                                            </form>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
