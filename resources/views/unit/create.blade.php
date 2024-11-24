@extends('layouts.dashboard')

@section('title')
    Tambah Data Unit Pemadam
@endsection

@section('section-title')
    Tambah Data Unit Pemadam
@endsection

@section('section-path')
    <li class="breadcrumb-item"><a href="/"><i class="feather icon-home"></i></a></li>
    <li class="breadcrumb-item active"><a href="/unit">Data Unit Pemadam</a></li>
    <li class="breadcrumb-item active"><a href="#">Tambah Data</a></li>
@endsection

@section('content')
    @include('layouts.partials.notif')
    <div class="card mb-4">
        <h6 class="card-header">Tambah Data Unit Pemadam</h6>
        <div class="card-body">
            <form action="/unit" method="POST">
                @csrf
                <div class="form-group">
                    <label class="form-label">Wilayah</label>
                    <select class="form-control" name="wilayah_id" required>
                        @foreach ($wilayah as $w)
                            <option value="{{ $w->id }}">{{ $w->nama_wilayah }}</option>
                        @endforeach
                    </select>
                    <div class="clearfix"></div>
                </div>
                <div class="form-group">
                    <label class="form-label">Nama Unit</label>
                    <input type="text" class="form-control" placeholder="Nama Unit" name="nama_unit" required>
                    <div class="clearfix"></div>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
@endsection
