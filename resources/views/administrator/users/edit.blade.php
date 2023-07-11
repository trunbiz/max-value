{{--@extends('administrator.layouts.master')--}}

{{--@include('administrator.'.$prefixView.'.header')--}}

{{--@section('css')--}}

{{--@endsection--}}

{{--@section('content')--}}

{{--    <div class="container-fluid list-products">--}}
{{--        <div class="row">--}}

{{--            <form action="{{route('administrator.'.$prefixView.'.update', ['id'=> $item->api_publisher_id]) }}"--}}
{{--                  method="post"--}}
{{--                  enctype="multipart/form-data">--}}
{{--                @method('PUT')--}}
{{--                @csrf--}}
{{--                <div class="col-xxl-6">--}}

{{--                    <div class="card">--}}
{{--                        <div class="card-body">--}}
{{--                            <div class="row">--}}

{{--                                --}}{{--                                <div class="col-md-12">--}}
{{--                                --}}{{--                                    <div class="form-group mt-3">--}}
{{--                                --}}{{--                                        <label>Tên khách hàng<span class="text-danger">*</span></label>--}}
{{--                                --}}{{--                                        <input type="text" name="name"--}}
{{--                                --}}{{--                                               class="form-control @error('name') is-invalid @enderror"--}}
{{--                                --}}{{--                                               value="{{$item->name}}" required>--}}
{{--                                --}}{{--                                        @error('name')--}}
{{--                                --}}{{--                                        <div class="alert alert-danger">{{$message}}</div>--}}
{{--                                --}}{{--                                        @enderror--}}
{{--                                --}}{{--                                    </div>--}}
{{--                                --}}{{--                                </div>--}}


{{--                                <div class="col-md-12">--}}
{{--                                    <div class="form-group mt-3">--}}
{{--                                        <label>Email<span class="text-danger">*</span></label>--}}
{{--                                        <input type="text" name="email" autocomplete="off"--}}
{{--                                               class="form-control @error('email') is-invalid @enderror"--}}
{{--                                               value="{{$item->email}}" required readonly>--}}
{{--                                        @error('email')--}}
{{--                                        <div class="alert alert-danger">{{$message}}</div>--}}
{{--                                        @enderror--}}
{{--                                    </div>--}}
{{--                                </div>--}}


{{--                                <div class="col-md-12">--}}
{{--                                    <div class="form-group mt-3">--}}
{{--                                        <label>Mật khẩu<span class="text-danger">*</span></label>--}}
{{--                                        <input type="text" name="password"--}}
{{--                                               class="form-control @error('password') is-invalid @enderror"--}}
{{--                                               value="">--}}
{{--                                        @error('password')--}}
{{--                                        <div class="alert alert-danger">{{$message}}</div>--}}
{{--                                        @enderror--}}
{{--                                    </div>--}}
{{--                                </div>--}}

{{--                                <div class="col-md-3">--}}
{{--                                    @include('administrator.components.select_category' , ['label' => 'Manager','name' => 'manager_id' ,'html_category' => \App\Models\User::getCategory(isset($item) ? optional($item)->manger_id : '')])--}}
{{--                                </div>--}}

{{--                                <div class="col-md-12">--}}
{{--                                    <div class="form-group mt-3">--}}
{{--                                        <label>Type @include('user.components.lable_require')</label>--}}
{{--                                        <select--}}
{{--                                            class="form-control choose_value select2_init @error('user_status_id') is-invalid @enderror"--}}
{{--                                            required name="idrole">--}}
{{--                                            <option value="3" {{3 == $itemAdserver['role']['id'] ? 'selected' : ''}}>--}}
{{--                                                Advertiser--}}
{{--                                            </option>--}}
{{--                                            <option value="1" {{1 == $itemAdserver['role']['id'] ? 'selected' : ''}}>--}}
{{--                                                Owner--}}
{{--                                            </option>--}}
{{--                                            <option value="2" {{2 == $itemAdserver['role']['id'] ? 'selected' : ''}}>--}}
{{--                                                Manager--}}
{{--                                            </option>--}}
{{--                                            <option value="4" {{4 == $itemAdserver['role']['id'] ? 'selected' : ''}}>--}}
{{--                                                Publisher--}}
{{--                                            </option>--}}
{{--                                        </select>--}}
{{--                                        @error('user_status_id')--}}
{{--                                        <div class="alert alert-danger">{{$message}}</div>--}}
{{--                                        @enderror--}}
{{--                                    </div>--}}

{{--                                </div>--}}

{{--                                <div class="col-md-12">--}}

{{--                                    <div class="form-group mt-3">--}}
{{--                                        <label>Active? @include('user.components.lable_require')</label>--}}
{{--                                        <select--}}
{{--                                            class="form-control choose_value select2_init @error('user_status_id') is-invalid @enderror"--}}
{{--                                            required--}}
{{--                                            name="user_status_id">--}}
{{--                                            @foreach(\App\Models\UserStatus::all() as $itemUserStatus)--}}
{{--                                                <option--}}
{{--                                                    value="{{$itemUserStatus->id}}" {{$itemUserStatus->id == $item->user_status_id ? 'selected' : ''}}>{{$itemUserStatus->name}}</option>--}}
{{--                                            @endforeach--}}
{{--                                        </select>--}}
{{--                                        @error('user_status_id')--}}
{{--                                        <div class="alert alert-danger">{{$message}}</div>--}}
{{--                                        @enderror--}}
{{--                                    </div>--}}

{{--                                </div>--}}

{{--                            </div>--}}


{{--                            @include('administrator.components.button_save')--}}

{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}

{{--            </form>--}}

{{--        </div>--}}
{{--    </div>--}}

{{--@endsection--}}

{{--@section('js')--}}

{{--@endsection--}}

<div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Edit Publisher</h5>
            <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form autocomplete="off">
            <div class="modal-body">
                <div class="mb-3">
                    <label>Email<span class="text-danger">*</span></label>
                    <input type="text" name="email" class="form-control" value="{{ $item->email }}" disabled>
                </div>
                <div class="mb-3">
                    <label>Mật khẩu<span class="text-danger">*</span></label>
                    <input type="password" name="password" class="form-control">
                </div>
                <div class="mb-3">
                    @include('administrator.components.select_category' , ['label' => 'Manager','name' => 'manager_id' ,'html_category' => \App\Models\User::getCategory(isset($item) ? optional($item)->manger_id : '')])
                </div>
                <div class="mb-3">
                    <label>Active? @include('user.components.lable_require')</label>
                    <select class="form-control choose_value select2_init" name="user_status_id">
                        @foreach(\App\Models\UserStatus::all() as $itemUserStatus)
                            <option
                                value="{{$itemUserStatus->id}}" {{$itemUserStatus->id == $item->user_status_id ? 'selected' : ''}}>{{$itemUserStatus->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" type="button" onclick="update({{ $item->api_publisher_id }})">Save</button>
            </div>
        </form>
    </div>
</div>
