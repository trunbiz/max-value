@extends('administrator.layouts.master')

@include('administrator.'.$prefixView.'.header')

@section('css')


@endsection

@section('content')

    <div class="container-fluid list-products">
        <div class="row">

            <form action="{{route('administrator.'.$prefixView.'.store')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="col-xxl-6">
                    <div class="card">
                        <div class="card-body">
                            @include('administrator.components.require_input_text' , ['name' => 'title' , 'label' => 'Title'])

                            @if($isSingleImage)
                                <div class="mt-3 mb-3">
                                    @include('administrator.components.upload_image', ['post_api' => $imagePostUrl, 'table' => $table, 'image' => $imagePathSingple , 'relate_id' => $relateImageTableId])
                                </div>
                            @endif

                            @if($isMultipleImages)
                                <div class="mt-3 mb-3">
                                    @include('administrator.components.upload_multiple_images', ['post_api' => $imageMultiplePostUrl, 'delete_api' => $imageMultipleDeleteUrl , 'sort_api' => $imageMultipleSortUrl, 'table' => $table , 'images' => $imagesPath,'relate_id' => $relateImageTableId])
                                </div>
                            @endif

                            @include('administrator.components.normal_textarea', ['name' => 'description' , 'label' => 'Message'])

                            <div class="mt-3">
                                <label class="bold">Send to Publisher</label>
                                <select name="user[]" class="form-control select2_init" multiple>
                                    <option value="">--Select--</option>
                                    @foreach($users as $user)
                                        <option value="{{ $user['id'] }}">{{ $user['email'] }}</option>
                                    @endforeach
                                </select>
                            </div>

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

