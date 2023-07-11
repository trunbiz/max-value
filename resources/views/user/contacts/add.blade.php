@extends('user.layouts.master')

@include('user.'.$prefixView.'.header')

@section('css')


@endsection

@section('content')

    <div class="content-main">
        <div class="list__payment">
            <a href="{{ route('user.contacts.index') }}" class="list__payment--item">
                Contact
            </a>
            <a href="{{ route('user.contacts.contactList') }}" class="list__payment--item active">
                Create
            </a>
        </div>
        <div class="row">
            <div class="col-md-12 col-xl-12 col-12 bg-white">
                <div class="vertical-tab bg-white">
                    <div class="tab-content">
                        <h4>Create</h4>
                        <form autocomplete="off">
                            <div class="row form-group">
                                <div class="col-md-12 col-12">
                                    @include('user.components.require_input_text' , ['name' => 'subject' , 'label' => 'Subject'])
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-md-12 col-12">
                                    @include('user.components.require_textarea_normal' , ['name' => 'message' , 'label' => 'Message'])
                                </div>
                            </div>
                            <div class="divider"></div>
                            <button type="button" class="filter__button" id="contactForm">
                                Submit
                            </button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection

@section('js')

    <script>
        $(document).ready(function () {
            //contact form
            $('#contactForm').click(function () {
                $.ajax({
                    type: 'POST',
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    url: '{{ route('user.contacts.store') }}',
                    data: {
                        'subject' : $('input[name="subject"]').val(),
                        'message' : $('textarea[name="message"]').val(),
                    },
                    beforeSend: function( jqXHR, settings ) {
                        $('#loader').removeClass('loading');
                    },

                    success: function( data, textStatus, jqXHR ) {
                        if( data.status == true ) {
                            swal("Success!", data.message, "success");
                            $('input[name="subject"]').val('');
                            $('textarea[name="message"]').val('');
                            setTimeout(function () {
                                window.location.href = '{{ route('user.contacts.index') }}';
                            }, 3000)

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

