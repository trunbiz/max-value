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
                            <div class="col-9" id="zone_id">
                                <input type="text" autocomplete="off"
                                       value="{{$item['id']}}" name="zone[id]"
                                       required readonly style="border: 0;">
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
                                <button type="button"
                                        class="btn btn-primary border" {{ $item['status']['id'] == 7000 ? 'onclick=getCode('. $item["id"] . ')' : 'style=cursor:no-drop;opacity:0.5' }}>
                                    Get code
                                </button>
                            </div>
                        </div>

                    </form>

                </div>
            </div>
        </div>
        <br>
        {{--            Danh sách các campaign--}}
        <div class="form-group mt-3">
            <h3>Campaign Info</h3>
        </div>
        <div class="card campaign-info">
            @foreach($campaigns as $campaignItem)
                <div class="row">
                    <div class="col-sm-12">
                        <h2 class="accordion-header" id="panelsStayOpen">
                            <button class="accordion-button itemCampaignInfo" type="button">
                                ID: {{$campaignItem['ads']['campaign']['id']}}
                                | Advertiser: @foreach($advertisers as $advertiser)
                                    {{$campaignItem['campaign']['advertiser_api_id'] == $advertiser['id'] ? $advertiser['name'] : '' }}
                                @endforeach
                                | name: {{$campaignItem['campaign']['name']}}
                                | status: {{\App\Models\CampaignModel::STATUS[$campaignItem['campaign']['status']]}}
                            </button>
                        </h2>
                    </div>
                    <div class="col-sm-12 showItemCampaignInfo" style="display: none">
                        <div class="card">
                            <form action="{{route('administrator.campaign.update')}}" method="POST">
                                @csrf
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <input type="text" hidden
                                                   class="form-control"
                                                   name="adsUpdate[ad_ad_id]"
                                                   value="{{$campaignItem['ads']['ad_ad_id'] ?? ''}}" >
                                            <input type="text" hidden
                                                   class="form-control"
                                                   name="campaignUpdate[id]"
                                                   value="{{$campaignItem['campaign']['id'] ?? ''}}" >
                                            <input type="text" hidden
                                                   class="form-control"
                                                   name="campaignUpdate[ad_campaign_id]"
                                                   value="{{$campaignItem['campaign']['ad_campaign_id'] ?? ''}}" >
                                            <div class="form-group mt-3">
                                                <label>Name</label>
                                                <input type="text" autocomplete="off"
                                                       class="form-control"
                                                       name="campaignUpdate[name]"
                                                       value="{{$campaignItem['campaign']['name']}}" >
                                            </div>
                                            <div class="form-group mt-3">
                                                <label>Advertiser <span class="text-danger">*</span></label>
                                                <select
                                                    name="campaignUpdate[advertiser_api_id]"
                                                    class="form-control choose_value select2_init advertiser_api_id"
                                                    required>
                                                    <option value="null"> -- Chọn --</option>
                                                    @foreach($advertisers as $advertiser)
                                                        <option
                                                            value="{{$advertiser['id']}}" {{$campaignItem['campaign']['advertiser_api_id'] == $advertiser['id'] ? 'selected' : '' }}>{{$advertiser['name']}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group mt-3">
                                                <label>Status</label>
                                                <select
                                                    required name="campaignUpdate[status]"
                                                    class="form-control choose_value select2_init">
                                                    @foreach($status as $key => $value)
                                                        <option
                                                            value="{{$key}}" {{$campaignItem['campaign']['status'] == $key ? 'selected' : '' }}>{{$value}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group mt-3">
                                                <label>Injection
                                                    type @include('user.components.lable_require')</label>
                                                <select
                                                    name="adsUpdate[idinjectiontype]"
                                                    class="form-control choose_value select2_init"
                                                    required>
                                                    @foreach($injectionType as $key => $value)
                                                        <option
                                                            value="{{$key}}" {{$campaignItem['campaign']['status'] == $key ? 'selected' : '' }}>{{$value}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group mt-3">
                                                <label>Html/Javascript
                                                    code @include('user.components.lable_require')</label>
                                                <textarea
                                                    class="form-control"
                                                    rows="5" required
                                                    name="adsUpdate[content_html]">{{$campaignItem['ads']['details']['content_html']}}</textarea>
                                            </div>
                                            <div class="form-group mt-3">
                                                <input class="form-check-input" type="checkbox" value="1"
                                                       id="is_responsive"
                                                       name="adsUpdate[is_responsive]" {{$campaignItem['ads']['details']['is_responsive'] == 1 ? 'checked' : ''}}>
                                                <label> Responsive layout</label>
                                            </div>
                                            <div class="form-group mt-3 campaign-option-button">
                                                Options
                                                <span class="badge badge-primary"> <i
                                                        class="fa-solid fa-plus"></i></span>
                                            </div>
                                            <div class="campaign-option" style="display: none">
                                                <div class="form-group mt-3">
                                                    <label> Label position</label>
                                                    <select
                                                        class="form-control choose_value select2_init"
                                                        name="adsUpdate[ext_label_pos]">
                                                        @foreach($listExtLabelPos as $key => $value)
                                                            <option
                                                                value="{{$key}}" {{$campaignItem['ads']['details']['ext_label_pos'] == $key ? 'selected': ''}}>{{$value}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group mt-3">
                                                    <label>Menu position</label>
                                                    <select
                                                        class="form-control choose_value select2_init"
                                                        name="adsUpdate[ext_menu_pos]">
                                                        @foreach($listExtMenuPos as $key => $value)
                                                            <option
                                                                value="{{$key}}" {{$campaignItem['ads']['details']['ext_menu_pos'] == $key ? 'selected': ''}}>{{$value}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group mt-3">
                                                    <label>Branding position</label>
                                                    <select
                                                        class="form-control choose_value select2_init"
                                                        name="adsUpdate[ext_brand_pos]">
                                                        @foreach($listExtLabelPos as $key => $value)
                                                            <option
                                                                value="{{$key}}" {{$campaignItem['ads']['details']['ext_brand_pos'] == $key ? 'selected': ''}}>{{$value}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group mt-3">
                                                    <label>Geo</label>
                                                    <ul class="nav nav-tabs" role="tablist">
                                                        <li class="nav-item">
                                                            <a class="nav-link active geo" role="tab"
                                                               data-toggle="tab">Include</a>
                                                        </li>
                                                        <li class="nav-item">
                                                            <a class="nav-link geo_bl" role="tab" data-toggle="tab">Exclude</a>
                                                        </li>
                                                    </ul>
                                                    <br>
                                                    <div class="col-sm-12 geoShow" style="display: block">
                                                        <select
                                                            class="form-control choose_value select2_init"
                                                            name="campaignUpdate[geo][]"
                                                            multiple data-live-search="true">
                                                            @foreach($listGeos as $key => $value)
                                                                <option
                                                                    value="{{$key}}" {{in_array($key, $campaignItem['campaign']['geo'] ?? []) ? 'selected' : ''}}>{{$value}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="col-sm-12 geo_blShow" style="display: none">
                                                        <select
                                                            class="form-control choose_value select2_init"
                                                            name="campaignUpdate[geo_bl][]"
                                                            multiple data-live-search="true">
                                                            @foreach($listGeos as $key => $value)
                                                                <option
                                                                    value="{{$key}}" {{in_array($key, $campaignItem['campaign']['geo_bl'] ?? []) ? 'selected' : ''}}>{{$value}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group mt-3">
                                                    <label>Device targeting</label>
                                                    <div class="form-group row">
                                                        <div class="col-sm-12">
                                                            <label for="Device"
                                                                   class="col-sm-2 col-form-label">Device</label>
                                                        </div>
                                                        <div class="col-sm-3">
                                                            <select
                                                                name="campaignUpdate[device_mode]"
                                                                class="form-control choose_value select2_init">
                                                                @foreach($target_mode as $key => $value)
                                                                    <option
                                                                        value="{{$key}}" {{$campaignItem['campaign']['device_mode'] ==$key ? 'selected' : '' }}>{{$value}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="col-sm-9">
                                                            <select
                                                                name="campaignUpdate[device][]"
                                                                class="form-control choose_value select2_init"
                                                                multiple data-live-search="true"
                                                            >
                                                                @foreach($device as $key => $value)
                                                                    <option
                                                                        value="{{$key}}" {{in_array($key, $campaignItem['campaign']['device'] ?? []) ? 'selected' : ''}}>{{$value}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <div class="col-sm-12">
                                                            <label for="Device"
                                                                   class="col-sm-2 col-form-label">Browser</label>
                                                        </div>
                                                        <div class="col-sm-3">
                                                            <select
                                                                name="campaignUpdate[browser_mode]"
                                                                class="form-control choose_value select2_init"
                                                            >
                                                                @foreach($target_mode as $key => $value)
                                                                    <option
                                                                        value="{{$key}}" {{$campaignItem['campaign']['browser_mode'] ==$key ? 'selected' : '' }}>{{$value}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="col-sm-9">
                                                            <select
                                                                name="campaignUpdate[browser][]"
                                                                multiple data-live-search="true"
                                                                class="form-control choose_value select2_init">
                                                                @foreach($brows as $key => $value)
                                                                    <option
                                                                        value="{{$key}}" {{in_array($key, $campaignItem['campaign']['browser'] ?? []) ? 'selected' : ''}}>{{$value}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group mt-3">
                                                <div class="col-sm-12" style="text-align: center">
                                                    <button class="btn btn-primary mt-3" id="updateCampaign">Update
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <br>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>


        {{--            Tạo mới Campaign--}}
        @if($item['status']['id'] == 7000)
            <div class="mt-3 mb-3">
                Add Campaign
                <button onclick="onInsertConfig()" class="btn-success rounded-circle"
                        style="border: 0;width: 25px;height: 25px;">+
                </button>
            </div>
        @endif
        <div class="card campaign-create" style="display: none">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group mt-3">
                                <h3>Create Campaign</h3>
                            </div>
                            <div class="form-group mt-3">
                                <label>Name</label>
                                <input type="text" autocomplete="off" name="campaign[name]" class="form-control"
                                       value="">
                            </div>
                            <div class="form-group mt-3">
                                <label>Advertiser <span class="text-danger">*</span></label>
                                <select
                                    class="form-control choose_value select2_init advertiser_api_id"
                                    required name="campaign[advertiser_api_id]">
                                    <option value="null"> -- Chọn --</option>
                                    @foreach($advertisers as $advertiser)
                                        <option value="{{$advertiser['id']}}">{{$advertiser['name']}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group mt-3">
                                <label>Status</label>
                                <select
                                    class="form-control choose_value select2_init"
                                    required name="campaign[status]">
                                    @foreach($status as $key => $value)
                                        <option value="{{$key}}">{{$value}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group mt-3">
                                <label>Injection type @include('user.components.lable_require')</label>
                                <select
                                    class="form-control choose_value select2_init"
                                    required name="ads[idinjectiontype]">
                                    @foreach($injectionType as $key => $value)
                                        <option value="{{$key}}">{{$value}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group mt-3">
                                <label>Html/Javascript code @include('user.components.lable_require')</label>
                                <textarea name="ads[content_html]"
                                          class="form-control"
                                          rows="5" required></textarea>
                            </div>
                            <div class="form-group mt-3">
                                <input class="form-check-input" type="checkbox" value="1" id="is_responsive"
                                       name="ads[is_responsive]">
                                <label> Responsive layout</label>
                            </div>
                            <div class="form-group mt-3 campaign-option-button">
                                Options
                                <span class="badge badge-primary"> <i
                                        class="fa-solid fa-plus"></i></span>
                            </div>
                            <div class="campaign-option" style="display: none">
                                <div class="form-group mt-3">
                                    <label> Label position</label>
                                    <select
                                        class="form-control choose_value select2_init"
                                        required name="ads[ext_label_pos]">
                                        @foreach($listExtLabelPos as $key => $value)
                                            <option value="{{$key}}">{{$value}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group mt-3">
                                    <label>Menu position</label>
                                    <select
                                        class="form-control choose_value select2_init"
                                        required name="ads[ext_menu_pos]">
                                        @foreach($listExtMenuPos as $key => $value)
                                            <option value="{{$key}}">{{$value}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group mt-3">
                                    <label>Branding position</label>
                                    <select
                                        class="form-control choose_value select2_init"
                                        required name="ads[ext_brand_pos]">
                                        @foreach($listExtLabelPos as $key => $value)
                                            <option value="{{$key}}">{{$value}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group mt-3">
                                    <label>Geo</label>
                                    <ul class="nav nav-tabs" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active geo" role="tab" data-toggle="tab">Include</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link geo_bl" role="tab" data-toggle="tab">Exclude</a>
                                        </li>
                                    </ul>
                                    <br>
                                    <div class="col-sm-12 geoShow" style="display: block">
                                        <select
                                            class="form-control choose_value select2_init"
                                            multiple data-live-search="true"
                                            name="campaign[geo][]">
                                            @foreach($listGeos as $key => $value)
                                                <option value="{{$key}}">{{$value}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-sm-12 geo_blShow" style="display: none">
                                        <select
                                            class="form-control choose_value select2_init"
                                            multiple data-live-search="true"
                                            name="campaign[geo_bl][]">
                                            @foreach($listGeos as $key => $value)
                                                <option value="{{$key}}">{{$value}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group mt-3">
                                    <label>Device targeting</label>
                                    <div class="form-group row">
                                        <div class="col-sm-12">
                                            <label for="Device" class="col-sm-2 col-form-label">Device</label>
                                        </div>
                                        <div class="col-sm-3">
                                            <select
                                                class="form-control choose_value select2_init"
                                                name="campaign[device_mode]">
                                                @foreach($target_mode as $key => $value)
                                                    <option value="{{$key}}">{{$value}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-sm-9">
                                            <select
                                                class="form-control choose_value select2_init"
                                                multiple data-live-search="true"
                                                name="campaign[device][]">
                                                @foreach($device as $key => $value)
                                                    <option value="{{$key}}">{{$value}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-12">
                                            <label for="Device" class="col-sm-2 col-form-label">Browser</label>
                                        </div>
                                        <div class="col-sm-3">
                                            <select
                                                class="form-control choose_value select2_init"
                                                name="campaign[browser_mode]">
                                                @foreach($target_mode as $key => $value)
                                                    <option value="{{$key}}">{{$value}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-sm-9">
                                            <select
                                                multiple data-live-search="true"
                                                class="form-control choose_value select2_init"
                                                name="campaign[browser][]">
                                                @foreach($brows as $key => $value)
                                                    <option value="{{$key}}">{{$value}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mt-3">
                                <div class="col-sm-12" style="text-align: center">
                                    <button class="btn btn-primary mt-3" id="storeCampaign" type="submit">Save</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <br>
            </div>
        </div>
    </div>
    <!-- Modal get code -->
    <div class="modal" id="getCode" tabindex="-1" role="dialog" aria-labelledby="getCode"></div>
@endsection

@section('js')

    <script>
        // Jquery
        $(document).ready(function () {
            $(".campaign-option-button").click(function () {
                $(".campaign-option").toggle(1000);
            });

            $(".geo").click(function () {
                $(".geoShow").show(500);
                $(".geo_blShow").hide(500);
                $(".geo_bl").removeClass("active");
                $(".geo").addClass("active");
            });

            $(".geo_bl").click(function () {
                $(".geoShow").hide(500);
                $(".geo_blShow").show(500);
                $(".geo_bl").addClass("active");
                $(".geo").removeClass("active");
            });

            $(".itemCampaignInfo").click(function () {

                // Tìm phần tử cha gần nhất của button được nhấp để thao tác với phần showItemCampaignInfo cùng cấp.
                var parentRow = $(this).closest(".row");
                var showItem = parentRow.find(".showItemCampaignInfo");

                // Ẩn/hiện phần showItemCampaignInfo.
                showItem.toggle();

            });

            $("#storeCampaign").click(function () {
                var values = {};
                $("textarea[name^='ads'], input[name^='zone'], input[name^='campaign'], select[name^='campaign'], input[name^='ads'], select[name^='ads'], input[name^='zone'], select[name^='zone']").each(function () {
                    var name = $(this).attr("name");
                    var value = $(this).val();
                    values[name] = value;
                });
                $.ajax({
                    type: "POST",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    cache: false,
                    data: values,
                    url: "{{route('ajax.administrator.campaign.store')}}",
                    beforeSend: function () {
                        showLoading()
                    },
                    success: function (response) {
                        // Chuyển hướng người dùng đến route cụ thể
                        window.location.href = "{{route('administrator.ads.index')}}";
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
            });

            // Update lại campaign
            $(".updateButton").click(function() {
                var row = $(this).closest(".row"); // Tìm hàng gần nhất chứa nút "Update"

                var campaignId = row.find(".campaignId").val(); // Lấy giá trị của input campaignId
                var values = {};
                $("textarea[name^='ads'], input[name^='zone'], input[name^='campaign'], select[name^='campaign'], input[name^='ads'], select[name^='ads'], input[name^='zone'], select[name^='zone']").each(function () {
                    var name = $(this).attr("name");
                    var value = $(this).val();
                    values[name] = value;
                });
                $.ajax({
                    type: "POST",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    cache: false,
                    data: values,
                    url: "{{route('ajax.administrator.campaign.store')}}",
                    beforeSend: function () {
                        showLoading()
                    },
                    success: function (response) {
                        // Chuyển hướng người dùng đến route cụ thể
                        window.location.href = "{{route('administrator.ads.index')}}";
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
            });
        });

        //get code
        function getCode(id) {
            var $this = $('#getCode');
            $this.find('form').attr('data-id', id);
            callAjax(
                "GET",
                "{{ route('user.ajax.getcode') }}" + "?id=" + id, {},
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
            $(".campaign-create").toggle(1000);
        }


        function chooseSelect(id) {
            if (id == 7) {
                $('.tab-content').show();
                $('[name="country[]"]').val('').trigger('change');
            } else {
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
                    $('.list-group').append('<input type="hidden" name="continent_id" value="' + response.continent_id + '">');
                    if (id != 7) {
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

        function chooseTypeZone() {
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
