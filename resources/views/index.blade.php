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
            <div class="card mb-4">
                <div class="card-header with-elements pb-0">
                    <h6 class="card-header-title mb-2">Laporan Terbaru</h6>

                </div>
                <div class="nav-tabs-top">
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="sale-stats">
                            <div style="height: 330px" id="tab-table-1">
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
                                            <tr></tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $laporan->user->name }}</td>
                                            <td>{{ $laporan->deskripsi_laporan }}</td>
                                            <td>{{ $laporan->created_at->diffForHumans() }}</td>
                                            <td>{{ $laporan->label_status }}</td>
                                            <td><a href="/laporan/{{ $laporan->id }}" class="btn btn-primary">Detail</a>"
                                            </td>
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
