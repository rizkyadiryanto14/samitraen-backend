@extends('layouts.dashboard')

@section('title')
    Data Laporan
@endsection

@section('section-title')
    Data Laporan
@endsection

@section('section-path')
    Data Laporan
@endsection

@section('content')
    <div class="row">
        <!-- 3rd row Start -->
        <div class="col-xl-12">
            <div class="card mb-4">
                <div class="card-header with-elements pb-0">
                    <h6 class="card-header-title mb-2">List Data Laporan</h6>

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
                                        @foreach ($listLaporan as $laporan)
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
                                <!-- Pagination Links -->
                                {{ $listLaporan->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- 3rd row Start -->
    </div>
@endsection
