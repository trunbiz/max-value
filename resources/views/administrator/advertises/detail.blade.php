@extends('administrator.layouts.master')

@include('administrator.'.$prefixView.'.header')

@section('css')

@endsection

@section('content')

    <div class="container-fluid list-products">

        @if (Session::has('error'))
            <div class="card p-3 text-danger text-center">
                {{ Session::get('error') }}
            </div>
        @endif

        <div class="row">
            <div class="col-md-6">
                <div class="card p-3" style="height: 100%;">
                    <div class="row">
                        <h3 class="mb-3">
                            Website
                        </h3>
                        <div class="col-3">
                            ID:
                        </div>
                        <div class="col-9">
                            {{ $site['id'] }}
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-3">
                            Webiste:
                        </div>
                        <div class="col-9">
                            <a href="{{$site['url']}}">
                                {{$site['name']}}
                            </a>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-3">
                            Created Date:
                        </div>
                        <div class="col-9">
                            {{ $site['created_at'] }}
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-3">
                            Account manager:
                        </div>
                        <div class="col-9">
                            {{$site['publisher']['name']}}
                        </div>
                    </div>

                </div>
            </div>

            <div class="col-md-6">
                <div class="card p-3" style="height: 100%;">
                    <form action="{{route('administrator.advertises.detail.zone.update', ['id' => $item['id']])}}"
                          method="post"
                          enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <h3 class="mb-3">
                                Zone
                            </h3>

                            <div class="col-3">
                                ID: @include('administrator.components.lable_require')
                            </div>
                            <div class="col-9">
                                {{ $item['id']}}
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-3">
                                Name: @include('administrator.components.lable_require')
                            </div>
                            <div class="col-9">
                                <input type="text" autocomplete="off" name="name" class="form-control"
                                       value="{{ $item['name']}}">
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-3">
                                Share(%): @include('administrator.components.lable_require')
                            </div>
                            <div class="col-9">
                                <input type="text" autocomplete="off" name="share" class="form-control number" required
                                       value="{{$item['revenue_rate']}}">
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-3">
                                Status: @include('administrator.components.lable_require')
                            </div>
                            <div class="col-9">
                                <div class="d-flex float-start" style="cursor: pointer;"
                                     onclick="onSubmitChangeStatusZone('{{$item['id']}}','7000')">
                                    <span
                                        style="display: flex;align-items: center;{{$item['status']['id'] == 7000 ? "background-color: #d0ffef" : ''}};padding: 5px;border-radius: 15px;"><a
                                            class='ms-1 me-1'>Approved</a><i class="fa-solid fa-rotate"></i></span>
                                </div>
                                <div class="d-flex float-start ms-2" style="cursor: pointer;"
                                     onclick="onSubmitChangeStatusZone('{{$item['id']}}','7010')">
                                    <span
                                        style="display: flex;align-items: center;{{$item['status']['id'] == 7010 ? "background-color: #fffcf9" : ''}};padding: 5px;border-radius: 15px;"><a
                                            class='ms-1 me-1'>Pending</a><i class="fa-solid fa-rotate"></i></span>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-12">
                                <button class="btn btn-success border">Update</button>
                                <button type="button" class="btn btn-primary border" {{ $item['status']['id'] == 7000 ? 'onclick=getCode('. $item["id"] . ')' : 'style=cursor:no-drop;opacity:0.5' }}>Get code</button>
                            </div>
                        </div>

                    </form>

                </div>
            </div>

        </div>
            @if($item['status']['id'] == 7000)
            <div class="mt-3 mb-3">
                Configs
                <button onclick="onInsertConfig()" class="btn-success rounded-circle"
                        style="border: 0;width: 25px;height: 25px;">+
                </button>
            </div>
            @endif
            <div class="card">
                <div class="accordion" id="accordionPanelsStayOpenExample">
                    @foreach($campaigns as $index => $itemcampaign)
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="panelsStayOpen-{{$itemcampaign['id']}}-">
                                <button class="accordion-button {{$index != 0 ? 'collapsed' : ''}}" type="button"
                                        data-bs-toggle="collapse"
                                        data-bs-target="#panelsStayOpen-{{$itemcampaign['id']}}"
                                        aria-expanded="{{$index == 0 ? 'true' : 'false'}}"
                                        aria-controls="panelsStayOpen-{{$itemcampaign['id']}}">
                                    {{$itemcampaign['advertiser']['name']}}
                                    - Order: {{$itemcampaign['order']}} - Count: {{$itemcampaign['counter_percent']}}% -
                                    ID Camp: {{$itemcampaign['id']}}
                                </button>
                            </h2>
                            <div id="panelsStayOpen-{{$itemcampaign['id']}}"
                                 class="accordion-collapse collapse {{$index == 0 ? 'show' : ''}}"
                                 aria-labelledby="panelsStayOpen-{{$itemcampaign['id']}}">
                                <div class="accordion-body">
                                    <form
                                        action="{{route('administrator.ads.advertiser.update', ['id' => $itemcampaign['id']])}}"
                                        method="post"
                                        enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <div class="row">
                                            <input value="{{$itemcampaign['id']}}" name="campaign_id" class="hidden">
                                            <input value="{{$itemcampaign['ad_id']}}" name="ad_id" class="hidden">

                                            <div class="col-md-6">
                                                <div class="p-3 border">
                                                    <div class="row">
                                                        <div class="col-3">
                                                            Partner: @include('administrator.components.lable_require')
                                                        </div>
                                                        <div class="col-9">
                                                            <div class="form-group">
                                                                <select
                                                                    class="form-control choose_value select2_init @error('advertiser_api_id') is-invalid @enderror"
                                                                    required
                                                                    name="advertiser_api_id">
                                                                    @foreach($advertisers as $itemAdvertisers)
                                                                        <option
                                                                            value="{{$itemAdvertisers['id']}}" {{$itemAdvertisers['id'] == $itemcampaign['advertiser']['id'] ? 'selected' : ''}}>{{$itemAdvertisers['name']}}</option>
                                                                    @endforeach

                                                                </select>
                                                                @error('advertiser_api_id')
                                                                <div class="alert alert-danger">{{$message}}</div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row mt-3">
                                                        <div class="col-3">
                                                            Partner Unit
                                                            ID: @include('administrator.components.lable_require')
                                                        </div>
                                                        <div class="col-9">
                                                            <div class="form-group">
                                                                <input type="text" autocomplete="off"
                                                                       class="form-control number"
                                                                       value="{{$itemcampaign['advertiser']['id']}}"
                                                                       required readonly>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row mt-3">
                                                        <div class="col-3">
                                                            Count percent
                                                            (%): @include('administrator.components.lable_require')
                                                        </div>
                                                        <div class="col-9">
                                                            <div class="form-group">
                                                                @include('administrator.components.require_input_number', ['name' => 'count_percent', 'value' => optional(\App\Models\Setting::first())->count ?? 80, 'readonly' => true])
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row mt-3">
                                                        <div class="col-3">
                                                            Ordered:
                                                        </div>
                                                        <div class="col-9">
                                                            @include('administrator.components.require_input_text', ['name' => 'order', 'value' => $itemcampaign['order']])
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="mt-3">
                                                    <input type="hidden" name="typezone" value="{{ (!empty($itemcampaign['ad_infor']['format']['id'])) ? $itemcampaign['ad_infor']['format']['id'] : '' }}">
                                                    <label>Type zone: </label>
                                                    <span>{{ (!empty($itemcampaign['ad_infor']['format']['id'])) ? $itemcampaign['ad_infor']['format']['name'] : '' }}</span>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div>
                                                    <label>Geo: @include('administrator.components.lable_require')</label>
                                                    <ul class="nav nav-tabs" id="myTab-{{$itemcampaign['id']}}"
                                                        role="tablist">
                                                        <li class="nav-item" role="presentation" onclick="chooseSelect(0)">
                                                            <button class="nav-link {{ (empty($itemcampaign['continent']) ? 'active' : '') }}"
                                                                    id="tab-{{$itemcampaign['id']}}-0"
                                                                    data-bs-toggle="tab"
                                                                    data-bs-target="#home-{{$itemcampaign['id']}}-0"
                                                                    type="button" role="tab" aria-controls="home"
                                                                    aria-selected="true">All
                                                            </button>
                                                        </li>

                                                        <li class="nav-item" role="presentation" onclick="chooseSelect(1)">
                                                            <button class="nav-link {{ (isset($itemcampaign['continent']) && !empty($itemcampaign['continent'] && $itemcampaign['continent'] == 1) ? 'active' : '') }}"
                                                                    id="tab-{{$itemcampaign['id']}}-1"
                                                                    data-bs-toggle="tab"
                                                                    data-bs-target="#home-{{$itemcampaign['id']}}-1"
                                                                    type="button" role="tab" aria-controls="home"
                                                                    aria-selected="true">Asia
                                                            </button>
                                                        </li>

                                                        <li class="nav-item" role="presentation" onclick="chooseSelect(2)">
                                                            <button class="nav-link {{ (isset($itemcampaign['continent']) && !empty($itemcampaign['continent'] && $itemcampaign['continent'] == 2) ? 'active' : '') }}" id="tab-{{$itemcampaign['id']}}-2"
                                                                    data-bs-toggle="tab"
                                                                    data-bs-target="#home-{{$itemcampaign['id']}}-2"
                                                                    type="button" role="tab" aria-controls="home"
                                                                    aria-selected="true">Europe
                                                            </button>
                                                        </li>
                                                        <li class="nav-item" role="presentation" onclick="chooseSelect(3)">
                                                            <button class="nav-link {{ (isset($itemcampaign['continent']) && !empty($itemcampaign['continent'] && $itemcampaign['continent'] == 3) ? 'active' : '') }}" id="tab-{{$itemcampaign['id']}}-3"
                                                                    data-bs-toggle="tab"
                                                                    data-bs-target="#home-{{$itemcampaign['id']}}-3"
                                                                    type="button" role="tab" aria-controls="home"
                                                                    aria-selected="true">Africa
                                                            </button>
                                                        </li>
                                                        <li class="nav-item" role="presentation" onclick="chooseSelect(4)">
                                                            <button class="nav-link {{ (isset($itemcampaign['continent']) && !empty($itemcampaign['continent'] && $itemcampaign['continent'] == 4) ? 'active' : '') }}" id="tab-{{$itemcampaign['id']}}-4"
                                                                    data-bs-toggle="tab"
                                                                    data-bs-target="#home-{{$itemcampaign['id']}}-4"
                                                                    type="button" role="tab" aria-controls="home"
                                                                    aria-selected="true">North America
                                                            </button>
                                                        </li>
                                                        <li class="nav-item" role="presentation" onclick="chooseSelect(5)">
                                                            <button class="nav-link {{ (isset($itemcampaign['continent']) && !empty($itemcampaign['continent'] && $itemcampaign['continent'] == 5) ? 'active' : '') }}" id="tab-{{$itemcampaign['id']}}-5"
                                                                    data-bs-toggle="tab"
                                                                    data-bs-target="#home-{{$itemcampaign['id']}}-5"
                                                                    type="button" role="tab" aria-controls="home"
                                                                    aria-selected="true">South America
                                                            </button>
                                                        </li>
                                                        <li class="nav-item" role="presentation" onclick="chooseSelect(6)">
                                                            <button class="nav-link {{ (isset($itemcampaign['continent']) && !empty($itemcampaign['continent'] && $itemcampaign['continent'] == 6) ? 'active' : '') }}" id="tab-{{$itemcampaign['id']}}-6"
                                                                    data-bs-toggle="tab"
                                                                    data-bs-target="#home-{{$itemcampaign['id']}}-6"
                                                                    type="button" role="tab" aria-controls="home"
                                                                    aria-selected="true">Australia and Oceania
                                                            </button>
                                                        </li>
                                                        <li class="nav-item" role="presentation" onclick="chooseSelect(7)">
                                                            <button class="nav-link {{ (isset($itemcampaign['continent']) && !empty($itemcampaign['continent'] && $itemcampaign['continent'] == 7) ? 'active' : '') }}" id="tab-{{$itemcampaign['id']}}-7"
                                                                    data-bs-toggle="tab"
                                                                    data-bs-target="#home-{{$itemcampaign['id']}}-7"
                                                                    type="button" role="tab" aria-controls="home"
                                                                    aria-selected="true">Custom
                                                            </button>
                                                        </li>
                                                    </ul>

                                                    @if($itemcampaign['continent'] == 7)
                                                        <div class="tab-content">
                                                            @else
                                                                <div class="tab-content" style="display: none">@endif
                                                                    <div class="tab-pane fade show active"
                                                                         id="home-{{$itemcampaign['id']}}-0" role="tabpanel"
                                                                         aria-labelledby="tab-{{$itemcampaign['id']}}-0">
                                                                        <ul class="list list-group"
                                                                            style="display: block;overflow-y: auto;max-height: 212px;">
                                                                            <select class="col-sm-12 select2_init" name="country[]" multiple="multiple">
                                                                                @foreach($countries as $country)
                                                                                    <option value="{{ $country->geoname }}" {{in_array($country->geoname,$itemcampaign['geo']) ? 'selected' : ''}}>{{ $country->name }}</option>
                                                                                @endforeach
                                                                            </select>
                                                                            <input type="hidden" name="continent_id" value="{{ $itemcampaign['continent'] }}">
                                                                        </ul>
                                                                    </div>
                                                                    <div class="tab-pane fade show"
                                                                         id="home-{{$itemcampaign['id']}}-1" role="tabpanel"
                                                                         aria-labelledby="tab-{{$itemcampaign['id']}}-1">
                                                                        <ul class="list list-group"
                                                                            style="display: block;overflow-y: auto;max-height: 212px;">
                                                                        </ul>
                                                                    </div>
                                                                    <div class="tab-pane fade show"
                                                                         id="home-{{$itemcampaign['id']}}-2" role="tabpanel"
                                                                         aria-labelledby="tab-{{$itemcampaign['id']}}-2">
                                                                        <ul class="list list-group"
                                                                            style="display: block;overflow-y: auto;max-height: 212px;">
                                                                        </ul>
                                                                    </div>
                                                                    <div class="tab-pane fade show"
                                                                         id="home-{{$itemcampaign['id']}}-3" role="tabpanel"
                                                                         aria-labelledby="tab-{{$itemcampaign['id']}}-3">
                                                                        <ul class="list list-group"
                                                                            style="display: block;overflow-y: auto;max-height: 212px;">

                                                                        </ul>
                                                                    </div>
                                                                    <div class="tab-pane fade show"
                                                                         id="home-{{$itemcampaign['id']}}-4" role="tabpanel"
                                                                         aria-labelledby="tab-{{$itemcampaign['id']}}-4">
                                                                        <ul class="list list-group"
                                                                            style="display: block;overflow-y: auto;max-height: 212px;">

                                                                        </ul>
                                                                    </div>
                                                                    <div class="tab-pane fade show"
                                                                         id="home-{{$itemcampaign['id']}}-5" role="tabpanel"
                                                                         aria-labelledby="tab-{{$itemcampaign['id']}}-5">
                                                                        <ul class="list list-group"
                                                                            style="display: block;overflow-y: auto;max-height: 212px;">

                                                                        </ul>
                                                                    </div>
                                                                    <div class="tab-pane fade shcountryow"
                                                                         id="home-{{$itemcampaign['id']}}-6" role="tabpanel"
                                                                         aria-labelledby="tab-{{$itemcampaign['id']}}-6">
                                                                        <ul class="list list-group"
                                                                            style="display: block;overflow-y: auto;max-height: 212px;">
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                        </div>

                                                        <div class="mt-3">
                                                            <label>Operating system: @include('administrator.components.lable_require')</label>
                                                            <select class="form-control select2_init" name="os[]" multiple>
                                                                <option value="5" {{in_array(5,$itemcampaign['os']) ? 'selected' : ''}}>Android</option>
                                                                <option value="12" {{in_array(12,$itemcampaign['os']) ? 'selected' : ''}}>BlackBerry OS</option>
                                                                <option value="14" {{in_array(14,$itemcampaign['os']) ? 'selected' : ''}}>Chrome OS</option>
                                                                <option value="15" {{in_array(15,$itemcampaign['os']) ? 'selected' : ''}}>Firefox OS</option>
                                                                <option value="11" {{in_array(11,$itemcampaign['os']) ? 'selected' : ''}}>GNU/Linux</option>
                                                                <option value="4" {{in_array(4,$itemcampaign['os']) ? 'selected' : ''}}>IOS</option>
                                                                <option value="20" {{in_array(20,$itemcampaign['os']) ? 'selected' : ''}}>Ipad OS</option>
                                                                <option value="3" {{in_array(3,$itemcampaign['os']) ? 'selected' : ''}}>Linux</option>
                                                                <option value="2" {{in_array(2,$itemcampaign['os']) ? 'selected' : ''}}>Mac OS</option>
                                                                <option value="16" {{in_array(16,$itemcampaign['os']) ? 'selected' : ''}}>MocorDroid</option>
                                                                <option value="17" {{in_array(17,$itemcampaign['os']) ? 'selected' : ''}}>Tizen</option>
                                                                <option value="18" {{in_array(18,$itemcampaign['os']) ? 'selected' : ''}}>Ubuntu</option>
                                                                <option value="1" {{in_array(1,$itemcampaign['os']) ? 'selected' : ''}}>Windows</option>
                                                                <option value="6" {{in_array(6,$itemcampaign['os']) ? 'selected' : ''}}>Windows Phone</option>
                                                                <option value="0" {{in_array(0,$itemcampaign['os']) ? 'selected' : ''}}>Other</option>
                                                            </select>
                                                        </div>

                                                        <div class="mt-3">
                                                            <label>Device: @include('administrator.components.lable_require')</label>
                                                            <select class="form-control select2_init" name="devices[]" multiple>
                                                                <option value="7" {{in_array(7,$itemcampaign['device']) ? 'selected' : ''}}>Car browser</option>
                                                                <option value="5" {{in_array(5,$itemcampaign['device']) ? 'selected' : ''}}>Console</option>
                                                                <option value="1" {{in_array(1,$itemcampaign['device']) ? 'selected' : ''}}>Desktop</option>
                                                                <option value="4" {{in_array(4,$itemcampaign['device']) ? 'selected' : ''}}>Feature phone</option>
                                                                <option value="8" {{in_array(8,$itemcampaign['device']) ? 'selected' : ''}}>Phablet</option>
                                                                <option value="2" {{in_array(2,$itemcampaign['device']) ? 'selected' : ''}}>Smartphone</option>
                                                                <option value="3" {{in_array(3,$itemcampaign['device']) ? 'selected' : ''}}>Tablet</option>
                                                                <option value="6" {{in_array(6,$itemcampaign['device']) ? 'selected' : ''}}>TV</option>
                                                                <option value="0" {{in_array(0,$itemcampaign['device']) ? 'selected' : ''}}>Other</option>
                                                            </select>
                                                        </div>
                                                        <div class="mt-3">
                                                            <label>Frequency capping</label>

                                                            <div class="row">
                                                                <div class="col-md-3 col-6">
                                                                    <div>
                                                                        <label>Counter type: @include('administrator.components.lable_require')</label>
                                                                        <select class="form-control select2_init"
                                                                                name="fc_counter">
                                                                            <option value="1" {{$itemcampaign['infor_frequency_capping']['fc_counter'] == 1 ? 'selected' : ''}}>Impressions</option>
                                                                            <option value="2" {{$itemcampaign['infor_frequency_capping']['fc_counter'] == 2 ? 'selected' : ''}}>Clicks</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3 col-6">
                                                                    <div>
                                                                        <label>Limit: @include('administrator.components.lable_require')</label>
                                                                        <input type="text" autocomplete="off" name="fc_limit"
                                                                               class="form-control number " value="{{$itemcampaign['infor_frequency_capping']['fc_limit']}}" required>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3 col-6">
                                                                    <div>
                                                                        <label>Time interval</label>
                                                                        <select class="form-control select2_init"
                                                                                name="fc_interval">
                                                                            <option value="1" {{str_contains($itemcampaign['infor_frequency_capping']['fc_interval'], "per hour") ? 'selected' : ''}}>per hour</option>
                                                                            <option value="2" {{str_contains($itemcampaign['infor_frequency_capping']['fc_interval'], "per 2 hours") ? 'selected' : ''}}>per 2 hours</option>
                                                                            <option value="4" {{str_contains($itemcampaign['infor_frequency_capping']['fc_interval'], "per 4 hours") ? 'selected' : ''}}>per 4 hours</option>
                                                                            <option value="6" {{str_contains($itemcampaign['infor_frequency_capping']['fc_interval'], "per 6 hours") ? 'selected' : ''}}>per 6 hours</option>
                                                                            <option value="12" {{str_contains($itemcampaign['infor_frequency_capping']['fc_interval'], "per 12 hours") ? 'selected' : ''}}>per 12 hours</option>
                                                                            <option value="24" {{str_contains($itemcampaign['infor_frequency_capping']['fc_interval'], "per day") ? 'selected' : ''}}>per day</option>
                                                                            <option value="168" {{str_contains($itemcampaign['infor_frequency_capping']['fc_interval'], "per week") ? 'selected' : ''}}>per week</option>
                                                                            <option value="720" {{str_contains($itemcampaign['infor_frequency_capping']['fc_interval'], "per month") ? 'selected' : ''}}>per month</option>
                                                                            <option value="8640" {{str_contains($itemcampaign['infor_frequency_capping']['fc_interval'], "per year") ? 'selected' : ''}}>per year</option>
                                                                            <option value="100010" {{str_contains($itemcampaign['infor_frequency_capping']['fc_interval'], "per 10 sec") ? 'selected' : ''}}>per 10 sec</option>
                                                                            <option value="100015" {{str_contains($itemcampaign['infor_frequency_capping']['fc_interval'], "per 15 sec") ? 'selected' : ''}}>per 15 sec</option>
                                                                            <option value="100030" {{str_contains($itemcampaign['infor_frequency_capping']['fc_interval'], "per 30 sec") ? 'selected' : ''}}>per 30 sec</option>
                                                                            <option value="100060" {{str_contains($itemcampaign['infor_frequency_capping']['fc_interval'], "per 1 min") ? 'selected' : ''}}>per 1 min</option>
                                                                            <option value="100180" {{str_contains($itemcampaign['infor_frequency_capping']['fc_interval'], "per 3 min") ? 'selected' : ''}}>per 3 min</option>
                                                                            <option value="100300" {{str_contains($itemcampaign['infor_frequency_capping']['fc_interval'], "per 5 min") ? 'selected' : ''}}>per 5 min</option>
                                                                            <option value="100600" {{str_contains($itemcampaign['infor_frequency_capping']['fc_interval'], "per 10 min") ? 'selected' : ''}}>per 10 min</option>
                                                                            <option value="100900" {{str_contains($itemcampaign['infor_frequency_capping']['fc_interval'], "per 15 min") ? 'selected' : ''}}>per 15 min</option>
                                                                            <option value="101200" {{str_contains($itemcampaign['infor_frequency_capping']['fc_interval'], "per 20 min") ? 'selected' : ''}}>per 20 min</option>
                                                                            <option value="101800" {{str_contains($itemcampaign['infor_frequency_capping']['fc_interval'], "per 30 min") ? 'selected' : ''}}>per 30 min</option>
                                                                            <option value="102700" {{str_contains($itemcampaign['infor_frequency_capping']['fc_interval'], "per 45 min") ? 'selected' : ''}}>per 45 min</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3 col-6">
                                                                    <div>
                                                                        <label>Mode: @include('administrator.components.lable_require')</label>
                                                                        <select class="form-control select2_init"
                                                                                name="fc_mode">
                                                                            <option value="1" {{$itemcampaign['infor_frequency_capping']['fc_mode'] == 1 ? 'selected' : ''}}>Visitor</option>
                                                                            <option value="2" {{$itemcampaign['infor_frequency_capping']['fc_mode'] == 2 ? 'selected' : ''}}>IP address</option>
                                                                        </select>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </div>
                                                </div>

                                                <div class="col-12">
                                                    <div class="mt-3">
                                                        <div class="form-group">
                                                            @if(!empty($itemcampaign['ad_infor']['details']['content_html']))
                                                                <label>Content HTML: @include('administrator.components.lable_require')</label>
                                                                <textarea name="content_html"
                                                                          class="form-control @error('content_html') is-invalid @enderror"
                                                                          rows="10"
                                                                          required> {{ optional(optional($itemcampaign['ad_infor'])['details'])['content_html']}}</textarea>
                                                                @error('content_html')
                                                                <div class="alert alert-danger">{{$message}}</div>
                                                                @enderror
                                                            @else
                                                                <label>Bids: @include('administrator.components.lable_require')</label>
                                                                <textarea name="bids"
                                                                          class="form-control @error('bids') is-invalid @enderror"
                                                                          rows="10"
                                                                          required> {{ optional(optional($itemcampaign['ad_infor'])['details'])['bids']}}</textarea>
                                                                @error('bids')
                                                                <div class="alert alert-danger">{{$message}}</div>
                                                                @enderror
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-12">
                                                    <div class="mt-3">
                                                        <button class="btn btn-primary">Update now</button>
                                                        <button class="btn btn-danger" type="button"
                                                                onclick="onSubmitDeleteCampaign('{{$itemcampaign['id']}}')">
                                                            Delete
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>

            <div id="container_insert">

            </div>

    </div>
    <!-- Modal get code -->
    <div class="modal" id="getCode" tabindex="-1" role="dialog" aria-labelledby="getCode"></div>
@endsection

@section('js')

    <script>
        //get code
        function getCode(id) {
            var $this = $('#getCode');
            $this.find('form').attr('data-id', id);
            callAjax(
                "GET",
                "{{ route('user.ajax.getcode') }}" + "?id="+id,{},
                (response) => {
                    let html = '';
                    $this.find('.getcode__info--name input').val(response.name);
                    $this.html(response.html);
                    $this.modal('show');
                }

            )
        }

        function onSubmitDeleteCampaign(id) {

            if (confirm("Xác nhận xóa") == true) {
                $.ajax({
                    type: "DELETE",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    cache: false,
                    data: {
                        id: id,
                    },
                    url: "{{route('ajax.administrator.campaign.delete')}}",
                    beforeSend: function () {
                        showLoading()
                    },
                    success: function (response) {
                        window.location.reload()
                    },
                    error: function (err) {
                        hideLoading()
                        Swal.fire(
                            {
                                icon: 'error',
                                title: err.responseText,
                            }
                        );
                        console.log(err)
                    },
                });
            }
        }

        function onSubmitChangeStatusZone(id, id_status) {
            $.ajax({
                type: "PUT",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                cache: false,
                data: {
                    zone_id: id,
                    zone_status_id: id_status,
                },
                url: "{{route('ajax.administrator.zone.update')}}",
                beforeSend: function () {
                    showLoading()
                },
                success: function (response) {
                    window.location.reload()
                },
                error: function (err) {
                    hideLoading()
                    Swal.fire(
                        {
                            icon: 'error',
                            title: err.responseText,
                        }
                    );
                    console.log(err)
                },
            });
        }

        function onInsertConfig() {

            const advertisers = @json($advertisers);

            let htmlOptions = ''

            for (let i = 0; i < advertisers.length; i++) {
                htmlOptions += `<option value="${advertisers[i]['id']}">${advertisers[i]['name']}</option>`
            }

            $('#container_insert').html(`<div class="card p-3">
<form action="{{route('administrator.advertises.detail.config.store', ['id' => $item['id']])}}" method="post"
                          enctype="multipart/form-data">
                        @csrf
            <div class="row">

                                                    <div class="col-md-6">
                                                        <div class="p-3 border">
                                                            <div class="row">
                                                                <div class="col-3">
                                                                    Partner: @include('administrator.components.lable_require')
            </div>
            <div class="col-9">
                <div class="form-group">
                    <select class="form-control choose_value select2_init" required name="idadvertiser">
${htmlOptions}

                                                            </select>
                                                                                                                    </div>
                                                    </div>
                                                </div>

                                                <div class="row mt-3">
                                                    <div class="col-3">
                                                        Count percent (%): @include('administrator.components.lable_require')
            </div>
            <div class="col-9">
                <div class="form-group">
                    <div class="form-group mt-3">
<input type="text" autocomplete="off" name="count_percent" class="form-control number " value="{{optional(\App\Models\Setting::first())->count ?? 80}}" required readonly>
</div>
                </div>
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-3">
                Ordered: @include('administrator.components.lable_require')
            </div>
            <div class="col-9">
                <div class="form-group">
                    <input type="text" autocomplete="off" name="order" class="form-control " value="0" required>
                </div>
            </div>
        </div>

    </div>
     <div class="mt-3">
                                                    <label>Select type zone: </label>
                                                    <select class="form-control select2_init" name="typezone" onChange="chooseTypeZone()">
                                                        <option value="37">Prebid</option>
                                                        <option value="3">HTML/JS</option>
                                                    </select>
                                                </div>
</div>

<div class="col-md-6">
    <div>
    <div>
                                                    <label>Geo: @include('administrator.components.lable_require')</label>
                                                    <ul class="nav nav-tabs" id="myTab-1"
                                                        role="tablist">
                                                        <li class="nav-item" role="presentation" onclick="chooseSelect(0)">
                                                            <button class="nav-link active"
                                                                    id="tab-1-0"
                                                                    data-bs-toggle="tab"
                                                                    data-bs-target="#home-1-0"
                                                                    type="button" role="tab" aria-controls="home"
                                                                    aria-selected="true">All
                                                            </button>
                                                        </li>

                                                        <li class="nav-item" role="presentation" onclick="chooseSelect(1)">
                                                            <button class="nav-link"
                                                                    id="tab-1-1"
                                                                    data-bs-toggle="tab"
                                                                    data-bs-target="#home-1-1"
                                                                    type="button" role="tab" aria-controls="home"
                                                                    aria-selected="true">Asia
                                                            </button>
                                                        </li>

                                                        <li class="nav-item" role="presentation" onclick="chooseSelect(2)">
                                                            <button class="nav-link" id="tab-1-2"
                                                                    data-bs-toggle="tab"
                                                                    data-bs-target="#home-1-2"
                                                                    type="button" role="tab" aria-controls="home"
                                                                    aria-selected="true">Europe
                                                            </button>
                                                        </li>
                                                        <li class="nav-item" role="presentation" onclick="chooseSelect(3)">
                                                            <button class="nav-link" id="tab-1-3"
                                                                    data-bs-toggle="tab"
                                                                    data-bs-target="#home-1-3"
                                                                    type="button" role="tab" aria-controls="home"
                                                                    aria-selected="true">Africa
                                                            </button>
                                                        </li>
                                                        <li class="nav-item" role="presentation" onclick="chooseSelect(4)">
                                                            <button class="nav-link" id="tab-1-4"
                                                                    data-bs-toggle="tab"
                                                                    data-bs-target="#home-1-4"
                                                                    type="button" role="tab" aria-controls="home"
                                                                    aria-selected="true">North America
                                                            </button>
                                                        </li>
                                                        <li class="nav-item" role="presentation" onclick="chooseSelect(5)">
                                                            <button class="nav-link" id="tab-1-5"
                                                                    data-bs-toggle="tab"
                                                                    data-bs-target="#home-1-5"
                                                                    type="button" role="tab" aria-controls="home"
                                                                    aria-selected="true">South America
                                                            </button>
                                                        </li>
                                                        <li class="nav-item" role="presentation" onclick="chooseSelect(6)">
                                                            <button class="nav-link" id="tab-1-6"
                                                                    data-bs-toggle="tab"
                                                                    data-bs-target="#home-1-6"
                                                                    type="button" role="tab" aria-controls="home"
                                                                    aria-selected="true">Australia and Oceania
                                                            </button>
                                                        </li>
                                                        <li class="nav-item" role="presentation" onclick="chooseSelect(7)">
                                                            <button class="nav-link" id="tab-1-7"
                                                                    data-bs-toggle="tab"
                                                                    data-bs-target="#home-1-7"
                                                                    type="button" role="tab" aria-controls="home"
                                                                    aria-selected="true">Custom
                                                            </button>
                                                        </li>
                                                    </ul>

                                                    <div class="tab-content" style="display: none">
                                                        <div class="tab-pane fade show active"
                                                             id="home-1-0" role="tabpanel"
                                                             aria-labelledby="tab-1-0">
                                                            <ul class="list list-group"
                                                                style="display: block;overflow-y: auto;max-height: 212px;">
                                                                <select class="select2_init col-sm-12" name="country[]" multiple="multiple">
 @foreach($countries as $country)
            <option value="{{ $country->geoname }}" selected>{{ $country->name }}</option>
                                                                    @endforeach
            </select>
             <input type="hidden" name="continent_id" value="0">
        </ul>

    </div>
    <div class="tab-pane fade show"
         id="home-1-1" role="tabpanel"
                                                             aria-labelledby="tab-1-1">
                                                            <ul class="list list-group"
                                                                style="display: block;overflow-y: auto;max-height: 212px;">
                                                                <select class="col-sm-12" name="country[]" multiple="multiple">

            </select>
        </ul>
    </div>
    <div class="tab-pane fade show"
         id="home-1-2" role="tabpanel"
                                                             aria-labelledby="tab-1-2">
                                                            <ul class="list list-group"
                                                                style="display: block;overflow-y: auto;max-height: 212px;">
                                                                <select class="col-sm-12" name="country[]" multiple="multiple">

            </select>
        </ul>
    </div>
    <div class="tab-pane fade show"
         id="home-1-3" role="tabpanel"
                                                             aria-labelledby="tab-1-3">
                                                            <ul class="list list-group"
                                                                style="display: block;overflow-y: auto;max-height: 212px;">
                                                                <select class="col-sm-12" name="country[]" multiple="multiple">

            </select>
        </ul>
    </div>
    <div class="tab-pane fade show"
         id="home-1-4" role="tabpanel"
                                                             aria-labelledby="tab-1-4">
                                                            <ul class="list list-group"
                                                                style="display: block;overflow-y: auto;max-height: 212px;">
                                                                <select class="col-sm-12" name="country[]" multiple="multiple">

            </select>
        </ul>
    </div>
    <div class="tab-pane fade show"
         id="home-1-5" role="tabpanel"
                                                             aria-labelledby="tab-1-5">
                                                            <ul class="list list-group"
                                                                style="display: block;overflow-y: auto;max-height: 212px;">
                                                                <select class="col-sm-12" name="country[]" multiple="multiple">

            </select>
        </ul>
    </div>
    <div class="tab-pane fade show"
         id="home-1-6" role="tabpanel"
                                                             aria-labelledby="tab-1-6">
                                                            <ul class="list list-group"
                                                                style="display: block;overflow-y: auto;max-height: 212px;">
                                                                <select class="col-sm-12" name="country[]" multiple="multiple">

            </select>
        </ul>
    </div>
    <div class="tab-pane fade show"
         id="home-1-7" role="tabpanel"
                                                             aria-labelledby="tab-1-7">
                                                            <ul class="list list-group"
                                                                style="display: block;overflow-y: auto;max-height: 212px;">
                                                                <select class="select2_init col-sm-12" name="country[]" multiple="multiple">

            </select>
        </ul>
    </div>
</div>
</div>
 <div class="mt-3">
                                                            <label>Operating system: @include('administrator.components.lable_require')</label>
                                                            <select class="form-control select2_init" name="os[]" multiple>
                                                                <option value="5">Android</option>
                                                                <option value="12">BlackBerry OS</option>
                                                                <option value="14">Chrome OS</option>
                                                                <option value="15">Firefox OS</option>
                                                                <option value="11">GNU/Linux</option>
                                                                <option value="4">IOS</option>
                                                                <option value="20">Ipad OS</option>
                                                                <option value="3">Linux</option>
                                                                <option value="2">Mac OS</option>
                                                                <option value="16">MocorDroid</option>
                                                                <option value="17">Tizen</option>
                                                                <option value="18">Ubuntu</option>
                                                                <option value="1">Windows</option>
                                                                <option value="6">Windows Phone</option>
                                                                <option value="0">Other</option>
                                                            </select>
                                                        </div>
<div class="mt-3">
<label>Device: @include('administrator.components.lable_require')</label>
                                                    <select class="form-control select2_init" name="devices[]" multiple>
                                                        <option value="7">Car browser</option>
                                                        <option value="5">Console</option>
                                                        <option value="1">Desktop</option>
                                                        <option value="4">Feature phone</option>
                                                        <option value="8">Phablet</option>
                                                        <option value="2">Smartphone</option>
                                                        <option value="3">Tablet</option>
                                                        <option value="6">TV</option>
                                                        <option value="0">Other</option>
                                                    </select>
                                                </div>
                                                <div class="mt-3">
                                                    <label>Frequency capping</label>

                                                    <div class="row">
                                                        <div class="col-md-3 col-6">
                                                            <div>
                                                                <label>Counter type: @include('administrator.components.lable_require')</label>
                                                                <select class="form-control select2_init"
                                                                        name="fc_counter">
                                                                    <option value="1">Impressions</option>
                                                                    <option value="2">Clicks</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3 col-6">
                                                            <div>
                                                                <label>Limit: @include('administrator.components.lable_require')</label>
                                                                <input type="text" autocomplete="off" name="fc_limit"
                                                                       class="form-control number " value="0" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3 col-6">
                                                            <div>
                                                                <label>Time interval</label>
                                                                <select class="form-control select2_init"
                                                                        name="fc_interval">
                                                                    <option value="1">per hour</option>
                                                                    <option value="2">per 2 hours</option>
                                                                    <option value="4">per 4 hours</option>
                                                                    <option value="6">per 6 hours</option>
                                                                    <option value="12">per 12 hours</option>
                                                                    <option value="24">per day</option>
                                                                    <option value="168">per week</option>
                                                                    <option value="720">per month</option>
                                                                    <option value="8640">per year</option>
                                                                    <option value="100010">per 10 sec</option>
                                                                    <option value="100015">per 15 sec</option>
                                                                    <option value="100030">per 30 sec</option>
                                                                    <option value="100060">per 1 min</option>
                                                                    <option value="100180">per 3 min</option>
                                                                    <option value="100300">per 5 min</option>
                                                                    <option value="100600">per 10 min</option>
                                                                    <option value="100900">per 15 min</option>
                                                                    <option value="101200">per 20 min</option>
                                                                    <option value="101800">per 30 min</option>
                                                                    <option value="102700">per 45 min</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3 col-6">
                                                            <div>
                                                                <label>Mode: @include('administrator.components.lable_require')</label>
                                                                <select class="form-control select2_init"
                                                                        name="fc_mode">
                                                                    <option value="1">Visitor</option>
                                                                    <option value="2">IP address</option>
                                                                </select>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
    </div>

                                        </div>

                                        <div class="col-12">
                                            <div class="mt-3">

                                                <div class="form-group textareazone">
                                                    <label>Bids: @include('administrator.components.lable_require')</label>
                                                    <textarea name="bids" class="form-control " rows="10" required></textarea>
                                                                                                    </div>

                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="mt-3">
                                                <button class="btn btn-success">Create now</button>
                                            </div>
                                        </div>
                                    </div></form></div>`)

            $(".select2_init").select2({
                placeholder: "Select",
                //allowClear: true
            });


            window.scrollTo(0, document.body.scrollHeight);
        }

        function chooseSelect(id) {
            if(id == 7){
                $('.tab-content').show();
                $('[name="country[]"]').val('').trigger('change');
            }else{
                $('.tab-content').hide();
                $('[name="country[]"]').val('');
            }
            $('.list-group [name="continent_id"]').remove();
            callAjax(
                'GET',
                '{{route('administrator.detail.get.national')}}',
                {id: id},
                (response) => {
                    $('select[name="country[]"]').html(response.html);
                    $('.list-group').append('<input type="hidden" name="continent_id" value="'+response.continent_id+'">');
                    if(id != 7){
                        $('.list-group option').prop('selected', true);
                    }
                }
            )
            // if($('.tab-content .tab-pane').hasClass('active')){
            //     $('.tab-content .tab-pane.active option').prop('selected', true);
            // }else{
            //     $('.tab-content .tab-pane').removeClass('active');
            //     $('.tab-content .tab-pane.active option:selected').remove().end();
            // }
            // $('[name="country[]"]').val('');
            // $('.tab-content .tab-pane.active option').prop('selected', true);

            //$('[name="country[]"]').val(null).trigger('change');
        }

        function chooseTypeZone(){
            var id = $('select[name="typezone"]').val();
            callAjax(
                'GET',
                '{{route('administrator.detail.get.typezone')}}',
                {id: id},
                (response) => {
                    $('.textareazone').html(response.html);
                }
            )
        }

    </script>
@endsection
