@extends('administrator.layouts.master')

@include('administrator.'.$prefixView.'.header')

@section('css')

@endsection

@section('content')

    <div class="container-fluid list-products">
        <div class="row">
            <div class="col-12">

                <div class="card">

                    <div class="card-header">

                        @include('administrator.'.$prefixView.'.search')

                    </div>

                    <div class="card-body">

                        {{--                        @include('administrator.components.checkbox_delete_table')--}}

                        <div class="table-responsive product-table">
                            <table class="table table-hover ">
                                <thead>
                                <tr>
                                    {{--                                    <th><input id="check_box_delete_all" type="checkbox" class="checkbox-parent" onclick="onSelectCheckboxDeleteItem()"></th>--}}
                                    <th>#</th>
                                    <th>Zone Name</th>
                                    <th>Website</th>
                                    <th>Share(%)</th>
                                    <th>Number Config</th>
                                    <th>Created time</th>
                                    {{--                                    <th>Manager</th>--}}
                                    <th>Status</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody class="list__data">
                                @foreach($items as $item)
                                    <tr class="item{{ $item['id'] }}">
                                        <td>{{$item['id']}}</td>
                                        <td>{{$item['name']}}</td>
                                        <td>
                                            <a>{{ $item['site']['name'] }}</a>
                                        </td>
                                        <td>
                                            {{ $item['revenue_rate'] }}
                                        </td>
                                        <td id="container_adververs_{{$item['id']}}">
                                            <a STYLE="cursor: pointer;" onclick="showConfig('{{$item['id']}}')"
                                               title="Show">
                                                <i class="fa-regular fa-eye"></i>
                                            </a>
                                        </td>
                                        <td>
                                            {{ $item['created_at'] }}
                                        </td>
                                        <td>
                                            <div onclick="onEditZone('{{$item['id']}}','{{$item['status']['id']}}')"
                                                 style="cursor: pointer;display: flex;" data-bs-toggle="modal"
                                                 data-bs-target="#editZone">
                                                {!! \App\Models\Helper::htmlStatus($item['status']['name']) !!}
                                            </div>
                                        </td>

                                        <td>
                                            <a href="javascript:void(0)" {{ $item['status']['id'] == 7000 ? 'onclick=getCode('. $item["id"] . ')' : 'style=cursor:no-drop;opacity:0.5' }}
                                               title="Get code">
                                                <i class="fa-solid fa-eye"></i>
                                            </a>

                                            @can('advertises-config')
                                                <a href="{{route('administrator.'.$prefixView.'.detail.index' , ['id'=> $item['id'] ])}}"
                                                   title="Edit">
                                                    <i class="fa-solid fa-pen"></i>
                                                </a>
                                            @endcan

                                            <a href="{{route('administrator.'.$prefixView.'.delete' , ['id'=> $item['id']])}}"
                                               data-url="{{route('user.'.$prefixView.'.delete' , ['id'=> $item['id']])}}"
                                               class="delete action_delete text-danger"
                                               title="Delete">
                                                <i class="fa-solid fa-x"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach

                                </tbody>
                            </table>
                        </div>
                        <div>
                            @include('administrator.components.footer_table')
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="createModal" aria-labelledby="createModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <form action="{{route('administrator.'.$prefixView.'.store')}}" method="post"
                      enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="createModalLabel">Create Zone</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mt-3">
                            <label class="bold">Type</label>
                            <select
                                class="form-control choose_value select2_init @error("idzoneformat") is-invalid @enderror"
                                required name="idzoneformat">
                                <option value="6">Banner</option>
                                <option value="18">VAST</option>
                            </select>
                        </div>
                        <div class="mt-3">
                            <label class="bold">Website @include('administrator.components.lable_require')</label>
                            <select name="idsite" class="form-control select2_init" required>
                                @foreach($websites as $itemWebsite)
                                    <option value="{{$itemWebsite['id']}}" {{request('website_id') == $itemWebsite['id'] ? 'selected' : ''}}>{{$itemWebsite['name']}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mt-3">
                            <label class="bold">Size @include('administrator.components.lable_require')</label>
                            <select
                                class="form-control choose_value select2_init @error("iddimension") is-invalid @enderror"
                                required name="iddimension">
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

                        <div class="mt-3">
                            <label class="bold">Name</label>
                            <input type="text" autocomplete="off" name="ad_unit_name"
                                   class="form-control" required>
                        </div>

{{--                        <div class="mt-3">--}}
{{--                            <label class="bold">Share(%) @include('administrator.components.lable_require')</label>--}}
{{--                            <input type="text" autocomplete="off" name="share" value="{{\App\Models\Setting::first()->percent}}"--}}
{{--                                   class="form-control @error('share') is-invalid @enderror" required>--}}
{{--                        </div>--}}
                    </div>
                    <div class="modal-footer justify-content-center">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" onclick="onSubmitAddAdUnit()" class="btn btn-success">Create now</button>
                    </div>

                </form>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="editZone" aria-labelledby="editZoneLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title" id="editZoneLabel">Change status zone</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <div class="mt-3">
                        <label class="bold">Status @include('administrator.components.lable_require')</label>
                        <select name="zone_status_id" class="form-control select2_init" required>
                            <option value="7010">Pending</option>
                            <option value="7000">Approved</option>
                        </select>
                    </div>
                </div>

                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" onclick="onSubmitChangeStatusZone()" class="btn btn-success">Update now</button>
                </div>

            </div>
        </div>
    </div>


    <!-- Modal get code -->
    <div class="modal" id="getCode" tabindex="-1" role="dialog" aria-labelledby="getCode"></div>
    <style>
        .product-table span, .product-table p {
            color: #fff;
        }
    </style>

@endsection

@section('js')

    <script>

        let zone_id, zone_status_id

        function onEditZone(id, id_status) {
            zone_id = id
            zone_status_id = id_status

            $('select[name="zone_status_id"]').val(id_status).change()
        }

        function showConfig(id) {
            $.ajax({
                type: "GET",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                cache: false,
                data: {
                    idzone: id,
                },
                url: "{{route('ajax.administrator.zone.get')}}",
                beforeSend: function () {
                    showLoading()
                },
                success: function (response) {

                    console.log(response)

                    let html = '<ul>'
                    for(let i = 0 ; i < response.assigned_ads.length;i++){
                        html += `
                                <li>
                                    - ${response.assigned_ads[i].campaign.advertiser.name}
                                </li>`
                    }

                    html += `</ul>`

                    $('#container_adververs_' + id).html(html)
                    hideLoading()
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

        function onSubmitAddAdUnit() {
            $.ajax({
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                cache: false,
                data: {
                    idsite: $('select[name="idsite"]').val(),
                    iddimension: $('select[name="iddimension"]').val(),
                    idzoneformat: $('select[name="idzoneformat"]').val(),
                    namedimision: $('select[name="iddimension"] option:selected').text(),
                    name: $('input[name="ad_unit_name"]').val(),
                },
                url: "{{route('ajax.administrator.ad.store')}}",
                beforeSend: function () {
                    showLoading()
                },
                success: function (response) {
                    $('#createModal').modal('hide');
                    Swal.fire(
                        {
                            icon: 'success',
                            title: 'Add success',
                        }
                    );
                    $('.list__data').prepend(response.html);
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

        function onSubmitChangeStatusZone() {
            $.ajax({
                type: "PUT",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                cache: false,
                data: {
                    zone_id: zone_id,
                    zone_status_id: $('select[name="zone_status_id"]').val(),
                },
                url: "{{route('ajax.administrator.zone.update')}}",
                beforeSend: function () {
                    showLoading()
                },
                success: function (response) {
                    hideLoading();
                    $('#editZone').modal('hide');
                    $('.list__data').find('.item'+zone_id).after(response.html).remove();
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

    </script>
@endsection

