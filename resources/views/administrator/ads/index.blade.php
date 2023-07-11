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

{{--                        @include('administrator.components.checkbox_delete_table')--}}

                        <div class="table-responsive product-table">
                            <table class="table table-hover ">
                                <thead>
                                <tr>
{{--                                    <th><input id="check_box_delete_all" type="checkbox" class="checkbox-parent" onclick="onSelectCheckboxDeleteItem()"></th>--}}
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Ads</th>
                                    <th>Share</th>
                                    <th>Config</th>
                                    <th>Created time</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($items as $item)
                                    <tr>
                                        <td>{{$item['id']}}</td>
                                        <td>{{$item['name']}}</td>
                                        <td>
                                            <ul>
                                                @foreach($item['ads'] as $itemAds)
                                                    <li>
                                                        {{$itemAds['name']}}
                                                    </li>
                                                @endforeach
                                            </ul>

                                        </td>

                                        <td>
                                            {{$item['share']}}%
                                        </td>
                                        <td>
                                            {{$item['number_config']}}
                                        </td>
                                        <td>
                                            {{ $item['created_at'] }}
                                        </td>
                                        <td>
                                            {{ $item['status']['name'] }}
                                        </td>

                                        <td>
                                            <a href="{{route('administrator.'.$prefixView.'.edit' , ['id'=> $item['id'] ])}}" title="View">
                                                <i class="fa-regular fa-eye"></i>
                                            </a>

                                            <a href="{{route('administrator.'.$prefixView.'.delete' , ['id'=> $item['id']])}}"
                                               data-url="{{route('administrator.'.$prefixView.'.delete' , ['id'=> $item['id']])}}"
                                               class="delete action_delete text-danger"
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
        .product-table span, .product-table p {
            color: #fff;
        }
    </style>

@endsection

@section('js')

@endsection

