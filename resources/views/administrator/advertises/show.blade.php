@extends('administrator.layouts.master')

@include('administrator.'.$prefixView.'.header')

@section('css')


@endsection

@section('content')

    <div class="container-fluid list-products">
        <form action="{{route('administrator.zones.store')}}" method="post" enctype="multipart/form-data">
            <div class="row">
                @csrf
                <div class="form-group col-sm-12">
                    <label>Website: {{$item['site']['name']}}</label>
                    <input hidden type="text" autocomplete="off" name="website_id" class="form-control"
                           value="{{$item['site']['id']}}" required>
                </div>
                <div class="form-group col-sm-6">
                    <label>Name</label>
                    <input type="text" autocomplete="off" name="name" class="form-control"
                           value="{{$item['name']}}" required>
                </div>
                <div class="form-group col-sm-6">
                    <label>Format</label>
                    <select id="format" class="form-control choose_value select2_init" required
                            name="format_id">
                        @foreach($list_format_zone as $key => $value)
                            <option value="{{$key}}" {{$key == $item['format']['id'] ? 'selected' : ''}}>{{$value}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-sm-6">
                    <label>Dimension</label>
                    <select id="dimension" class="form-control choose_value select2_init" required
                            name="dimension_id">
                        @foreach($dimensions as $key => $value)
                            <option value="{{$key}}" {{$key == $item['dimension']['id'] ? 'selected' : ''}}>{{$value}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-sm-6">
                    <label>Dimension Method</label>
                    <select id="dimension_method_id" class="form-control choose_value select2_init" required
                            name="dimension_method_id">
                        @foreach($dimension_method as $key => $value)
                            <option value="{{$key}}">{{$value}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-sm-12">
                    <label>Code</label>
                    <div class="row">
                        @foreach($item['code'] as $key => $value)
                            <div class="form-group col-sm-6">
                            <label>{{$value['title']}}</label>
                            <textarea disabled class="form-control" id="floatingTextarea2" rows="5">{{$value['code']}}</textarea>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="form-group col-sm-12">
                    <input class="form-check-input" type="checkbox" {{$item['is_active'] ? 'checked' : ''}} value="1" id="active" name="active">
                    <label class="form-check-label" for="flexCheckDefault">
                        Active
                    </label>
                </div>
                <div class="form-group col-sm-12" style="text-align: center">
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </div>
        </form>

    </div>

@endsection

@section('js')


@endsection

