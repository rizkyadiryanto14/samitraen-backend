@extends('layouts.dashboard')

@section('title')
    Edit Data Petugas
@endsection

@section('section-title')
    Edit Data Petugas
@endsection

@section('section-path')
    <li class="breadcrumb-item"><a href="/"><i class="feather icon-home"></i></a></li>
    <li class="breadcrumb-item active"><a href="/petugas">Data Petugas</a></li>
    <li class="breadcrumb-item active"><a href="#">Edit Data</a></li>
@endsection

@section('content')
    @include('layouts.partials.notif')
    <div class="card mb-4">
        <h6 class="card-header">Edit Data Petugas</h6>
        <div class="card-body">
            <form action="/petugas/{{ $petugas->id }}" method="POST" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="form-group">
                    <label class="form-label">Wilayah</label>
                    <select class="form-control" name="wilayah_id" required>
                        @foreach ($wilayah as $w)
                            <option value="{{ $w->id }}" {{ $w->id == $petugas->wilayah_id ? 'selected' : '' }}>{{ $w->nama_wilayah }}</option>
                        @endforeach
                    </select>
                    <div class="clearfix"></div>
                </div>
                <div class="form-group">
                    <label class="form-label">Nama</label>
                    <input name="name" type="text" class="form-control" placeholder="Nama Lengkap" required value="{{ $petugas->name }}">
                    <div class="clearfix"></div>
                </div>
                <div class="form-group">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" placeholder="Email" required value="{{ $petugas->email }}">
                    <div class="clearfix"></div>
                </div>
                <div class="form-group">
                    <label class="form-label w-100">Foto Profile</label>
                    <input type="file" name="foto_profil" accept="image/*">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
@endsection
