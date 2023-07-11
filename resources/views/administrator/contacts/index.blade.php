@extends('administrator.layouts.master')

@include('administrator.'.$prefixView.'.header')

@section('css')

@endsection

@section('content')

    <div class="container-fluid list-products">
        <div class="row">
            <div class="col-12">

                <div class="card">

                    <div class="card-header">

                        @include('administrator.'.$prefixView.'.search')

                    </div>

                    <div class="card-body">

                        @include('administrator.components.checkbox_delete_table')

                        <div class="table-responsive product-table">
                            <table class="table table-hover ">
                                <thead>
                                <tr>
                                    <th><input id="check_box_delete_all" type="checkbox" class="checkbox-parent" onclick="onSelectCheckboxDeleteItem()"></th>
                                    <th>#</th>
                                    <th>User</th>
                                    <th>Email</th>
                                    <th>Subject</th>
                                    <th width="20%" class="text-center">Status</th>
                                    <th>Created at</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($items as $item)
                                    <tr class="{{ (isset($item) && !empty($item) && $item->status == 1 ? 'new__message' : '') }}">
                                        <td class="text-center">
                                            <input type="checkbox" class="checkbox-delete-item" value="{{$item->id}}">
                                        </td>
                                        <td>{{$item->id}}</td>
                                        <td>{{ optional($item->user)->name}}</td>
                                        <td>{{ optional($item->user)->email}}</td>
                                        <td>{{$item->subject}}</td>
                                        <td class="text-center">
                                            @if($item->status == 2)
                                                <button class="btn btn-success btn-sm">Answered</button>
                                            @elseif($item->status == 3)
                                                <button class="btn btn-danger btn-sm">Closed</button>
                                            @else
                                                <button class="btn btn-secondary btn-sm">Not Answer</button>
                                            @endif
                                        </td>

                                        <td>{{\App\Models\Formatter::getDateTime($item->created_at)}}</td>
                                        <td>

                                            <a href="{{route('administrator.'.$prefixView.'.response' , ['id'=> $item->id])}}"
                                               class="btn btn-outline-primary btn-sm"
                                               title="Response">
                                                <i class="fa-solid fa-pencil"></i>
                                            </a>
                                            <a href="{{route('administrator.'.$prefixView.'.delete' , ['id'=> $item->id])}}"
                                               data-url="{{route('administrator.'.$prefixView.'.delete' , ['id'=> $item->id])}}"
                                               class="btn btn-outline-danger btn-sm delete action_delete"
                                               title="Delete">
                                                <i class="fa-solid fa-x"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach

                                </tbody>
                            </table>
                        </div>
                        <div>
                            @include('administrator.components.footer_table')
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>

    <style>
        .table-hover tbody tr.new__message {
            background-color: rgba(99,98,231,0.1);
            --bs-table-accent-bg: unset;
        }
    </style>

@endsection

@section('js')

@endsection

