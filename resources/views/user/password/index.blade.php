@extends('user.layouts.master')

@include('user.password.header')

@section('css')

@endsection

@section('content')

    <div class="container-fluid list-products">
        <div class="row">
            <!-- Individual column searching (text inputs) Starts-->

            <div class="col-xxl-6">

                <div class="card">

                    <div class="card-body">

                        @if (Session::has('error'))
                            <div class="text-danger mb-4" style="font-weight: bold;">
                                {{ Session::get('error') }}
                            </div>
                        @endif

                        @if (Session::has('success'))
                            <div class="text-success mb-4" style="font-weight: bold;">
                                {{ Session::get('success') }}
                            </div>
                        @endif

                        <form action="{{route('user.password.update') }}" method="post"
                              enctype="multipart/form-data">
                            @method('PUT')
                            @csrf
                            <div class="form-group">
                                <label>Old password</label>
                                <input type="password" name="old_password"
                                       class="form-control @error('old_password') is-invalid @enderror" required>
                                @error('old_password')
                                <div class="alert alert-danger">{{$message}}</div>
                                @enderror
                            </div>

                            <div class="form-group mt-3">
                                <label>New password</label>
                                <input type="password" name="new_password"
                                       class="form-control @error('new_password') is-invalid @enderror" required>
                                @error('new_password')
                                <div class="alert alert-danger">{{$message}}</div>
                                @enderror
                            </div>

                            <div class="form-group mt-3">
                                <label>Confirm new password</label>
                                <input type="password" name="new_password_confirm"
                                       class="form-control @error('new_password_confirm') is-invalid @enderror"
                                       required>
                                @error('new_password_confirm')
                                <div class="alert alert-danger">{{$message}}</div>
                                @enderror
                            </div>

                            @include('user.components.button_save')
                        </form>
                    </div>
                </div>

            </div>

        </div>
    </div>

@endsection

@section('js')

@endsection
