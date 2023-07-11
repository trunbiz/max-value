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
                                    <th>Publisher</th>
                                    <th>Title</th>
                                    <th>Message</th>
                                    <th>Created_at</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($items as $index => $item)
                                    <tr>
                                        <td class="text-center">
                                            <input type="checkbox" class="checkbox-delete-item" value="{{$item->id}}">
                                        </td>
                                        <td>{{$index + 1}}</td>
                                        <td>
                                            @if(count(json_decode($item->user_id)) == count($users))
                                                All Publisher
                                            @else
                                                @foreach($users as $user)
                                                    @foreach(json_decode($item->user_id) as $item_user)
                                                        @if($user->id == $item_user)
                                                            {{ $user->email }}
                                                        @endif
                                                    @endforeach
                                                @endforeach
                                            @endif
                                        </td>
                                        <td>{{$item->title}}</td>
                                        <td>{{$item->description}}</td>
                                        <td>{{\App\Models\Formatter::getDateTime($item->created_at)}}</td>
                                        <td>
{{--                                            <a href="{{route('administrator.'.$prefixView.'.edit' , ['id'=> $item->id ])}}"--}}
{{--                                               class="btn btn-outline-secondary btn-sm edit" title="Edit">--}}
{{--                                                <i class="fa-solid fa-pen"></i>--}}
{{--                                            </a>--}}

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

@endsection

@section('js')

@endsection

