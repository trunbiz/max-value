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
                            <div class="form-group mt-3">
                                <h3>Campaign Info</h3>
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
                                <label>Website <span class="text-danger">*</span></label>
                                <select
                                    class="form-control choose_value select2_init list-site"
                                    required name="campaign[site_id]">
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
                            <div class="form-group mt-3 campaign-option-button">
                                Options
                                <span class="badge badge-primary"> <i
                                        class="fa-solid fa-plus"></i></span>
                            </div>
                            <div class="campaign-option" style="display: none">
                                <div class="form-group mt-3">
                                    <label>Geo</label>
                                    <select
                                        class="form-control choose_value select2_init"
                                        required name="campaign[geo]">
                                        @foreach($status as $key => $value)
                                            <option value="{{$key}}">{{$value}}</option>
                                        @endforeach
                                    </select>
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
                                    <div class="form-group row">
                                        <div class="col-sm-12">
                                            <label for="Device" class="col-sm-2 col-form-label">Language</label>
                                        </div>
                                        <div class="col-sm-3">
                                            <select
                                                class="form-control choose_value select2_init"
                                                name="campaign[language_mode]">
                                                @foreach($target_mode as $key => $value)
                                                    <option value="{{$key}}">{{$value}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-sm-9">
                                            <select
                                                multiple data-live-search="true"
                                                class="form-control choose_value select2_init"
                                                name="campaign[language][]">
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group mt-3" style="text-align: center">
                                <button class="btn btn-primary mt-3">Save</button>
                            </div>
                        </div>

                    </div>


                </div>
                <div class="col-xl-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group mt-3">
                                <h3>Ads Info</h3>
                            </div>

                            <div class="form-group mt-3">
                                <div class="form-group mt-3">
                                    <label>Ads Name</label>
                                    <input type="text" autocomplete="off" name="ads['name']" class="form-control"
                                           value="">
                                </div>
                            </div>

                            <div class="form-group mt-3">
                                <label>Dimensions @include('user.components.lable_require')</label>
                                <select
                                    class="form-control choose_value select2_init @error("dimension_id") is-invalid @enderror"
                                    required name="ads[iddimension]">
                                    @foreach($dimensions as $key => $value)
                                        <option value="{{$key}}">{{$value['name']}}</option>
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
                                <label>Zone @include('user.components.lable_require')</label>
                                <select
                                    class="form-control choose_value select2_init list_zone"
                                    required name="zone[id]">
                                </select>
                            </div>
                            <div class="form-group mt-3">
                                <label>Html/Javascript code @include('user.components.lable_require')</label>
                                <textarea name="ads[content_html]"
                                          class="form-control"
                                          rows="5" required></textarea>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </form>

    </div>
    <script>
        $(document).ready(function () {
            $(".campaign-option-button").click(function () {
                $(".campaign-option").toggle(1000);
            });
            $(".advertiser_api_id").change(function(){
                var id = $('select[name="campaign[advertiser_api_id]"]').val();
                callAjax(
                    "GET",
                    "{{ route('ajax.administrator.website.listByPublisher') }}" + "?id="+id,{},
                    (response) => {
                        $(".list-site").empty();
                        let html = ' <option value="null"> -- Chọn --</option>';
                        $.each(response.data,function(key, value)
                        {
                            $(".list-site").append(html + '<option value=' + key + '>' + value + '</option>');
                        });
                    }

                )
            });

            // lấy danh sách zone theo site
            $(".list-site").change(function(){
                var id = $('select[name="campaign[site_id]"]').val();
                callAjax(
                    "GET",
                    "{{ route('ajax.administrator.zone.listBySite') }}" + "?id="+id,{},
                    (response) => {
                        $(".list_zone").empty();
                        $.each(response.data,function(key, value)
                        {
                            $(".list_zone").append('<option value=' + key + '>' + value + '</option>');
                        });
                    }

                )
            });
        });
    </script>

@endsection
@section('js')
@endsection

