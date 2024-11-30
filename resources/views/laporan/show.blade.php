@extends('layouts.dashboard')

@section('title')
    Detail Laporan
@endsection

@section('section-title')
    Detail Laporan
@endsection

@section('section-path')
    <li class="breadcrumb-item"><a href="/"><i class="feather icon-home"></i></a></li>
    <li class="breadcrumb-item active"><a href="/laporan">Data Laporan</a></li>
    <li class="breadcrumb-item active"><a href="#">Detail</a></li>
@endsection

@section('css')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
@endsection

@section('content')
    <div class="row">
        <!-- 1st row Start -->
        <div class="col-lg-12">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card d-flex w-100 mb-4">
                        <div class="row no-gutters row-bordered row-border-light h-100">
                            <div class="d-flex col-md-6 align-items-center">
                                <div class="card-body">
                                    <div class="row align-items-center mb-3">
                                        <div class="col-auto">
                                            <i class="lnr lnr-users text-primary display-4"></i>
                                        </div>
                                        <div class="col">
                                            <h6 class="mb-0 text-muted">Tanggal Lapor</h6>
                                            <h4 class="mt-3 mb-0">{{ $laporan->created_at->format('d M Y H:i') }}</h4>
                                        </div>
                                    </div>
                                    <p class="mb-0 text-muted">{{ $laporan->created_at->diffForHumans() }}</p>
                                </div>
                            </div>
                            <div class="d-flex col-md-6 align-items-center">
                                <div class="card-body">
                                    <div class="row align-items-center mb-3">
                                        <div class="col-auto">
                                            <i class="lnr lnr-magic-wand text-primary display-4"></i>
                                        </div>
                                        <div class="col">
                                            <h6 class="mb-0 text-muted">Status Laporan</h6>
                                            <h4 class="mt-3 mb-0">{{ $laporan->label_status }}</h4>
                                        </div>
                                    </div>
                                    <p class="mb-0 text-muted">Last Update :
                                        {{ $laporan->last_update_status->diffForHumans() }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-5">
                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="d-flex align-items-center justify-content-between">
                                <div class="">
                                    <h5 class="mb-2">Data Pelapor</h5>
                                    <p class="text-muted mb-0"><i class="lnr lnr-user"></i> {{ $laporan->user->name }}</p>
                                    <p class="text-muted mb-0"><i class="lnr lnr-phone"></i> {{ $laporan->no_hp ?? '-' }}
                                    </p>
                                    <p class="text-muted mb-0"><i class="lnr lnr-map"></i>
                                        {{ $laporan->wilayah->nama_wilayah }}</p>
                                    <br>

                                    <h5 class="mb-2">Unit Petugas</h5>
                                    <p class="text-muted mb-0"><i class="feather icon-shield"></i>
                                        {{ $laporan->unit->nama_unit ?? 'Unit Belum Dipilih' }}</p>
                                    <br>

                                    <h5 class="mb-2">Deskripsi Laporan (<a href="#" data-toggle="modal"
                                            data-target="#modal-bukti-foto"> Lihat Bukti Foto </a>)</h5>
                                    <p class="text-muted mb-0" style="max-width: 90%">{{ $laporan->deskripsi_laporan }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-7">
                    <div class="card mb-4">
                        <div class="card-body" style="y-overflow: auto">
                            <div id="map"></div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <!-- 1st row Start -->
    </div>

    <div class="modal fade" id="modal-bukti-foto" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Bukti Foto</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <img src="{{ asset('storage/' . $laporan->foto_bukti) }}" style="width: 100%">
                </div>

            </div>
        </div>
    </div>
@endsection
@section('js')
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

    <script>
        var map = L.map('map').setView([-8.96725, 117.19954], 18);

        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
        }).addTo(map);

        // Menambahkan marker pada peta
        var latlngs = @json(json_decode($laporan->polylines))

        // Menambahkan polyline ke peta
        var polyline = L.polyline(latlngs, {
            color: 'red'
        }).addTo(map);

        // Menambahkan marker pertama 
        var marker1 = L.marker(latlngs[0]).addTo(map);
        marker1.bindPopup({!! json_encode($laporan->wilayah->nama_wilayah) !!});

        // Menambahkan marker kedua
        var marker2 = L.marker(latlngs[latlngs.length - 1]).addTo(map);
        marker2.bindPopup("Lokasi Kebakaran");

        // Menambahkan zoom ke polyline
        map.fitBounds(polyline.getBounds());
    </script>
@endsection
