@extends('administrator.layouts.master')

@include('administrator.'.$prefixView.'.header')

@section('css')


@endsection

@section('content')

    <div class="container-fluid list-products">
        <div class="row">

            <form action="{{route('administrator.'.$prefixView.'.store')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="col-md-12">

                    @include('administrator.components.require_input_text' , ['name' => 'name' , 'label' => 'Name'])

                    @include('administrator.components.select_category' , ['label' => 'Domain', 'name' => 'website_id' ,'html_category' => \App\Models\Advertise::getWeb(isset($item) ? optional($item)->category_id : ''), 'can_create' => true])

                    @include('administrator.components.select_category' , ['label' => 'Type advertises', 'name' => 'type_adv' ,'html_category' => \App\Models\Advertise::getTypeAd(isset($item) ? optional($item)->category_id : ''), 'can_create' => true])

                    @include('administrator.components.button_save')
                </div>
            </form>
        </div>

    </div>

@endsection

@section('js')


@endsection

