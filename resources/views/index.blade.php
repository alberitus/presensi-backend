@extends('layout.app')
@section('title', 'Attendance System - Dashboard')

@section('content')
    <!-- Statistics Section -->
    <div class="mb-4">
        <div class="row">
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary-gradient stats-card h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-uppercase mb-1" style="color: #667eea;">
                                    Total Presensi</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $user }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-box fa-2x icon-gradient-primary"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success-gradient stats-card h-100 py-2" data-toggle="modal"
                    data-target="#barangMasukModal" style="cursor:pointer;">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-uppercase mb-1" style="color: #43e97b;">
                                    Total Pegawai
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $attendanceToday }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-arrow-down fa-2x icon-gradient-success"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-info-gradient stats-card h-100 py-2" data-toggle="modal"
                    data-target="#barangKeluarModal" style="cursor:pointer;">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-uppercase mb-1" style="color: #4facfe;">
                                    Pengajuan Ijin (Bulanan)</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $requestThisMonth }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-arrow-up fa-2x icon-gradient-info"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-warning-gradient stats-card h-100 py-2" data-toggle="modal"
                    data-target="#barangMinModal" style="cursor:pointer;">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-uppercase mb-1" style="color: #fa709a;">
                                    Empty</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">0</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-exclamation-triangle fa-2x icon-gradient-warning"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
