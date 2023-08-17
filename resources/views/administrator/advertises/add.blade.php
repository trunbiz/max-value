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
                    <label>Website: {{$site['name']}}</label>
                    <input hidden type="text" autocomplete="off" name="website_id" class="form-control"
                           value="{{$site['id']}}" required>
                </div>
                    <div class="form-group col-sm-6">
                        <label>Name</label>
                        <input type="text" autocomplete="off" name="name" class="form-control"
                               value="" required>
                    </div>
                    <div class="form-group col-sm-6">
                        <label>Format</label>
                        <select id="format" class="form-control choose_value select2_init" required
                                name="format_id">
                            @foreach($list_format_zone as $key => $item)
                                <option value="{{$key}}">{{$item}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-sm-6">
                        <label>Dimension</label>
                        <select id="dimension" class="form-control choose_value select2_init" required
                                name="dimension_id">
                           @foreach($dimensions as $key => $item)
                                <option value="{{$key}}">{{$item}}</option>
                           @endforeach
                        </select>
                    </div>
                    <div class="form-group col-sm-6">
                        <label>Dimension Method</label>
                        <select id="dimension_method_id" class="form-control choose_value select2_init" required
                                name="dimension_method_id">
                            @foreach($dimension_method as $key => $item)
                                <option value="{{$key}}">{{$item}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-sm-12">
                        <input class="form-check-input" type="checkbox" value="1" id="active" name="active">
                        <label class="form-check-label" for="flexCheckDefault">
                            Active
                        </label>
                    </div>
                    <div class="form-group col-sm-12" style="text-align: center">
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </div>
            </form>

    </div>

@endsection

@section('js')


@endsection

