@extends('user.layouts.master')

@include('user.'.$prefixView.'.header')

@section('css')

@endsection

@section('content')

    <!-- Container-fluid starts-->
    <div class="content-main" id="contact__response">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">Subject</th>
                                <th scope="col">Status</th>
                                <th scope="col">Date</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <th scope="row">{{ $item->subject }}</th>
                                <td>
                                    @if($item->status == 2)
                                        <div class="btn message approved">
                                            Answered
                                        </div>
                                    @elseif($item->status == 3)
                                        <div class="btn message blocked">
                                            Closed
                                        </div>
                                    @else
                                        <div class="btn message pending">
                                            Not Answer
                                        </div>
                                    @endif
                                </td>
                                <td style="display: block">{{ $item->created_at }}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="text-warning" style="font-size: 16px">{{ optional($item->user)->name }} - [{{ $item->created_at }}]</h5>
                    </div>
                    <div class="divider"></div>
                    <div class="card-header">
                        {{ $item->message }}
                    </div>
                </div>
            </div>
        </div>

        @foreach($responses as $response)
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header pb-0">
                            @if($response->user_id == 1)
                                <h5 class="text-primary" style="font-size: 16px">Support - [{{ $response->created_at }}]</h5>
                            @else
                                <h5 class="text-warning" style="font-size: 16px">{{ optional($response->user)->name}} - [{{ $response->created_at }}]</h5>
                            @endif
                        </div>
                        <div class="card-header">
                            {{ $response->message }}
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header pb-0">
                        <form autocomplete="off">
                            <div class="row form-group">
                                <div class="col-md-12 col-12">
                                    @include('user.components.require_textarea_normal' , ['name' => 'response' , 'label' => 'Response'])
                                </div>
                            </div>
                            <div class="divider"></div>
                            <button type="button" class="filter__button" onclick="sendRespone({{ $item->id  }}, {{ \Illuminate\Support\Facades\Auth::id() }})">
                                Submit
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid Ends-->
@endsection

<style>
    .message{
        font-size: 16px !important;
    }
</style>

@section('js')

<script>
    function sendRespone(id, user_id) {
        $.ajax({
            type: 'POST',
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: '{{ route('user.contacts.response') }}',
            data: {
                id : id,
                user_id : user_id,
                message : $('textarea[name="response"]').val(),
            },
            beforeSend: function( jqXHR, settings ) {
                $('#loader').removeClass('loading');
            },

            success: function( data, textStatus, jqXHR ) {
                if( data.status == true ) {
                    swal("Success!", data.message, "success");
                    $('#contact__response').html(data.html);
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
    }
</script>
@php
    $url = $_SERVER['REQUEST_URI'];
@endphp
@if(strpos(route('user.contacts.edit', ['id' => $item->id]), $url))
    <script>
        $('.sidebar__menu--main li:nth-child(6) > a').addClass('active');
    </script>
@else
    <script>
        $('.sidebar__menu--main li:nth-child(6) > a').removeClass('active');
    </script>
@endif

@endsection
