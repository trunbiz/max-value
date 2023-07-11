@extends('administrator.layouts.master')

@include('administrator.'.$prefixView.'.header')

@section('css')

@endsection

@section('content')

    <div class="container-fluid list-products">
        <div class="row">
            <!-- Individual column searching (text inputs) Starts-->

            <form action="{{route('administrator.ads_txt.update', ['id'=> $item->id]) }}" method="post"
                  enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="col-xxl-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group">
                                <label>Điền Ads text vào đây</label>
                                <textarea type="text" name="ads_txt" rows="10"
                                          class="form-control @error('ads_txt') is-invalid @enderror">{{$item->ads_txt}}</textarea>
                                @error('ads_txt')
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
