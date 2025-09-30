@extends('layout.app')
@section('title', 'Pengajuan Ijin')
@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Tabel Pengajuan</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama Lengkap</th>
                            <th>Pengajuan</th>
                            <th>Keterangan</th>
                            <th>Tanggal Mulai</th>
                            <th>Tanggal Selesai</th>
                            <th>Status</th>
                            <th width="10%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($request as $data)
                            <tr>
                                <td class="center-table wd-5">{{ $loop->iteration }}</td>
                                <td>{{ $data->user->nama_lengkap }}</td>
                                <td class="center-table">{{ $data->status }}</td>
                                <td>{{ $data->keterangan }}</td>
                                <td>{{ $data->tanggal_mulai->format('d F Y') }}</td>
                                <td>{{ $data->tanggal_selesai->format('d F Y') }}</td>
                                <td>{!! $data->is_approved_badge !!}</td>
                                <td class="center-table wd-5">
                                    <div class="dropdown">
                                        <button class="btn btn-sm btn-outline-primary dropdown-toggle" type="button"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                            {{ $data->is_approved !== 'menunggu' ? 'disabled' : '' }}>
                                            <i class="fas fa-cogs"></i>
                                        </button>
                                        @if($data->is_approved === 'menunggu')
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <form action="{{ route('request.approve', encrypt($data->id)) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="hidden" name="is_approved" value="disetujui">
                                                    <button type="submit" class="dropdown-item text-success">
                                                        <i class="fas fa-check me-1"></i> Setujui
                                                    </button>
                                                </form>
                                                <form action="{{ route('request.approve', encrypt($data->id)) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="hidden" name="is_approved" value="ditolak">
                                                    <button type="submit" class="dropdown-item text-danger">
                                                        <i class="fas fa-times me-1"></i> Tolak
                                                    </button>
                                                </form>
                                            </div>
                                        @endif
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
