@extends('layout.app')
@section('title', 'Attendance History')

@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Attendance Table</h6>

            <form action="{{ route('attendance.filter') }}" method="GET" class="form-inline">
                <div class="form-group mx-2">
                    <label for="start_date" class="mr-2">Start:</label>
                    <input type="date" name="start_date" id="start_date"
                        value="{{ request('start_date', now()->toDateString()) }}" class="form-control form-control-sm">
                </div>

                <div class="form-group mx-2">
                    <label for="end_date" class="mr-2">End:</label>
                    <input type="date" name="end_date" id="end_date"
                        value="{{ request('end_date', now()->toDateString()) }}" class="form-control form-control-sm">
                </div>

                <button type="submit" class="btn btn-primary btn-sm">
                    <i class="fas fa-filter"></i> Filter
                </button>
                <a href="{{ route('attendance.index') }}" class="btn btn-secondary btn-sm ml-2">
                    Reset
                </a>
            </form>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama Lengkap</th>
                            <th>Nik</th>
                            <th>Tanggal</th>
                            <th>Jam Masuk</th>
                            <th>Jam Pulang</th>
                            <th>Lokasi Masuk</th>
                            <th>Lokasi Pulang</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($attendance as $data)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $data->user->nama_lengkap }}</td>
                                <td>{{ $data->user->nik }}</td>
                                <td>{{ $data->tanggal->format('d-m-Y') }}</td>
                                <td>{{ $data->jam_masuk }}</td>
                                <td>{{ $data->jam_keluar }}</td>
                                <td>
                                    <a href="{{ $data->lokasi_masuk_map_url }}" target="_blank">
                                        {{ $data->lokasi_masuk }}
                                    </a>
                                </td>
                                <td>
                                    <a href="{{ $data->lokasi_keluar_map_url }}" target="_blank">
                                        {{ $data->lokasi_keluar }}
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
