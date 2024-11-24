@extends('layouts.dashboard')

@section('title')
    Edit Data Unit Pemadam
@endsection

@section('section-title')
    Edit Data Unit Pemadam
@endsection

@section('section-path')
    <li class="breadcrumb-item"><a href="/"><i class="feather icon-home"></i></a></li>
    <li class="breadcrumb-item active"><a href="/unit">Data Unit Pemadam</a></li>
    <li class="breadcrumb-item active"><a href="#">Edit Data</a></li>
@endsection

@section('content')
    @include('layouts.partials.notif')
    <div class="card mb-4">
        <h6 class="card-header">Edit Data Unit Pemadam</h6>
        <div class="card-body">
            <form action="/unit/{{ $unit->id }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label class="form-label">Wilayah</label>
                    <select class="form-control" name="wilayah_id" required>
                        @foreach ($wilayah as $w)
                            <option value="{{ $w->id }}" {{ $w->id == $unit->wilayah_id ? 'selected' : '' }}>{{ $w->nama_wilayah }}</option>
                        @endforeach
                    </select>
                    <div class="clearfix"></div>
                </div>
                <div class="form-group">
                    <label class="form-label">Nama Unit</label>
                    <input type="text" class="form-control" placeholder="Nama Unit" name="nama_unit" required value="{{ $unit->nama_unit }}">
                    <div class="clearfix"></div>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
@endsection
