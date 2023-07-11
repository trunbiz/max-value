@extends('user.layouts.master')

@include('user.'.$prefixView.'.header')

@section('css')

@endsection

@section('content')

    <div class="content-main">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">Subject</th>
                                <th scope="col">Date</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <th scope="row">{{ $item->title }}</th>
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
                    <div class="card-body" style="min-height: 500px">
                        {{ $item->description }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')


@endsection
