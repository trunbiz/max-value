@extends('administrator.layouts.master')

@include('administrator.'.$prefixView.'.header')

@section('css')

@endsection

@section('content')

    <div class="container-fluid list-products">
        <div class="row">
            <!-- Individual column searching (text inputs) Starts-->

            <form action="{{route('administrator.percent.update', ['id'=> $item->id]) }}" method="post"
                  enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="col-xxl-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group">
                                <label>Phần trăm quảng cáo (*Hướng dẫn: Điền 100 => publisher sẽ nhận được 100% số tiền
                                    quảng cáo, điền 85, publisher sẽ nhận được 85% tiền quảng cáo)</label>
                                <input type="text" name="percent"
                                       class="form-control @error('percent') is-invalid @enderror"
                                       value="{{$item->percent}}" required>
                                @error('percent')
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
