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
            <div class="row">
                <div class="col-xl-6">

                    <div class="card">
                        <div class="card-body">
                            @include('administrator.components.require_input_text' , ['name' => 'name' , 'label' => 'Name'])

                            <div class="form-group mt-3">
                                <h3>Campaign Infor</h3>
                            </div>

                            <div class="form-group mt-3">
                                <label>Advertiser @include('user.components.lable_require')</label>
                                <select
                                    class="form-control choose_value select2_init @error("advertiser_api_id") is-invalid @enderror"
                                    required name="advertiser_api_id">
                                    @foreach($advertisers as $advertiser)
                                        <option value="{{$advertiser['id']}}">{{$advertiser['name']}}</option>
                                    @endforeach
                                </select>
                                @error('advertiser_api_id')
                                <div class="alert alert-danger">{{$message}}</div>
                                @enderror
                            </div>

                            @include('administrator.components.require_input_number' , ['name' => 'share' , 'label' => 'Share(%)'])

                            @include('administrator.components.button_save')
                        </div>

                    </div>


                </div>
                <div class="col-xl-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group mt-3">
                                <h3>Ad Infor</h3>
                            </div>

                            <div class="form-group mt-3">
                                @include('administrator.components.input_text' , ['name' => 'ad_name' , 'label' => 'Ad Name'])
                            </div>

                            <div class="form-group mt-3">
                                <label>Dimensions @include('user.components.lable_require')</label>
                                <select
                                    class="form-control choose_value select2_init @error("dimension_id") is-invalid @enderror"
                                    required name="dimension_id">
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
                                @error('dimension_id')
                                <div class="alert alert-danger">{{$message}}</div>
                                @enderror
                            </div>


                            <div class="form-group mt-3">
                                <label>Bids, JSON-array @include('user.components.lable_require')</label>
                                <textarea name="bids"
                                          class="form-control @error('bids') is-invalid @enderror"
                                          rows="5" required></textarea>
                                @error('bids')
                                <div class="alert alert-danger">{{$message}}</div>
                                @enderror
                            </div>

                            <div class="form-group mt-3">
                                <h3>Zone Infor</h3>
                            </div>

                            @include('user.components.input_text' , ['name' => 'zone_name' , 'label' => 'Name'])

                            <div class="form-group mt-3">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="active" id="inlineRadio1" value="1" checked>
                                    <label class="form-check-label" for="inlineRadio1">Active</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="active" id="inlineRadio2" value="0">
                                    <label class="form-check-label" for="inlineRadio2">InActive</label>
                                </div>
                            </div>

                            <div class="form-group mt-3">
                                <label>Site @include('user.components.lable_require')</label>
                                <select class="form-control select2_init @error("idsite") is-invalid @enderror" required
                                        name="idsite">
                                    @foreach($sites as $site)
                                        <option value="{{$site['id']}}">{{$site['name']}} / {{$site['url']}}</option>
                                    @endforeach
                                </select>
                                @error('idsite')
                                <div class="alert alert-danger">{{$message}}</div>
                                @enderror
                            </div>

                            @include('user.components.select_category' , ['label' => 'Format', 'name' => 'idzoneformat' ,'html_category' => \App\Models\Advertise::getTypeAd(isset($item) ? optional($item)->category_id : ''), 'isDefaultFirst' => true])

                            @include('user.components.select_category' , ['label' => 'Dimension', 'name' => 'iddimension' ,'html_category' => \App\Models\Advertise::getDimension(isset($item) ? optional($item)->category_id : ''), 'isDefaultFirst' => true])

                        </div>

                    </div>
                </div>
            </div>
        </form>

    </div>

@endsection

@section('js')


@endsection

