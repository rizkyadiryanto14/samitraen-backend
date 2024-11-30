@extends('layouts.dashboard')

@section('title')
    Edit Data Wilayah
@endsection

@section('section-title')
    Edit Data Wilayah
@endsection

@section('css')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
@endsection

@section('section-path')
    <li class="breadcrumb-item"><a href="/"><i class="feather icon-home"></i></a></li>
    <li class="breadcrumb-item active"><a href="/wilayah">Data Wilayah</a></li>
    <li class="breadcrumb-item active"><a href="#">Edit Data</a></li>
@endsection

@section('content')
    @include('layouts.partials.notif')
    <div class="card mb-4">
        <h6 class="card-header">Edit Data Wilayah</h6>
        <div class="card-body">
            <form action="/wilayah/{{ $wilayah->id }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label class="form-label">Nama</label>
                    <input type="text" name="nama_wilayah" class="form-control" placeholder="Nama Wilayah" value="{{ $wilayah->nama_wilayah }}" required>
                    <div class="clearfix"></div>
                </div>
                <div class="form-group">
                    <label class="form-label">Lokasi</label>
                    <div id="map"></div>
                    <input type="hidden" name="latitude" id="latitude" value="{{ $wilayah->latitude }}">
                    <input type="hidden" name="longitude" id="longitude" value="{{ $wilayah->longitude }}">
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
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
        var marker;

        marker = L.marker([{{ $wilayah->latitude }}, {{ $wilayah->longitude }}]).addTo(map);
        map.on('click', function(e) {
            // Menghapus marker yang sudah ada (jika ada)
            if (marker) {
                map.removeLayer(marker);
            }

            // Menambahkan marker di lokasi yang diklik
            marker = L.marker(e.latlng).addTo(map);

            // Mendapatkan latitude dan longitude
            var latitude = e.latlng.lat;
            var longitude = e.latlng.lng;

            // Menyimpan nilai latitude dan longitude
            document.getElementById('latitude').value = latitude;
            document.getElementById('longitude').value = longitude;

            // Menampilkan latitude dan longitude
            console.log("Latitude: " + latitude + ", Longitude: " + longitude);
            // Anda bisa menyimpan nilai ini ke dalam input tersembunyi atau melakukan aksi lain
        });
    </script>
@endsection
