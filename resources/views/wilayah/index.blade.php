@extends('layouts.dashboard')

@section('title')
    Data Wilayah
@endsection

@section('section-title')
    Data Wilayah
@endsection

@section('section-path')
    <li class="breadcrumb-item"><a href="/"><i class="feather icon-home"></i></a></li>
    <li class="breadcrumb-item active"><a href="#">Data Wilayah</a></li>
@endsection

@section('css')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
@endsection

@section('content')
    @include('layouts.partials.notif')
    <div class="card mb-4">
        <div class="card-header with-elements pb-2">
            <h6 class="card-header-title mb-2">List Data Wilayah</h6>
            <div class="card-header-elements ml-auto">
                <a href="{{ route('wilayah.create') }}" type="button" class="btn btn-primary btn-md">Tambah Data</a>
            </div>
        </div>
        <div class="nav-tabs-top">
            <div class="tab-content">
                <div class="tab-pane fade show active" id="sale-stats">
                    <div  id="tab-table-1" class="ps ps--active-x ps--active-y">
                        <table class="table table-hover card-table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nama Wilayah</th>
                                    <th>Jumlah Unit</th>
                                    <th>Jumlah Laporan</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($listWilayah as $wilayah)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $wilayah->nama_wilayah }}</td>
                                        <td>{{ $wilayah->units->count() }}</td>
                                        <td>{{ $wilayah->laporan_kebakaran->count() }}</td>
                                        <td><button type="button" class="btn btn-success btn-sm showMap"
                                                data-toggle="modal" data-target="#mapModal"
                                                data-latitude="{{ $wilayah->latitude }}"
                                                data-longitude="{{ $wilayah->longitude }}">Lihat Lokasi</button>
                                            <a href="{{ route('wilayah.edit', $wilayah->id) }}"
                                                class="btn btn-warning btn-sm">Edit</a>
                                            <button type="button" class="btn btn-danger btn-sm deleteWilayah" data-toggle="modal"
                                                data-target="#modal-delete-wilayah" data-id="{{ $wilayah->id }}">Delete</button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <!-- Pagination Links -->
                        {{ $listWilayah->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="mapModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Detail Lokasi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="loading">Loading map...</div>
                    <div id="map" style="display: none"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-delete-wilayah" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Delete Wilayah</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <p>Apakah anda yakin ingin menghapus wilayah ini?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <form action="" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-primary">Delete</button>
                    </form>
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
        $('.showMap').on('click', function() {
            addMarker($(this).data('latitude'), $(this).data('longitude'));
            map.invalidateSize();
            setTimeout(function() {
                $('#loading').hide(); // Sembunyikan loading
                $('#map').show(); // Tampilkan peta dengan efek fade in
            }, 2000); // 2000 milidetik = 2 detik
        });

        // Array untuk menyimpan marker
        let markers = [];

        // Fungsi untuk menambahkan marker
        function addMarker(lat, lng) {
            // Hapus marker yang ada
            clearMarkers();

            // Buat marker baru
            const marker = L.marker([lat, lng]).addTo(map);
            markers.push(marker);
        }

        // Fungsi untuk menghapus marker
        function clearMarkers() {
            markers.forEach(marker => {
                map.removeLayer(marker);
            });
            markers = []; // Kosongkan array marker
        }

        $('#mapModal').on('hidden.bs.modal', function() {
            $('#loading').show();
            $('#map').hide();
        });

        $('.deleteWilayah').on('click', function() {
            $('#modal-delete-wilayah form').attr('action', 'wilayah/' +$(this).data('id'));
        });

        $('#modal-delete-wilayah').on('hidden.bs.modal', function() {
            $('#modal-delete-wilayah form').attr('action', '');
        });
    </script>
@endsection
