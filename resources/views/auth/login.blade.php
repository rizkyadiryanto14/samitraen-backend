@extends('layouts.main')

@section('title')
Samitraen | Login
@endsection

@section('body')
    <!-- [ Preloader ] Start -->
    <div class="page-loader">
        <div class="bg-primary"></div>
    </div>
    <!-- [ Preloader ] End -->

    <!-- [ content ] Start -->
    <div class="authentication-wrapper authentication-2 px-3 d-flex flex-column">
        <div style="width:370px">
            @include('layouts.partials.notif')
        </div>
        <div class="authentication-inner py-5">
            <!-- [ Logo ] Start -->
            <div class="d-flex justify-content-center align-items-center">
                <div class="ui-w-60">
                    <div class="w-100 position-relative">
                        <img src="assets/img/logo-dark.png" alt="Brand Logo" class="img-fluid">
                    </div>
                </div>
            </div>
            <!-- [ Logo ] End -->

            <!-- [ Form ] Start -->
            <form class="my-5" method="post" action="{{ route('login') }}">
                @csrf
                <div class="form-group">
                    <label class="form-label">Email</label>
                    <input type="email" class="form-control" name="email" required>
                    <div class="clearfix"></div>
                </div>
                <div class="form-group">
                    <label class="form-label d-flex justify-content-between align-items-end">
                        <span>Password</span>
                    </label>
                    <input type="password" class="form-control" name="password" required>
                    <div class="clearfix"></div>
                </div>
                <div class="d-flex justify-content-start align-items-center m-0">
                    <button type="submit" class="btn btn-primary" style="width: 100%">Sign In</button>
                </div>
            </form>

        </div>
    </div>
@endsection
