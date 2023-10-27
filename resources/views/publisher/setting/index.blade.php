@extends('publisher.base')
@section('title', 'Setting')
@section('content')
    <div class="d-flex align-items-center mb-4">
        <div class="row">
            <h4 class="main-title mb-0">Setting</h4>
        </div>
    </div>
    <div class="d-flex align-items-center mb-4 row">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="home" aria-selected="true">Profile Info</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#changePassword" type="button" role="tab" aria-controls="profile" aria-selected="false">Change password</button>
            </li>
        </ul>
        <div class="tab-content row" id="myTabContent">
            <div class="tab-pane fade show active" id="profile" role="tabpanel" aria-labelledby="profile-tab" style="padding: 15px;">
                <div class="mb-3 row">
                    <label for="staticEmail" class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-10">
                        <input type="text" name="email" class="form-control" value="{{ $current_user->email }}">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="inputPassword" class="col-sm-2 col-form-label">Date of birth</label>
                    <div class="col-sm-10">
                        <input type="date" name="birth" class="form-control" value="{{ date('Y-m-d', strtotime($current_user->date_of_birth)) }}">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="inputPassword" class="col-sm-2 col-form-label">Address</label>
                    <div class="col-sm-10">
                        <input type="text" name="address" class="form-control" value="{{ $current_user->address }}">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="inputPassword" class="col-sm-2 col-form-label"></label>
                    <div class="col-sm-10">
                        <button type="button" class="btn btn-outline-primary" id="updateProfile">
                            Update
                        </button>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="changePassword" role="tabpanel" aria-labelledby="changePassword-tab" style="padding: 15px;">

                <div class="mb-3 row">
                    <label for="staticEmail" class="col-sm-2 col-form-label">Current password <span class="text-danger">*</span></label>
                    <div class="col-sm-10">
                        <input type="password" name="pwd_old" class="form-control" id="pwd_old">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="inputPassword" class="col-sm-2 col-form-label">New password <span class="text-danger">*</span></label>
                    <div class="col-sm-10">
                        <input type="password" name="pwd_new" class="form-control">
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="inputPassword" class="col-sm-2 col-form-label">Confirm Password <span class="text-danger">*</span></label>
                    <div class="col-sm-10">
                        <input type="password" name="confirm" class="form-control">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="inputPassword" class="col-sm-2 col-form-label"></label>
                    <div class="col-sm-10">
                        <button type="button" class="btn btn-outline-primary" id="updatePass">
                            Update
                        </button>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <style>
    </style>
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
                            window.location.reload();
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
                            window.location.reload();
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
