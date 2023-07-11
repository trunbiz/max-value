@extends('user.layouts.master')

@include('user.'.$prefixView.'.header')

@section('css')

@endsection

@section('content')

    <div class="container-fluid list-products">
        <div class="row">

            <form action="{{route('user.'.$prefixView.'.update', ['id'=> $item->id]) }}" method="post"
                  enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="col-md-12">

                    @include('user.components.require_input_text' , ['name' => 'name' , 'label' => 'Name'])

                    @include('user.components.select_category' , ['label' => 'Website', 'name' => 'website_id' ,'html_category' => \App\Models\Advertise::getWeb(isset($item) ? optional($item)->category_id : ''), 'can_create' => true])

                    @include('user.components.select_category' , ['label' => 'Type advertises', 'name' => 'type_adv' ,'html_category' => \App\Models\Advertise::getTypeAd(isset($item) ? optional($item)->category_id : ''), 'can_create' => true])

                    @include('user.components.button_save')

                </div>
            </form>

        </div>
    </div>
@endsection

@section('js')


@endsection
