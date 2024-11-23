@extends('layouts.dashboard')

@section('title')
    Tambah Data Petugas
@endsection

@section('section-title')
    Tambah Data Petugas
@endsection

@section('section-path')
    <li class="breadcrumb-item"><a href="/"><i class="feather icon-home"></i></a></li>
    <li class="breadcrumb-item active"><a href="/petugas">Data Petugas</a></li>
    <li class="breadcrumb-item active"><a href="#">Tambah Data</a></li>
@endsection

@section('content')
    <div class="card mb-4">
        <h6 class="card-header">Tambah Data Petugas</h6>
        <div class="card-body">
            <form>
                <div class="form-group">
                    <label class="form-label">Wilayah</label>
                    <select class="form-control" required>
                        <option value="1">Wilayah 1</option>
                        <option value="2">Wilayah 2</option>
                    </select>
                    <div class="clearfix"></div>
                </div>
                <div class="form-group">
                    <label class="form-label">Nama</label>
                    <input type="text" class="form-control" placeholder="Nama Lengkap" required>
                    <div class="clearfix"></div>
                </div>
                <div class="form-group">
                    <label class="form-label">Email</label>
                    <input type="email" class="form-control" placeholder="Email" required>
                    <div class="clearfix"></div>
                </div>
                <div class="form-group">
                    <label class="form-label">Password</label>
                    <input type="password" class="form-control" placeholder="Password" required>
                    <div class="clearfix"></div>
                </div>
                <div class="form-group">
                    <label class="form-label w-100">Foto Profile</label>
                    <input type="file">
                    <small class="form-text text-muted">Example block-level help text here.</small>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
@endsection
