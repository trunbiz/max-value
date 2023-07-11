@extends('user.layouts.master')

@include('user.'.$prefixView.'.header')

@section('css')


@endsection

@section('content')

    <div class="container-fluid list-products">

        @if (Session::has('error'))
            <div class="card p-3 text-danger text-center">
                {{ Session::get('error') }}
            </div>
        @endif

        <div class="row">
            <div class="col-xxl-6">
                <div class="card">
                    <div class="card-body">
                        <form action="{{route('user.'.$prefixView.'.store')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div>

                                @include('user.components.require_input_text' , ['name' => 'name' , 'label' => 'Title'])

                                @include('user.components.require_input_text' , ['name' => 'url' , 'label' => 'Url'])

                                @include('user.components.select_category' , ['label' => 'Category', 'name' => 'category_website_id' ,'html_category' => \App\Models\TypeCategory::getCategory(isset($item) ? optional($item)->category_website_id : ''), 'isDefaultFirst' => true])

                                @include('user.components.require_textarea_normal' , ['name' => 'description' , 'label' => 'Description'])

                                @include('user.components.button_save')
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

