@extends('user.layouts.master')

@include('user.'.$prefixView.'.header')

@section('css')

@endsection

@section('content')

    <div class="container-fluid list-products">
        <div class="row">
            <div class="col-md-6">
                <div class="card p-3">
                    <div class="form-group mt-3">
                        <label>Name</label>
                        <input type="text" class="form-control" value="{{ $item['name'] }}" disabled>
                    </div>

                    <div class="form-group mt-3">
                        <label>Webiste</label>
                        <input type="text" class="form-control" value="{{ $item['site']['name'] }}" disabled>
                    </div>

                    <div class="form-group mt-3">
                        <label>Type advertises</label>
                        <input type="text" class="form-control" value="{{ $item['format']['name'] }}"
                               disabled>
                    </div>


                    <div class="form-group mt-3">
                        <label>Format</label>
                        <input type="text" class="form-control" value="{{ $item['format']['name'] }}"
                               disabled>
                    </div>

{{--                    @include('administrator.components.select_category' , ['label' => 'Status','name' => 'adverser_status_id' ,'html_category' => \App\Models\AdvertiseStatus::getCategory(isset($item) ? optional($item)->adverser_status_id : ''), 'can_create' => false,'readonly' => true])--}}

                    <div class="mt-3">
                        <label>Ad code:</label>
                        <ul class="nav nav-tabs" id="myTab" role="tablist">

                            @foreach($item['code'] as $index => $itemCode)
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link {{$index == 0 ? 'active' : ''}}" id="tab-{{$index}}" data-bs-toggle="tab" data-bs-target="#home-{{$index}}"
                                            type="button" role="tab" aria-controls="home" aria-selected="true">Standard tag
                                    </button>
                                </li>
                            @endforeach


                        </ul>
                        <div class="tab-content">

                            @foreach($item['code'] as $index => $itemCode)
                                <div class="tab-pane fade show {{$index == 0 ? 'active' : ''}}" id="home-{{$index}}" role="tabpanel" aria-labelledby="tab-{{$index}}">
                                <textarea class="form-control" name="{{$itemCode['title']}}" rows="10"
                                          placeholder="..." readonly>{{$itemCode['code']}}</textarea>
                                </div>
                            @endforeach

                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card p-3">
                    <div>
                        <p>
                            Information
                        </p>
                    </div>

                    @if(!empty($stat))
                        <div>
                            <div class="table-responsive product-table">
                                <table class="table table-hover">
                                    <tbody>

                                    <tr>
                                        <td><strong>dimension</strong></td>
                                        <td>{{$stat['dimension']}}</td>
                                    </tr>

                                    <tr>
                                        <td><strong>impressions</strong></td>
                                        <td>{{$stat['impressions']}}</td>
                                    </tr>

                                    <tr>
                                        <td><strong>impressions_unique</strong></td>
                                        <td>{{$stat['impressions_unique']}}</td>
                                    </tr>

                                    <tr>
                                        <td><strong>clicks</strong></td>
                                        <td>{{$stat['clicks']}}</td>
                                    </tr>

                                    <tr>
                                        <td><strong>clicks_unique</strong></td>
                                        <td>{{$stat['clicks_unique']}}</td>
                                    </tr>

                                    <tr>
                                        <td><strong>conversions</strong></td>
                                        <td>{{$stat['conversions']}}</td>
                                    </tr>

                                    <tr>
                                        <td><strong>subscriptions</strong></td>
                                        <td>{{$stat['subscriptions']}}</td>
                                    </tr>

                                    <tr>
                                        <td><strong>requests</strong></td>
                                        <td>{{$stat['requests']}}</td>
                                    </tr>

                                    <tr>
                                        <td><strong>requests_empty</strong></td>
                                        <td>{{$stat['requests_empty']}}</td>
                                    </tr>

                                    <tr>
                                        <td><strong>passback</strong></td>
                                        <td>{{$stat['passback']}}</td>
                                    </tr>

                                    <tr>
                                        <td><strong>cpm</strong></td>
                                        <td>${{$stat['cpm']}}</td>
                                    </tr>

                                    <tr>
                                        <td><strong>cpc</strong></td>
                                        <td>${{$stat['cpc']}}</td>
                                    </tr>

                                    <tr>
                                        <td><strong>cpa</strong></td>
                                        <td>${{$stat['cpa']}}</td>
                                    </tr>

                                    <tr>
                                        <td><strong>amount</strong></td>
                                        <td>${{$stat['amount']}}</td>
                                    </tr>

                                    <tr>
                                        <td><strong>amount_pub</strong></td>
                                        <td>${{$stat['amount_pub']}}</td>
                                    </tr>

                                    </tbody>
                                </table>
                            </div>

                        </div>

                    @else
                        <div>
                            <strong>No data!</strong>
                        </div>
                    @endif

                </div>
            </div>

        </div>
    </div>
@endsection

@section('js')


@endsection
