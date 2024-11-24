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
    @include('layouts.partials.notif')
    <div class="card mb-4">
        <div class="card-header with-elements pb-2">
            <h6 class="card-header-title mb-2">List Data User</h6>
            <div class="card-header-elements ml-auto">
                <a href="{{ route('user.create') }}" type="button" class="btn btn-primary btn-md">Tambah Data</a>
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
                                    <th>Nama User</th>
                                    <th>Email</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($listUser as $user)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->wilayah->nama_wilayah ?? '-' }}</td>
                                        <td><a href="{{ route('user.edit', $user->id) }}"
                                                class="btn btn-warning btn-sm">Edit</a>
                                            <button type="button" class="btn btn-danger btn-sm deleteUser"
                                                data-id="{{ $user->id }}" data-toggle="modal"
                                                data-target="#modal-delete-user">Delete</button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <!-- Pagination Links -->
                        <div> {{ $listUser->links() }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- 3rd row Start -->
    <div class="modal fade" id="modal-delete-user" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Delete User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <p>Apakah anda yakin ingin menghapus user ini?</p>
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
        $('.deleteUser').on('click', function() {
            $('#modal-delete-user form').attr('action', 'user/' + $(this).data('id'));
        });

        $('#modal-delete-user').on('hidden.bs.modal', function() {
            $('#modal-delete-user form').attr('action', '');
        });
    </script>
@endsection
