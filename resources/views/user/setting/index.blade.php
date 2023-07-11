@extends('user.layouts.master')

@section('title')
    <title>{{$title}}</title>
@endsection

@section('content')

@php
    if(isset($current_user) && !empty($current_user)){
        $name = $current_user->name;
        $address = $current_user->address;
        $email = $current_user->email;
        $birtday = str_replace('/', '-', $current_user->date_of_birth);

        $split = explode(' ', $name);
        $first_name = array_shift($split);
        $last_name  = implode(" ", $split);
    }
@endphp

<div class="content-main">
    <div class="row">
        <div class="col-md-12 col-xl-12 col-12">
            <div class="vertical-tab bg-white" role="tabpanel" id="settings">
                <!-- Nav tabs -->
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation">
                        <a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">
                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M0 10C0 12.3649 0.8209 14.538 2.19329 16.25C4.02594 18.5362 6.84202 20 10 20C13.1066 20 15.8823 18.5834 17.7165 16.3609C19.143 14.6323 20 12.4162 20 10C20 4.47715 15.5228 0 10 0C4.47715 0 0 4.47715 0 10ZM10 12.5C7.38855 12.5 5.0109 13.501 3.22982 15.1403C4.78233 17.1819 7.23724 18.5 10 18.5C12.7628 18.5 15.2177 17.1819 16.7702 15.1403C14.9891 13.501 12.6115 12.5 10 12.5ZM10 10.5C11.6569 10.5 13 9.1569 13 7.5C13 5.84315 11.6569 4.5 10 4.5C8.3431 4.5 7 5.84315 7 7.5C7 9.1569 8.3431 10.5 10 10.5Z" fill="#fff"></path></svg>
                            Profile
                        </a>
                    </li>
                    <li role="presentation">
                        <a href="#changepass" aria-controls="changepass" role="tab" data-toggle="tab">
                            <svg width="24" height="24" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><g clip-path="url(#clip0_249_7421)"><path d="M7.25 12C7.25 11.3097 6.69036 10.75 6 10.75C5.30965 10.75 4.75 11.3097 4.75 12C4.75 12.6904 5.30965 13.25 6 13.25C6.69036 13.25 7.25 12.6904 7.25 12Z" fill="inherit"></path><path fill-rule="evenodd" clip-rule="evenodd" d="M3 6C1.34315 6 -1.31134e-07 7.34315 0 9.00001L2.62268e-07 15C3.34692e-07 16.6569 1.34315 18 3 18H9C10.6569 18 12 16.6569 12 15V14.5H16V16C16 16.8285 16.6716 17.5 17.5 17.5H19.5C20.3284 17.5 21 16.8285 21 16V14.5H22.5C23.3284 14.5 24 13.8284 24 13V11C24 10.1716 23.3284 9.50001 22.5 9.50001H12V9.00001C12 7.34315 10.6569 6 9 6H3ZM10.5 15V13H17.5V16H19.5V13H22.5V11H10.5V9.00001C10.5 8.17158 9.82843 7.5 9 7.5H3C2.17157 7.5 1.5 8.17158 1.5 9.00001V15C1.5 15.8285 2.17157 16.5 3 16.5H9C9.82843 16.5 10.5 15.8285 10.5 15Z" fill="inherit"></path></g><defs><clipPath id="clip0_249_7421"><rect width="24" height="24" fill="#000"></rect></clipPath></defs></svg>
                            Change password
                        </a>
                    </li>
                </ul>
                <!-- Tab panes -->
                <div class="tab-content tabs">
                    <div role="tabpanel" class="tab-pane" id="profile">
                        <h4>Profile Info</h4>
                        <form action="" autocomplete="off">
{{--                            <div class="row form-group">--}}
{{--                                <div class="col-md-6 col-12">--}}
{{--                                    <label for="firstname">First name&nbsp<span class="text-danger">*</span></label>--}}
{{--                                    <input type="text" name="firstname" class="form-control" value="{{ $first_name }}">--}}
{{--                                </div>--}}
{{--                                <div class="col-md-6 col-12">--}}
{{--                                    <label for="lastname">Last name&nbsp<span class="text-danger">*</span></label>--}}
{{--                                    <input type="text" name="lastname" class="form-control" value="{{ $last_name }}">--}}
{{--                                </div>--}}
{{--                            </div>--}}
                            <div class="row form-group">
                                <div class="col-md-6 col-12">
                                    <label for="city">Email&nbsp<span class="text-danger">*</span></label>
                                    <input type="text" name="email" class="form-control" value="{{ $email }}">
                                </div>
                                <div class="col-md-6 col-12">
                                    <label for="country">Date of birth</label>
                                    <input type="text" name="birth" class="form-control datepicker-here" data-language="en" value="{{ date('d/m/Y', strtotime($birtday)) }}">
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-md-12 col-12">
                                    <label for="address">Address</label>
                                    <input type="text" name="address" class="form-control" value="{{ $address }}">
                                </div>
                            </div>
                            <div class="divider"></div>
                            <button type="button" class="filter__button" id="updateProfile">
                                Update now
                            </button>
                        </form>
                    </div>
                    <div role="tabpanel" class="tab-pane" id="changepass">
                        <h4>Change password</h4>
                        <form action="" autocomplete="off">
                            <div class="row form-group">
                                <div class="col-md-12 col-12">
                                    <label for="pwd_old">Current password&nbsp<span class="text-danger">*</span></label>
                                    <input type="password" name="pwd_old" class="form-control" id="pwd_old">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="eye eye-open hide" fill="none" viewBox="0 0 24 24" stroke="#0ccd6b" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                    </svg>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="eye eye-close" fill="none" viewBox="0 0 24 24" stroke="#0ccd6b" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"></path>
                                    </svg>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-md-12 col-12">
                                    <label for="pwd_new">New password&nbsp<span class="text-danger">*</span></label>
                                    <input type="password" name="pwd_new" class="form-control">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="eye eye-open hide" fill="none" viewBox="0 0 24 24" stroke="#0ccd6b" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                    </svg>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="eye eye-close" fill="none" viewBox="0 0 24 24" stroke="#0ccd6b" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"></path>
                                    </svg>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-md-12 col-12">
                                    <label for="confirm">Confirm Password&nbsp<span class="text-danger">*</span></label>
                                    <input type="password" name="confirm" class="form-control">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="eye eye-open hide" fill="none" viewBox="0 0 24 24" stroke="#0ccd6b" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                    </svg>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="eye eye-close" fill="none" viewBox="0 0 24 24" stroke="#0ccd6b" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"></path>
                                    </svg>
                                </div>
                            </div>
                            <div class="divider"></div>
                            <button type="button" class="filter__button" id="updatePass">
                                Update now
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        //Profile
        $('#updateProfile').click(function () {
            $.ajax({
                type: 'POST',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                url: '{{ route('user.settings.updateProfile') }}',
                data: {
                    // 'firstname' : $('input[name="firstname"]').val(),
                    // 'lastname' : $('input[name="lastname"]').val(),
                    'email' : $('input[name="email"]').val(),
                    'birth' : $('input[name="birth"]').val(),
                    'address' : $('input[name="address"]').val(),
                },
                beforeSend: function( jqXHR, settings ) {
                    $('#loader').removeClass('loading');
                },

                success: function( data, textStatus, jqXHR ) {
                    if( data.status == true ) {
                        swal("Success!", data.message, "success");
                    } else {
                        swal("Error!", data.message, "error");
                    }
                },

                complete: function(){
                    $('#loader').addClass('loading');
                },

                error: function( jqXHR, textStatus, errorThrown ) {
                    alert( errorThrown );
                }
            });
        })
        //Password
        $('#updatePass').click(function () {
            $.ajax({
                type: 'POST',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                url: '{{ route('user.settings.updatePass') }}',
                data: {
                    'current_password' : $('input[name="pwd_old"]').val(),
                    'new_password' : $('input[name="pwd_new"]').val(),
                    'confirm_password' : $('input[name="confirm"]').val(),
                },
                beforeSend: function( jqXHR, settings ) {
                    $('#loader').removeClass('loading');
                },

                success: function( data, textStatus, jqXHR ) {
                    if( data.status == true ) {
                        swal("Success!", data.message, "success").then(() => {
                            window.location.href = '/login';
                        });
                    } else {
                        swal("Error!", data.message, "error");
                    }
                },

                complete: function(){
                    $('#loader').addClass('loading');
                },

                error: function( jqXHR, textStatus, errorThrown ) {
                    alert( errorThrown );
                }
            });
        })
    })
</script>

@endsection

