@extends('user.layouts.master')

@include('user.'.$prefixView.'.header')

@section('css')

@endsection

@section('content')

{{--    <div class="container-fluid list-products">--}}
{{--        <div class="row">--}}
{{--            <div class="col-xxl-6">--}}

{{--                <div>--}}
{{--                    @if (Session::has('success'))--}}
{{--                        <div class="text-center mb-3 p-3 bg-success">--}}
{{--                            <label class="text-white">--}}
{{--                                {{ Session::get('success') }}--}}
{{--                            </label>--}}
{{--                        </div>--}}
{{--                    @endif--}}
{{--                </div>--}}

{{--                <div class="card">--}}
{{--                    <div class="card-body">--}}

{{--                        <form action="{{route('user.'.$prefixView.'.store')}}" method="post" enctype="multipart/form-data">--}}
{{--                            @csrf--}}
{{--                            <div class="col-md-12">--}}

{{--                                @include('user.components.require_input_text' , ['name' => 'subject' , 'label' => 'Subject'])--}}

{{--                                @include('user.components.require_textarea_normal' , ['name' => 'message' , 'label' => 'Message'])--}}

{{--                                @include('user.components.button')--}}
{{--                            </div>--}}
{{--                        </form>--}}

{{--                    </div>--}}
{{--                </div>--}}

{{--            </div>--}}

{{--        </div>--}}
{{--    </div>--}}

{{--    <style>--}}
{{--        .product-table span, .product-table p {--}}
{{--            color: #fff;--}}
{{--        }--}}
{{--    </style>--}}

<div class="content-main">
    <div class="list__payment">
        <a href="{{ route('user.contacts.index') }}" class="list__payment--item active">
            Contact
        </a>
        <a href="{{ route('user.contacts.create') }}" class="list__payment--item">
            Create
        </a>
    </div>
    <div class="row">
        <div class="col-md-12 col-xl-12 col-12">
            <div class="card">
                <div class="card-header pb-0 export__html">
                    <h5>Contact</h5>
                </div>
                <div class="card-footer bg-white">
                    <div class="select__site">
                        <select class="chooseStatus" style="width: 10%" name="status" onchange="onSearchQuery()">
                            <option value="">Status</option>
                            <option value="1" {{ (isset($_GET['status']) && !empty($_GET['status']) && $_GET['status'] == 1) ? 'selected' : '' }}>Not Answer</option>
                            <option value="2" {{ (isset($_GET['status']) && !empty($_GET['status']) && $_GET['status'] == 2) ? 'selected' : '' }}>Answered</option>
                            <option value="3" {{ (isset($_GET['status']) && !empty($_GET['status']) && $_GET['status'] == 3) ? 'selected' : '' }}>Closed</option>
                        </select>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th width="10%" scope="col">STT</th>
                                <th width="20%" scope="col">Subject</th>
                                <th width="20%" scope="col">Content</th>
                                <th width="20%" scope="col">Status</th>
                                <th width="20%" scope="col">Created at</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php
                                $i = ($items->perPage() * $items->currentPage() - ($items->perPage() - 1));
                            @endphp
                            @foreach($items as $item)
                               <tr>
                                   <td>{{ $i++ }}</td>
                                   <td>
                                       <a style="color: #1D79C4" href="{{ route('user.contacts.edit', ['id' => $item->id]) }}">{{ $item->subject }}</a>
                                   </td>
                                   <td>{{ $item->message }}</td>
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
                                   <td style="display: block; padding: 25px 0;">{{ $item->created_at }}</td>
                               </tr>
                            @endforeach
                            </tbody>
                        </table>
                        @include('administrator.components.footer_table')
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
<style>
    .message{
        font-size: 16px !important;
    }
</style>
@section('js')

<script>
    function onSearchQuery() {
        addUrlParameterObjects([
            {name: "status", value: $('select[name="status"]').val()},
        ])
    }
</script>

@endsection

