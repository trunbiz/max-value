@extends('user.layouts.master')

@include('user.'.$prefixView.'.header')

@section('css')


@endsection

@section('content')

    <div class="container-fluid list-products">
        <div class="row">

            <div class="col-xxl-6">
                <div class="card">
                    <div class="card-body">

                        <form action="{{route('user.'.$prefixView.'.store')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="col-xxl-12">

                                @include('user.components.input_text' , ['name' => 'name' , 'label' => 'Name'])

                                <div class="form-group mt-3">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="active" id="inlineRadio1" value="1" checked>
                                        <label class="form-check-label" for="inlineRadio1">Active</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="active" id="inlineRadio2" value="0">
                                        <label class="form-check-label" for="inlineRadio2">InActive</label>
                                    </div>
                                </div>

                                @include('user.components.select_category' , ['label' => 'Format', 'name' => 'type_adv_id' ,'html_category' => \App\Models\Advertise::getTypeAd(isset($item) ? optional($item)->category_id : ''), 'isDefaultFirst' => true])

                                @include('user.components.select_category' , ['label' => 'Dimension', 'name' => 'dimension_id' ,'html_category' => \App\Models\Advertise::getDimension(isset($item) ? optional($item)->category_id : ''), 'isDefaultFirst' => true])

                                <input style="display: none;" name="website_id" value="{{request('website_id')}}">

                                @include('user.components.button')
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection

@section('js')


@endsection

