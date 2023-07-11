@extends('administrator.layouts.master')

@include('administrator.'.$prefixView.'.header')

@section('css')

@endsection

@section('content')

    <div class="container-fluid list-products">
        <div class="row">

            <form action="{{route('administrator.'.$prefixView.'.update', ['id'=> $item->id]) }}" method="post"
                  enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="col-xxl-6">
                    <div class="card">
                        <div class="card-body">
                            @include('administrator.components.require_input_text' , ['name' => 'name' , 'label' => 'Category name'])

                            @include('administrator.components.button_save')
                        </div>
                    </div>

                </div>
            </form>

        </div>
    </div>
@endsection

@section('js')

@endsection
