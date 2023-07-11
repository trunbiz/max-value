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

                    @include('administrator.components.require_input_text' , ['name' => 'title' , 'label' => 'Title'])

                    @include('administrator.components.require_input_text' , ['name' => 'name' , 'label' => 'Domain'])

                    @include('administrator.components.select_category' , ['label' => 'Category', 'name' => 'category_web' ,'html_category' => \App\Models\TypeCategory::getCategory(isset($item) ? optional($item)->category_id : ''), 'can_create' => true])

                    @include('administrator.components.input_text' , ['name' => 'description' , 'label' => 'Description'])

                    @include('administrator.components.button_save')
                </div>
            </form>
        </div>

    </div>

@endsection

@section('js')


@endsection

