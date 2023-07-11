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

                            @if (Session::has('error'))
                                <div class="card p-3 text-danger text-center">
                                    {{ Session::get('error') }}
                                </div>
                            @endif

                            <div class="row">

                                {{--                                <div class="col-md-12">--}}
                                {{--                                    <div class="form-group mt-3">--}}
                                {{--                                        <label>Tên khách hàng<span class="text-danger">*</span></label>--}}
                                {{--                                        <input type="text" name="name"--}}
                                {{--                                               class="form-control @error('name') is-invalid @enderror"--}}
                                {{--                                               value="{{old('name')}}" required>--}}
                                {{--                                        @error('name')--}}
                                {{--                                        <div class="alert alert-danger">{{$message}}</div>--}}
                                {{--                                        @enderror--}}
                                {{--                                    </div>--}}
                                {{--                                </div>--}}


                                <div class="col-md-12">
                                    <div class="form-group mt-3">
                                        <label>Email<span class="text-danger">*</span></label>
                                        <input type="text" name="email"
                                               class="form-control @error('email') is-invalid @enderror"
                                               value="{{old('email')}}" required>
                                        @error('email')
                                        <div class="alert alert-danger">{{$message}}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group mt-3">
                                        <label>Mật khẩu<span class="text-danger">*</span></label>
                                        <input type="password" name="password"
                                               class="form-control @error('password') is-invalid @enderror"
                                               value="{{old('password')}}" required>
                                        @error('password')
                                        <div class="alert alert-danger">{{$message}}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    @include('administrator.components.select_category' , ['label' => 'Manager','name' => 'manager_id' ,'html_category' => \App\Models\User::getCategory(isset($item) ? optional($item)->manger_id : '')])
                                </div>

                                <div class="col-md-12">

                                    <div class="form-group mt-3">
                                        <label>Active? @include('user.components.lable_require')</label>
                                        <select
                                            class="form-control choose_value select2_init @error('user_status_id') is-invalid @enderror"
                                            required
                                            name="user_status_id">
                                            @foreach(\App\Models\UserStatus::all() as $itemUserStatus)
                                                <option
                                                    value="{{$itemUserStatus->id}}" {{$itemUserStatus->id == old('user_status_id') ? 'selected' : ''}}>{{$itemUserStatus->name}}</option>
                                            @endforeach
                                        </select>
                                        @error('user_status_id')
                                        <div class="alert alert-danger">{{$message}}</div>
                                        @enderror
                                    </div>

                                </div>

                            </div>

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

