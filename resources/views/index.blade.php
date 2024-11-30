@extends('layouts.dashboard')

@section('title')
    Dashboard
@endsection

@section('section-title')
    Dashboard
@endsection

@section('section-path')
    Dashboard
@endsection

@section('content')
    <div class="row">
        <!-- 1st row Start -->
        <div class="col-lg-12">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card d-flex w-100 mb-4">
                        <div class="row no-gutters row-bordered row-border-light h-100">
                            <div class="d-flex col-md-3 align-items-center">
                                <div class="card-body">
                                    <div class="row align-items-center mb-3">
                                        <div class="col-auto">
                                            <i class="feather icon-file-text text-primary display-4"></i>
                                        </div>
                                        <div class="col">
                                            <h6 class="mb-0 text-muted">Jumlah <span class="text-primary">Laporan
                                                    Diterima</span>
                                            </h6>
                                            <h4 class="mt-3 mb-0">{{ $laporanCount }}</h4>
                                        </div>
                                    </div>
                                    <p class="mb-0 text-muted"><a href="/laporan">Lihat Data</a></p>
                                </div>
                            </div>
                            <div class="d-flex col-md-3 align-items-center">
                                <div class="card-body">
                                    <div class="row align-items-center mb-3">
                                        <div class="col-auto">
                                            <i class="feather icon-map text-primary display-4"></i>
                                        </div>
                                        <div class="col">
                                            <h6 class="mb-0 text-muted">Jumlah <span class="text-primary">Wilayah</span>
                                            </h6>
                                            <h4 class="mt-3 mb-0">{{ $wilayahCount }}</h4>
                                        </div>
                                    </div>
                                    <p class="mb-0 text-muted"><a href="/wilayah">Lihat Data</a></p>
                                </div>
                            </div>
                            <div class="d-flex col-md-3 align-items-center">
                                <div class="card-body">
                                    <div class="row align-items-center mb-3">
                                        <div class="col-auto">
                                            <i class="feather icon-shield text-primary display-4"></i>
                                        </div>
                                        <div class="col">
                                            <h6 class="mb-0 text-muted">Jumlah <span class="text-primary">Unit</span>
                                            </h6>
                                            <h4 class="mt-3 mb-0">{{ $unitCount }}</h4>
                                        </div>
                                    </div>
                                    <p class="mb-0 text-muted"><a href="/unit">Lihat Data</a></p>
                                </div>
                            </div>
                            <div class="d-flex col-md-3 align-items-center">
                                <div class="card-body">
                                    <div class="row align-items-center mb-3">
                                        <div class="col-auto">
                                            <i class="feather icon-users text-primary display-4"></i>
                                        </div>
                                        <div class="col">
                                            <h6 class="mb-0 text-muted">Jumlah <span class="text-primary">Petugas</span>
                                            </h6>
                                            <h4 class="mt-3 mb-0">{{ $petugasCount }}</h4>
                                        </div>
                                    </div>
                                    <p class="mb-0 text-muted"><a href="/petugas">Lihat Data</a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- 1st row Start -->
    </div>

    <div class="row">
        <!-- 3rd row Start -->
        <div class="col-xl-12">
            <div class="card mb-4" style="overflow: auto">
                <div class="card-header with-elements pb-0">
                    <h6 class="card-header-title mb-0">Laporan Terbaru</h6>
                    <div class="card-header-elements ml-auto p-0">

                    </div>
                </div>
                <div class="nav-tabs-top">
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="sale-stats">
                            <div  id="tab-table-1">
                                <table class="table table-hover card-table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Pelapor</th>
                                            <th>Deskripsi</th>
                                            <th>Waktu Lapor</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($latestLaporan as $laporan)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>
                                                    <div class="media mb-0">
                                                        <img src="{{ $laporan->user->foto_profil ? asset('storage/'.$laporan->user->foto_profil) : asset('assets/img/avatars/blank.png') }}"
                                                            class="d-block ui-w-40 rounded-circle" alt="">
                                                        <div class="media-body align-self-center ml-3">
                                                            <h6 class="mb-0">{{ $laporan->user->name }}</h6>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <p style="margin-top: 10px">{{ $laporan->deskripsi_laporan }}
                                                    </p>
                                                </td>
                                                <td>
                                                    <div class="d-inline-block align-middle">
                                                        <h6 class="mb-1">{{ $laporan->created_at->format('d M Y H:i') }}
                                                        </h6>
                                                        <p class="text-muted mb-0">
                                                            {{ $laporan->created_at->diffForHumans() }}</p>
                                                    </div>
                                                </td>
                                                <td>
                                                    <p style="margin-top: 10px">
                                                        @if ($laporan->status_laporan == 'received')
                                                            <span class="badge badge-primary">
                                                                Laporan Diterima
                                                            </span>
                                                        @elseif ($laporan->status_laporan == 'in_progress')
                                                            <span class="badge badge-warning">
                                                                Laporan Diproses
                                                            </span>
                                                        @elseif ($laporan->status_laporan == 'dispatched')
                                                            <span class="badge badge-info">
                                                                Petugas Dikirim
                                                            </span>
                                                            @elseif ($laporan->status_laporan == 'completed')
                                                            <span class="badge badge-success">
                                                                Laporan Selesai
                                                            </span>
                                                        @endif
                                                    </p>
                                                </td>
                                                <td><a href="/laporan/{{ $laporan->id }}"
                                                        class="btn btn-primary">Detail</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- 3rd row Start -->
    </div>
@endsection
