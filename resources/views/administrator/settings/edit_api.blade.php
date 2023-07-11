@extends('administrator.layouts.master')

@include('administrator.'.$prefixView.'.header')

@section('css')

@endsection

@section('content')

    <div class="container-fluid list-products">
        <div class="row">
            <!-- Individual column searching (text inputs) Starts-->

            <form action="{{route('administrator.api.update', ['id'=> $item->id]) }}" method="post"
                  enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="col-xxl-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group">
                                <label>Điền token API adserver vào đây</label>
                                <input type="text" name="token_api"
                                       class="form-control @error('token_api') is-invalid @enderror"
                                       value="{{$item->token_api}}" required>
                                @error('token_api')
                                <div class="alert alert-danger">{{$message}}</div>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary mt-3">Lưu thay đổi</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('js')

@endsection
