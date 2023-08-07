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
                <div class="row">
                    <div class="col-sm-12">
                        <h2 class="accordion-header" id="panelsStayOpen">
                            <button class="accordion-button" type="button">
                                ZXZXXXXXXXXXXXXXXXXX
                            </button>
                        </h2>
                    </div>
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="form-group row">
                                    <label for="staticEmail" class="col-sm-2 col-form-label">Name : </label>
                                    <div class="col-sm-10">
                                        <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="email@example.com">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="staticEmail" class="col-sm-2 col-form-label">Advertiser : </label>
                                    <div class="col-sm-10">
                                        <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="email@example.com">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="staticEmail" class="col-sm-2 col-form-label">Status : </label>
                                    <div class="col-sm-10">
                                        <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="email@example.com">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="staticEmail" class="col-sm-2 col-form-label">Injection type : </label>
                                    <div class="col-sm-10">
                                        <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="email@example.com">
                                    </div>
                                </div>
                                <div class="form-group mt-3">
                                    <label>Html/Javascript code @include('user.components.lable_require')</label>
                                    <textarea name="ads[content_html]" disabled
                                              class="form-control"
                                              rows="5" required></textarea>
                                </div>
                                <div class="form-group mt-3 campaign-option-button">
                                    Options
                                    <span class="badge badge-primary"> <i
                                            class="fa-solid fa-plus"></i></span>
                                </div>
                                <div class="campaign-option" style="display: none">
                                    <div class="form-group row">
                                        <label for="staticEmail" class="col-sm-2 col-form-label">Geo : </label>
                                        <div class="col-sm-10">
                                            <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="email@example.com">
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
                                                    class="form-control choose_value select2_init" disabled>
                                                    @foreach($target_mode as $key => $value)
                                                        <option value="{{$key}}">{{$value}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-sm-9">
                                                <select
                                                    class="form-control choose_value select2_init"
                                                    multiple data-live-search="true" disabled>
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
                                                    disabled>
                                                    @foreach($target_mode as $key => $value)
                                                        <option value="{{$key}}">{{$value}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-sm-9">
                                                <select
                                                    multiple data-live-search="true"
                                                    class="form-control choose_value select2_init"
                                                    disabled>
                                                    @foreach($brows as $key => $value)
                                                        <option value="{{$key}}">{{$value}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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

            $("#storeCampaign").click(function() {
                var values = {};
                $("input[name^='campaign'], select[name^='campaign'], input[name^='ads'], select[name^='ads'], input[name^='zone'], select[name^='zone']").each(function() {
                    var name = $(this).attr("name");
                    var value = $(this).val();
                    values[name] = value;
                });
                values['zone'] = {
                    id: $('#zone_id').val('')
                }
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
