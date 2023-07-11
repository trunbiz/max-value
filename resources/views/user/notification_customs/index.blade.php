@extends('user.layouts.master')

@include('user.'.$prefixView.'.header')

@section('css')

@endsection

@section('content')

    <div class="content-main">
        <div class="row">
            <div class="col-md-12 col-xl-12 col-12">
                <div class="card">
                    <div class="card-header pb-0 export__html">
                        <h5>{{ $title }}</h5>
                    </div>
                    <div class="card-footer bg-white">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th width="10%" scope="col">STT</th>
                                    <th width="20%" scope="col">Title</th>
                                    <th width="20%" scope="col">Description</th>
                                    <th width="20%" scope="col">Created at</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php
                                    $i = ($items->perPage() * $items->currentPage() - ($items->perPage() - 1));
                                @endphp
                                @foreach($items as $item)
                                    <tr class="{{ (isset($item) && !empty($item) && $item->viewed == 1 ? 'new__message' : '') }}">
                                        <td>{{ $i++ }}</td>
                                        <td>
                                            <a style="color: #1D79C4" href="{{ $item->link }}">{{ $item->title }}</a>
                                        </td>
                                        <td>{{\App\Models\Formatter::getShortDescriptionAttribute($item->description, 10)}}</td>
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

    <style>
        .product-table span, .product-table p {
            color: #fff;
        }
        .table-hover tbody tr.new__message {
           background-color: #eee;
        }
    </style>

@endsection

@section('js')

@endsection

