@extends('layouts.dashboard')

@section('title')
    Data User
@endsection

@section('section-title')
    Data User
@endsection

@section('section-path')
    Data User
@endsection

@section('content')
<div class="row">
    <!-- 3rd row Start -->
    <div class="col-xl-12">
        <div class="card mb-4">
            <div class="card-header with-elements pb-0">
                <h6 class="card-header-title mb-2">List Data User</h6>

            </div>
            <div class="nav-tabs-top">
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="sale-stats">
                        <div style="height: 330px" id="tab-table-1">
                            <table class="table table-hover card-table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nama User</th>
                                        <th>Email</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                   
                                </tbody>
                            </table>
                            <!-- Pagination Links -->
                            <div> {{ $listPetugas->links() }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- 3rd row Start -->
</div>
@endsection