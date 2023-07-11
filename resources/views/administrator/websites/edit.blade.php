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
                            <div class="form-group mt-3">
                                <label>Title</label>
                                <input type="text" class="form-control" value="{{ $item->title }}" disabled>
                            </div>

                            <div class="form-group mt-3">
                                <label>Domain</label>
                                <input type="text" class="form-control" value="{{ $item->name }}" disabled>
                            </div>

                            <div class="form-group mt-3">
                                <label>Category</label>
                                <input type="text" class="form-control" value="{{ optional($item->getCategory)->name }}"
                                       disabled>
                            </div>

                            <div class="form-group mt-3">
                                <label>Description</label>
                                <input type="text" class="form-control" value="{{ $item->description }}" disabled>
                            </div>

                            @include('administrator.components.select_status' , ['name' => 'status' , 'label' => 'Status'])

                            @include('administrator.components.button_save')
                        </div>
                    </div>

                </div>
            </form>

        </div>
    </div>
@endsection

@section('js')

    <script>
        $(document).ready(function () {
            $('input[name="title"]').attr('disabled', 'disabled');
            $('input[name="name"]').attr('disabled', 'disabled');
            $('select[name="category_web"]').attr('disabled', 'disabled');
            $('input[name="description"]').attr('disabled', 'disabled');
        })
    </script>

@endsection
