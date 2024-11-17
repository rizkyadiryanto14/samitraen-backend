@extends('layouts.dashboard')

@section('title')
    Data Petugas
@endsection

@section('section-title')
    Data Petugas
@endsection

@section('section-path')
    Data Petugas
@endsection

@section('content')
<div class="row">
    <!-- 3rd row Start -->
    <div class="col-xl-12">
        <div class="card mb-4">
            <div class="card-header with-elements pb-0">
                <h6 class="card-header-title mb-2">List Data Petugas</h6>

            </div>
            <div class="nav-tabs-top">
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="sale-stats">
                        <div style="height: 330px" id="tab-table-1">
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
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <!-- Pagination Links -->
                            {{!! $listPetugas->withQueryString()->links() !!}}
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- 3rd row Start -->
</div>
@endsection