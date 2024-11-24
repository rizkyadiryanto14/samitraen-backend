@extends('layouts.dashboard')

@section('title')
    Data Unit Pemadam
@endsection

@section('section-title')
    Data Unit Pemadam
@endsection

@section('section-path')
    <li class="breadcrumb-item"><a href="/"><i class="feather icon-home"></i></a></li>
    <li class="breadcrumb-item active"><a href="#">Data Unit Pemadam</a></li>
@endsection

@section('content')
    @include('layouts.partials.notif')
    <div class="card mb-4">
        <div class="card-header with-elements pb-2">
            <h6 class="card-header-title mb-2">List Data Unit Pemadam</h6>
            <div class="card-header-elements ml-auto">
                <a href="{{ route('unit.create') }}" type="button" class="btn btn-primary btn-md">Tambah Data</a>
            </div>
        </div>
        <div class="nav-tabs-top">
            <div class="tab-content">
                <div class="tab-pane fade show active" id="sale-stats">
                    <div style="height: 330px" id="tab-table-1">
                        <table class="table table-hover card-table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nama Unit</th>
                                    <th>Wilayah</th>
                                    <th>Status</th>
                                    <th>Jumlah Laporan Ditangani</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($listUnit as $unit)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $unit->nama_unit }}</td>
                                        <td>{{ $unit->wilayah->nama_wilayah ?? '-' }}</td>
                                        <td>{!! $unit->status == 1
                                            ? '<span class="badge badge-success">Tersedia</span>'
                                            : '<span class="badge badge-danger">Sedang Beroperasi</span>' !!}</td>
                                        <td>{{ $unit->laporan_kebakaran->count() }}</td>
                                        <td>
                                            <a href="{{ route('unit.edit', $unit->id) }}"
                                                class="btn btn-warning btn-sm">Edit</a>
                                            <button type="button" class="btn btn-danger btn-sm deleteUnit"
                                                data-toggle="modal" data-target="#modal-delete-unit"
                                                data-id="{{ $unit->id }}">Delete</button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                         <!-- Pagination Links -->
                         {{ $listUnit->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-delete-petugas" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Delete Petugas</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <p>Apakah anda yakin ingin menghapus petugas ini?</p>
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
    <script>
        $('.deleteUnit').on('click', function() {
            $('#modal-delete-unit form').attr('action', 'unit/' + $(this).data('id'));
        });

        $('#modal-delete-unit').on('hidden.bs.modal', function() {
            $('#modal-delete-wilayah form').attr('action', '');
        });
    </script>
@endsection
