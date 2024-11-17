@extends('layouts.dashboard')

@section('title')
    Data Wilayah
@endsection

@section('section-title')
    Data Wilayah
@endsection

@section('section-path')
    Data Wilayah
@endsection

@section('content')
<div class="row">
    <!-- 3rd row Start -->
    <div class="col-xl-12">
        <div class="card mb-4">
            <div class="card-header with-elements pb-0">
                <h6 class="card-header-title mb-2">List Data Wilayah</h6>

            </div>
            <div class="nav-tabs-top">
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="sale-stats">
                        <div style="height: 330px" id="tab-table-1">
                            <table class="table table-hover card-table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nama Wilayah</th>
                                        <th>Jumlah Unit</th>
                                        <th>Jumlah Laporan</th>
                                        <th>Lokasi</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                   
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- 3rd row Start -->
</div>
@endsection