@extends('administrator.layouts.master')

@include('administrator.'.$prefixView.'.header')

@section('css')

@endsection

@section('content')

    <!-- Container-fluid starts-->
    <div class="container-fluid" id="contact__response">
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
                                        <button class="btn btn-success btn-sm">Answered</button>
                                    @elseif($item->status == 3)
                                        <button class="btn btn-danger btn-sm">Closed</button>
                                    @else
                                        <button class="btn btn-secondary btn-sm">Not Answer</button>
                                    @endif
                                </td>
                                <td>{{ $item->created_at }}</td>
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
                    <div class="card-header pb-0">
                        <h5 class="text-warning" style="font-size: 16px">{{ optional($item->user)->name }} - [{{ $item->created_at }}]</h5>
                    </div>
                    <div class="card-body">
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
                    <div class="card-body">
                        {{ $response->message }}
                    </div>
                </div>
            </div>
        </div>
        @endforeach

        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <form class="form theme-form" autocomplete="off">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3 row">
                                        @include('administrator.components.normal_textarea', ['label' => 'Message', 'name' => 'response'])
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-end">
                            <div class="col-sm-9 offset-sm-3">
                                <button type="button" class="btn btn-primary" onclick="sendRespone({{ $item->id }}, {{ $item->user_id }})">Send</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid Ends-->
@endsection

@section('js')

    <script>

        function sendRespone(id, user_id) {
            callAjax(
                'POST',
                '{{ route('administrator.contacts.send') }}',
                {
                    id : id,
                    user_id : user_id,
                    message : $('textarea[name="response"]').val(),
                },
                (response) => {
                    if(response.status == true){
                        Swal.fire(
                            {
                                icon: 'success',
                                title: response.message,
                            }
                        );
                        $('#contact__response').html(response.html);
                        $('#updateMes').html(response.total);
                    }else{
                        Swal.fire(
                            {
                                icon: 'error',
                                title: response.message,
                            }
                        );
                    }
                }
            )
        }

    </script>

@endsection
