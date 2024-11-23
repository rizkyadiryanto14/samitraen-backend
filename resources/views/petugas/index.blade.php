@extends('layouts.dashboard')

@section('title')
    Data Petugas
@endsection

@section('section-title')
    Data Petugas
@endsection

@section('section-path')
    <li class="breadcrumb-item"><a href="/"><i class="feather icon-home"></i></a></li>
    <li class="breadcrumb-item active"><a href="#">Data Petugas</a></li>
@endsection

@section('content')
    @include('layouts.partials.notif')
    <div class="card mb-4">
        <div class="card-header with-elements pb-2">
            <h6 class="card-header-title mb-2">List Data Petugas</h6>
            <div class="card-header-elements ml-auto">
                <a href="{{ route('petugas.create') }}" type="button" class="btn btn-primary btn-md">Tambah Data</a>
            </div>
        </div>
        <div class="nav-tabs-top">
            <div class="tab-content">
                <div class="tab-pane fade show active" id="sale-stats">
                    <div style="height: 330px" id="tab-table-1" class="ps ps--active-x ps--active-y">
                        <table class="table table-hover card-table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nama Petugas</th>
                                    <th>Email</th>
                                    <th>Wilayah</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($listPetugas as $petugas)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $petugas->name }}</td>
                                        <td>{{ $petugas->email }}</td>
                                        <td>{{ $petugas->wilayah->nama_wilayah ?? '-' }}</td>
                                        <td><a href="{{ route('petugas.edit', $petugas->id) }}"
                                                class="btn btn-warning btn-sm">Edit</a>
                                            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                                data-target="#modal-edit-petugas-{{ $petugas->id }}">Delete</button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <!-- Pagination Links -->
                        {{ $listPetugas->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
