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

        <form action="{{route('administrator.'.$prefixView.'.store')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="card">
                <div class="card-body">
                    <div class="form-group mt-3">
                        <h3>Campaign Info</h3>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label>Name campaign <span class="text-danger">(*)</span></label>
                            <input type="text" autocomplete="off" name="campaign[name]" class="form-control"
                                   value="" required>
                        </div>
                        <div class="form-group col-sm-6">
                            <label>Advertiser <span class="text-danger">(*)</span></label>
                            <select
                                class="form-control choose_value select2_init"
                                required name="campaign[advertiser_api_id]">
                                @foreach($advertisers as $advertiser)
                                    <option value="{{$advertiser['id']}}">{{$advertiser['name']}}
                                        /{{$advertiser['email']}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-sm-6">
                            <label>Category</label>
                            <select
                                class="form-control"
                                name="campaign[idCategory]">
                                <option value="13">Arts & Entertainment</option>
                                <option value="34"> Business</option>
                                <option value="31"> Uncategorized </option>
                            </select>
                        </div>
                        <div class="form-group col-sm-6">
                            <label>Status <span class="text-danger">(*)</span></label>
                            <select
                                class="form-control"
                                name="campaign[status]">
                                <option value="1510">Pending</option>
                                <option value="1520" selected>Approved</option>
                                <option value="1530">Blocked</option>
                            </select>
                        </div>
                    </div>
                    {{--                    CREATE ADS--}}
                    <hr>
                    <div class="form-group mt-3">
                        <h3>Ads Info</h3>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label>Ads name <span class="text-danger">(*)</span></label>
                            <input type="text" autocomplete="off" name="ads[ad_name]" class="form-control"
                                   value="">
                        </div>
                        {{--                        <div class="form-group col-sm-6">--}}
                        {{--                            <label>Landing page URL</label>--}}
                        {{--                            <input class="form-control" name="ads[url]">--}}
                        {{--                        </div>--}}
                        <div class="form-group col-sm-6">
                            <label>Dimensions <span class="text-danger">(*)</span></label>
                            <select
                                class="form-control choose_value select2_init"
                                required name="ads[dimension_id]">
                                <option value="46">120x600 / Skyscrape</option>
                                <option value="29">120x240 / Vertical Banner</option>
                                <option value="32">125x125 / Square Button</option>
                                <option value="11">160x600 / Wide Skyscraper</option>
                                <option value="10">180x150 / Rectangle</option>
                                <option value="36">200x200 / Small Square</option>
                                <option value="19">234x60 / Half Banner</option>
                                <option value="5">240x400 / Vertical Rectangle</option>
                                <option value="37">250x250 / Square Pop-Up</option>
                                <option value="40">300x100 / 3:1 Rectangle</option>
                                <option value="9">300x250 / Medium Rectangle</option>
                                <option value="47">300x600 / Half-page Ad</option>
                                <option value="52">315x300</option>
                                <option value="35">320x100 / Large Mobile Banner</option>
                                <option value="34">320x50 / Mobile Banner</option>
                                <option value="48">320x480 / Mobile Interstitial</option>
                                <option value="38">336x280 / Large Rectangle</option>
                                <option value="1">468x60 / Full Banner</option>
                                <option value="49">480x320</option>
                                <option value="42">580x400 / Netboard</option>
                                <option value="50">600x400</option>
                                <option value="41">720x300 / Pop-Under</option>
                                <option value="6">728x90 / Leaderboard</option>
                                <option value="33">88x31 / Micro Bar</option>
                                <option value="51">930x180 / Top Banner</option>
                                <option value="20">970x90 / Large Leaderboard</option>
                                <option value="21">970x250 / Billboard</option>
                                <option value="24">980x120 / Panorama</option>
                            </select>
                        </div>
                        <div class="form-group col-sm-6">
                            <label>Injection type <span class="text-danger">(*)</span></label>
                            <select
                                class="form-control choose_value select2_init"
                                required name="ads[idinjectiontype]">
                                <option value="32">IFrame container</option>
                                <option value="35">IFrame container (strict)</option>
                                <option value="33">Direct injection</option>
                                <option value="36">Direct injection (in-place)</option>
                            </select>
                        </div>
                        <div class="form-group col-sm-12">
                            <label>Html/Javascript code <span class="text-danger">(*)</span></label>
                            <textarea name="ads[content_html]"
                                      class="form-control"
                                      rows="5" required></textarea>
                        </div>
                    </div>
                    <hr>
                    <div class="form-group mt-3">
                        <h3>Zone Info</h3>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label>Site <span class="text-danger">(*)</span></label>
                            <select
                                class="form-control" id="siteSelect"
                                name="site[id]">
                                <option value="">-- Chọn Site --</option>
                                @foreach($sites as $site)
                                    <option value="{{$site['id']}}">{{$site['name']}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-sm-6">
                            <label>Zone <span class="text-danger">(*)</span></label>
                            <select id="zoneSelect"
                                class="form-control"
                                name="zone[id][]">
                            </select>
                        </div>
                    </div>
                    <hr>
                    <div class="row" style="text-align: center">
                        <div class="col-xl-12">
                            <button type="submit" class="btn btn-primary mt-3">Save</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    @include('administrator.scriptJquery')
@endsection
@section('js')
@endsection

