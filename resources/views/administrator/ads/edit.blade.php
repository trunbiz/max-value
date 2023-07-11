@extends('administrator.layouts.master')

@include('administrator.'.$prefixView.'.header')

@section('css')

@endsection

@section('content')

    <div class="container-fluid list-products">
        <div class="row">
            <div class="col-md-6">
                <div class="card p-3">
                    <div class="row">
                        <h3 class="mb-3">
                            Ads
                        </h3>
                        <div class="col-3">
                            Ad Unit ID:
                        </div>
                        <div class="col-9">
                            {{ $item->ads_api_id }}
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-3">
                            Webiste:
                        </div>
                        <div class="col-9">
                            @if(!empty($zone))
                                {{$zone['site']['name']}}
                            @endif
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-3">
                            Created Date:
                        </div>
                        <div class="col-9">
                            {{ $item['created_at'] }}
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card p-3">
                    <form action="{{route('administrator.ads.zone.update', ['id' => $item->id])}}" method="post"
                          enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        @php
                            $isMatch = false;
                        @endphp
                        @if(!empty($zone && !empty($ads)))
                            @foreach($ads['assigned_zones'] as $assignedZone)
                                @if($assignedZone['id'] == $zone['id'])
                                    @php
                                        $isMatch = true;
                                    @endphp
                                @endif
                            @endforeach
                        @endif
                        <h3 class="mb-3">Zone<span class="{{$isMatch ? 'text-success' : 'text-danger'}} ms-1" style="font-size: 11px;">{{$isMatch ? 'Tương thích' : 'Không tương thích'}}</span></h3>

                        <div class="row">
                            <div class="col-3">
                                Zone ID:
                            </div>
                            <div class="col-9">
                                <input type="text" autocomplete="off" name="share" class="form-control number"
                                       value="{{ !empty($zone) ? $zone['id']  : ''}}" readonly>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-3">
                                Zone name:
                            </div>
                            <div class="col-9">
                                <input type="text" autocomplete="off" name="share" class="form-control number"
                                       value="{{ !empty($zone) ? $zone['name'] :'' }}" readonly>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-3">
                                Share(%):
                            </div>
                            <div class="col-9">
                                <input type="text" autocomplete="off" name="share" class="form-control number"
                                       value="{{ $item->share }}" required>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-3">
                                Status:
                            </div>
                            <div class="col-9">

                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="active" id="inlineRadio1"
                                           value="1" {{ (!empty($zone) && $zone['is_active']) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="inlineRadio1">Active</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="active" id="inlineRadio2"
                                           value="0" {{ (!empty($zone) && !$zone['is_active']) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="inlineRadio2">InActive</label>
                                </div>

                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-12">
                                <button class="btn btn-success border">Update</button>
                            </div>
                        </div>

                    </form>

                </div>
            </div>

        </div>

        <div class="mb-3">
            Configs
            <button onclick="onInsertConfig()" class="btn-success rounded-circle" style="border: 0;width: 25px;height: 25px;">+</button>
        </div>
        <div class="card">
            <div class="accordion" id="accordionPanelsStayOpenExample">
                @foreach($item->adsAdvertisers as $index => $itemAdsAdvertisers)

                    <div class="accordion-item">
                        <h2 class="accordion-header" id="panelsStayOpen-{{$itemAdsAdvertisers->id}}-">
                            <button class="accordion-button {{$index != 0 ? 'collapsed' : ''}}" type="button"
                                    data-bs-toggle="collapse"
                                    data-bs-target="#panelsStayOpen-{{$itemAdsAdvertisers->id}}"
                                    aria-expanded="{{$index == 0 ? 'true' : 'false'}}"
                                    aria-controls="panelsStayOpen-{{$itemAdsAdvertisers->id}}">
                                @foreach($advertisers as $itemAdvertisers)
                                    {{$itemAdvertisers['id'] == $itemAdsAdvertisers->advertiser_api_id ? $itemAdvertisers['name'] : ''}}
                                @endforeach
                                - Order: {{$index + 1}} - Count: {{$itemAdsAdvertisers->count_percent}}% - Conditions: {{$itemAdsAdvertisers->numberConditions()}}
                            </button>
                        </h2>
                        <div id="panelsStayOpen-{{$itemAdsAdvertisers->id}}"
                             class="accordion-collapse collapse {{$index == 0 ? 'show' : ''}}"
                             aria-labelledby="panelsStayOpen-{{$itemAdsAdvertisers->id}}">
                            <div class="accordion-body">
                                <form
                                    action="{{route('administrator.ads.advertiser.update', ['id' => $itemAdsAdvertisers->id])}}"
                                    method="post"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="row">

                                        <div class="col-md-6">
                                            <div class="p-3 border">
                                                <div class="row">
                                                    <div class="col-3">
                                                        Partner:
                                                    </div>
                                                    <div class="col-9">
                                                        <div class="form-group">
                                                            <select
                                                                class="form-control choose_value select2_init @error('advertiser_api_id') is-invalid @enderror"
                                                                required
                                                                name="advertiser_api_id">
                                                                @foreach($advertisers as $itemAdvertisers)
                                                                    <option
                                                                        value="{{$itemAdvertisers['id']}}" {{$itemAdvertisers['id'] == $itemAdsAdvertisers->advertiser_api_id ? 'selected' : ''}}>{{$itemAdvertisers['name']}}</option>
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
                                                        Partner Unit ID:
                                                    </div>
                                                    <div class="col-9">
                                                        <div class="form-group">
                                                            <input type="text" autocomplete="off"
                                                                   class="form-control number"
                                                                   value="{{$itemAdsAdvertisers->advertiser_api_id}}"
                                                                   required="" placeholder="" data-bs-original-title=""
                                                                   title="" readonly>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row mt-3">
                                                    <div class="col-3">
                                                        Count percent (%):
                                                    </div>
                                                    <div class="col-9">
                                                        <div class="form-group">
                                                            @include('administrator.components.require_input_number', ['name' => 'count_percent', 'value' => $itemAdsAdvertisers->count_percent])
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row mt-3">
                                                    <div class="col-3">
                                                        Ordered:
                                                    </div>
                                                    <div class="col-9">
                                                        <div class="form-group">
                                                            <input type="text" autocomplete="off" name="order"
                                                                   class="form-control number "
                                                                   value="{{$itemAdsAdvertisers->order}}" required=""
                                                                   placeholder="" data-bs-original-title="" title="">
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div>

                                                <div>
                                                    <textarea name="conditions"
                                                              class="form-control @error('conditions') is-invalid @enderror"
                                                              rows="10" placeholder="Conditions">{{$itemAdsAdvertisers->conditions}}</textarea>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="mt-3">

                                                <div class="form-group">
                                                    <label>Ad Code</label>
                                                    <textarea name="ad_code"
                                                              class="form-control @error('ad_code') is-invalid @enderror"
                                                              rows="5">{{$itemAdsAdvertisers->ad_code}}</textarea>
                                                    @error('ad_code')
                                                    <div class="alert alert-danger">{{$message}}</div>
                                                    @enderror
                                                </div>

                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="mt-3">
                                                <button class="btn btn-success">Update now</button>
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
@endsection

@section('js')

    <script>
        function onInsertConfig() {

            const advertisers = @json($advertisers);

            let htmlOptions = ''

            for (let i = 0; i < advertisers.length; i++) {
                htmlOptions += `<option value="${advertisers[i]['id']}">${advertisers[i]['name']}</option>`
            }

            $('#container_insert').html(`<div class="card p-3">
<form action="{{route('administrator.ads.advertiser.store', ['ads_id' => $item->id])}}" method="post"
                          enctype="multipart/form-data">
                        @csrf
            <div class="row">

                                                    <div class="col-md-6">
                                                        <div class="p-3 border">
                                                            <div class="row">
                                                                <div class="col-3">
                                                                    Partner:
                                                                </div>
                                                                <div class="col-9">
                                                                    <div class="form-group">
                                                                        <select class="form-control choose_value select2_init" required="" name="advertiser_api_id">
${htmlOptions}

                                                            </select>
                                                                                                                    </div>
                                                    </div>
                                                </div>

                                                <div class="row mt-3">
                                                    <div class="col-3">
                                                        Count percent (%):
                                                    </div>
                                                    <div class="col-9">
                                                        <div class="form-group">
                                                            <div class="form-group mt-3">
        <input type="text" autocomplete="off" name="count_percent" class="form-control number " value="70" required="" placeholder="" data-bs-original-title="" title="">
    </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row mt-3">
                                                    <div class="col-3">
                                                        Ordered:
                                                    </div>
                                                    <div class="col-9">
                                                        <div class="form-group">
                                                            <input type="text" autocomplete="off" name="order" class="form-control number " value="0" required="" placeholder="" data-bs-original-title="" title="">
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div>

                                                <div>
                                                    <textarea name="conditions"
                                                              class="form-control @error('conditions') is-invalid @enderror"
                                                              rows="10" placeholder="conditions"></textarea>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="mt-3">

                                                <div class="form-group">
                                                    <label>Ad Code</label>
                                                    <textarea name="ad_code" class="form-control " rows="5"></textarea>
                                                                                                    </div>

                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="mt-3">
                                                <button class="btn btn-success" data-bs-original-title="" title="">Create now</button>
                                            </div>
                                        </div>
                                    </div></form></div>`)

            $(".select2_init").select2({
                placeholder: "Select",
                // allowClear: true
            });

            window.scrollTo(0, document.body.scrollHeight);
        }
    </script>
@endsection
