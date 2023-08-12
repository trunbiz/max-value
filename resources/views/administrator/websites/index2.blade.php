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

                    <div class="card-body" style="padding-top: 0">
                        <div class="accordion" id="accordionExample">
                            @foreach($items as $itemWebsite)
                                <div class="accordion-item" id="item{{ $itemWebsite['id'] }}">
                                    <h2 class="accordion-header" id="heading{{ $itemWebsite['id'] }}">
                                        @if($itemWebsite['status']['name'] == 'Approved')
                                            <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                                    data-bs-target="#collapse{{ $itemWebsite['id'] }}"
                                                    aria-expanded="true"
                                                    aria-controls="collapse{{ $itemWebsite['id'] }}">
                                                @else
                                                    <button class="accordion-button" type="button"
                                                            style="cursor:auto;">@endif
                                                        <div class="info__site">
                                                            <div class="name__site">
                                                                <a style="cursor: pointer;" onclick="onEditWebsiteModal('{{$itemWebsite['id']}}','{{$itemWebsite['publisher']['id']}}','{{$itemWebsite['name']}}','{{$itemWebsite['url']}}','{{$itemWebsite['category']['id'] ?? null}}')"
                                                                   title="Edit" data-bs-toggle="modal" data-bs-target="#editWebsiteModal">
                                                                    {{$itemWebsite['url']}}
                                                                </a>
                                                            </div>
                                                            <div
                                                                onclick="oneditStatusModal({{$itemWebsite['id']}}, {{$itemWebsite['status']['id']}})"
                                                                style="cursor: pointer;display: flex;" data-bs-toggle="modal"
                                                                data-bs-target="#editStatusModal"
                                                                class="status__site {{ strtolower($itemWebsite['status']['name']) }}">
                                                                {{ $itemWebsite['status']['name'] }} <i class="fa-solid fa-rotate"></i>
                                                            </div>


                                                            <div class="category__site">{{$itemWebsite['publisher']['name'] ?? ''}}</span>
                                                            </div>
                                                            <div class="category__site">
                                                                <a onclick="oneditStatusModal('{{$itemWebsite['id']}}')"
                                                                   style="cursor: pointer;"
                                                                   title="Add zone" data-bs-toggle="modal"
                                                                   data-bs-target="#createZoneModal">
                                                                    Add zone
                                                                </a>
                                                            </div>
                                                            <div class="category__site">
                                                                <a onclick="deleteSite('{{$itemWebsite['id']}}')"
                                                                   style="cursor: pointer;"
                                                                   title="Delete site">
                                                                    <span class="badge badge-danger"><i class="fa-solid fa-xmark"></i></span>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </button>

                                    </h2>
                                    <div id="collapse{{ $itemWebsite['id'] }}" data-id="{{ $itemWebsite['id'] }}"
                                         class="accordion-collapse collapse"
                                         aria-labelledby="heading{{ $itemWebsite['id'] }}"
                                         data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            <div class="list__advs">
                                                @foreach($itemWebsite['zones'] as $itemZone)
                                                    <div class="list__advs--item">
                                                        <div class="title__advs">
                                                            <div class="title__advs--title">
                                                                <span>{{$itemZone['name']}}</span>
                                                                <p>
                                                                @if($itemZone['is_active'])
                                                                    <span class="badge badge-success">Active</span>
                                                                @else
                                                                    <span class="badge badge-warning">Off</span>
                                                                @endif
                                                                    {{$itemZone['format']['name']}}
                                                                </p>
                                                            </div>
                                                            <div
                                                                onclick="onEditZone({{$itemZone['id']}}, {{$itemZone['status']['id']}}, {{$itemZone['is_active']}})"
                                                                style="cursor: pointer;display: flex;" data-bs-toggle="modal"
                                                                data-bs-target="#editZone"
                                                                class="title__advs--status {{ strtolower($itemZone['status']['name']) }}">
                                                                {{ $itemZone['status']['name'] }} <i class="fa-solid fa-rotate"></i>
                                                            </div>
                                                            <span class="badge badge-danger" onclick="removeZone({{$itemZone['id']}})"><i class="fa-solid fa-xmark"></i></span>
                                                        </div>
                                                        <br>
                                                        <div class="row" style="width: 100%">
                                                            <div class="col-sm-6">
                                                                <div class="info__advs">
                                                                    <div
                                                                        style="{{ strtolower($itemZone['status']['name']) == "approved" ? "" : "cursor: no-drop;opacity: 0.5;"}}"
                                                                        class="info__advs--get" {{ strtolower($itemZone['status']['name']) == "approved" ? 'onclick=getCode('. $itemZone["id"] . ')' : "cursor: no-drop;opacity: 0.5;"}}>
                                                                        <i class="fa-regular fa-clipboard"></i>
                                                                        GET CODE
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <div class="info__advs">
                                                                    <a href="{{route('administrator.advertises.detail.index' , ['id'=> $itemZone['id'] ])}}"
                                                                       title="Edit">
                                                                        <i class="fa-solid fa-circle-info"></i> CONFIG
                                                                    </a>
{{--                                                                    <div title="Edit" class="info__advs--get" onclick="DetailZone({{$itemZone["id"]}})">--}}
{{--                                                                        <i class="fa-solid fa-circle-info"></i> CONFIG--}}
{{--                                                                    </div>--}}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>

    <style>
        .product-table span, .product-table p {
            color: #fff;
        }
    </style>

    <!-- Modal -->
    <div class="modal fade" id="createWebsiteModal" aria-labelledby="createWebsiteModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createWebsiteModalLabel">Create website</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <div class="mt-3">
                        <label class="bold">Publisher</label>
                        <select
                            class="form-control choose_value select2_init @error("web_site_id_publisher") is-invalid @enderror"
                            required name="web_site_id_publisher">
                            @foreach($publishers as $publisher)
                                <option value="{{$publisher['id']}}">{{$publisher['email']}}</option>
                            @endforeach
                        </select>
                    </div>


                    <div class="mt-3">
                        <label class="bold">Url @include('administrator.components.lable_require')</label>
                        <input type="text" autocomplete="off" name="web_site_url" required
                               class="form-control @error('web_site_url') is-invalid @enderror">
                    </div>

                    <div class="mt-3">
                        <label class="bold">Category @include('administrator.components.lable_require')</label>
                        <select
                            class="form-control choose_value select2_init @error("web_site_category") is-invalid @enderror"
                            required name="web_site_category">
                            <option value="13">Arts &amp; Entertainment</option>
                            <option value="33">Automotive</option>
                            <option value="34">Business</option>
                            <option value="35">Careers</option>
                            <option value="36">Education</option>
                            <option value="37">Family &amp; Parenting</option>
                            <option value="39">Food &amp; Drink</option>
                            <option value="28">Health &amp; fitness</option>
                            <option value="10">Hobbies &amp; Interests</option>
                            <option value="41">Home &amp; Garden</option>
                            <option value="42">Law, Government, &amp; Politics</option>
                            <option value="11">News &amp; Media</option>
                            <option value="7">Personal Finance</option>
                            <option value="47">Pets</option>
                            <option value="52">Real Estate</option>
                            <option value="46">Science</option>
                            <option value="23">Shopping</option>
                            <option value="8">Society</option>
                            <option value="5">Sports</option>
                            <option value="49">Style &amp; Fashion</option>
                            <option value="6">Technology &amp; Computing</option>
                            <option value="51">Travel</option>
                            <option value="31">Uncategorized</option>
                        </select>
                    </div>

                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" onclick="onSubmitAddWebsite()" class="btn btn-success">Create now</button>
                </div>

            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="editWebsiteModal" aria-labelledby="editWebsiteModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createWebsiteModalLabel">Edit website</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <div class="mt-3">
                        <label class="bold">Publisher</label>
                        <select id="edit_select_idpublisher_site"
                                class="form-control choose_value select2_init @error("web_site_id_publisher") is-invalid @enderror"
                                required name="web_site_id_publisher">
                            @foreach($publishers as $publisher)
                                <option value="{{$publisher['id']}}">{{$publisher['email']}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mt-3">
                        <label class="bold">Url @include('administrator.components.lable_require')</label>
                        <input id="edit_url_site" type="text" autocomplete="off" name="web_site_url" required
                               class="form-control @error('web_site_url') is-invalid @enderror">
                    </div>

                    <div class="mt-3">
                        <label class="bold">Category @include('administrator.components.lable_require')</label>
                        <select id="edit_select_idcategory_site"
                                class="form-control choose_value select2_init @error("web_site_category") is-invalid @enderror"
                                required name="web_site_category">
                            <option value="13">Arts &amp; Entertainment</option>
                            <option value="33">Automotive</option>
                            <option value="34">Business</option>
                            <option value="35">Careers</option>
                            <option value="36">Education</option>
                            <option value="37">Family &amp; Parenting</option>
                            <option value="39">Food &amp; Drink</option>
                            <option value="28">Health &amp; fitness</option>
                            <option value="10">Hobbies &amp; Interests</option>
                            <option value="41">Home &amp; Garden</option>
                            <option value="42">Law, Government, &amp; Politics</option>
                            <option value="11">News &amp; Media</option>
                            <option value="7">Personal Finance</option>
                            <option value="47">Pets</option>
                            <option value="52">Real Estate</option>
                            <option value="46">Science</option>
                            <option value="23">Shopping</option>
                            <option value="8">Society</option>
                            <option value="5">Sports</option>
                            <option value="49">Style &amp; Fashion</option>
                            <option value="6">Technology &amp; Computing</option>
                            <option value="51">Travel</option>
                            <option value="31">Uncategorized</option>
                        </select>
                    </div>

                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" onclick="onSubmitEditWebsite()" class="btn btn-success">Update now</button>
                </div>

            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="createZoneModal" aria-labelledby="createZoneModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createZoneModalLabel">Create zone</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mt-3">
                        <input hidden name="zoneId" id="zoneId">
                        <label class="bold">Type <span class="text-danger">*</span></label>
                        <select
                            class="form-control choose_value select2_init @error("idzoneformat") is-invalid @enderror"
                            required name="idzoneformat" id="idzoneformat">
                            <option value="6">Banner</option>
                            {{--                            <option value="18">VAST</option>--}}
                        </select>
                    </div>
                    <div class="mt-3">
                        <label class="bold">Dimensions matching method <span class="text-danger">*</span></label>
                        <select
                            class="form-control choose_value select2_init @error("iddimension") is-invalid @enderror"
                            required name="idDimensionMethod" id="idDimensionMethod">
                            @foreach($listDimensionsMethod as $key => $value)
                                <option value="{{$key}}">{{$value}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mt-3">
                        <label class="bold">Dimensions <span class="text-danger">*</span></label>
                        <select
                            class="form-control choose_value select2_init @error("iddimension") is-invalid @enderror"
                            required name="idDimension" id="idDimension">
                            @foreach($listDimensions as $key => $value)
                                <option value="{{$key}}">{{$value['name']}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mt-3">
                        <label class="bold">Name</label>
                        <input type="text" autocomplete="off" name="ad_unit_name" id="ad_unit_name"
                               class="form-control @error('ad_unit_name') is-invalid @enderror">
                    </div>

                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" onclick="onAddZone()" class="btn btn-success">Create now</button>
                </div>

            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="editStatusModal" aria-labelledby="editStatusModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title" id="editStatusModalLabel">Change status</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <input hidden name="site_id">
                    <div class="mt-3">
                        <label class="bold">Status @include('administrator.components.lable_require')</label>
                        <select name="status_id" class="form-control select2_init" required>
                            <option value="3520">Pending</option>
                            <option value="3500">Approved</option>
                            <option value="3525">Verification</option>
                            <option value="3510">Blocked</option>
                        </select>
                    </div>
                </div>

                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success" onclick="onSubmitEditStatus()">Update now</button>
                </div>

            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="editActiveModal" aria-labelledby="editActiveModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title" id="editActiveModalLabel">Change status</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <div class="mt-3">
                        <label class="bold">Active? @include('administrator.components.lable_require')</label>
                        <select name="active_id" class="form-control select2_init" required>
                            <option value="true">Yes</option>
                            <option value="false">No</option>
                        </select>
                    </div>
                </div>

                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success" onclick="onSubmitEditActive()">Update now</button>
                </div>

            </div>
        </div>
    </div>
    <!-- Modal get code -->
    <div class="modal" id="getCode" tabindex="-1" role="dialog" aria-labelledby="getCode"></div>

{{--    update status zone--}}
    <div class="modal fade" id="editZone" aria-labelledby="editZoneLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title" id="editZoneLabel">Change status zone</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input hidden name="zone_id" value="">
                    <div class="mt-3">
                        <label class="bold">Moderation @include('administrator.components.lable_require')</label>
                        <select name="zone_status_id" class="form-control select2_init" required>
                            <option value="7010">Pending</option>
                            <option value="7000">Approved</option>
                            <option value="7020">Rejected</option>
                        </select>
                    </div>
                    <div class="mt-3">
                        <input class="form-check-input" type="checkbox" name="zone_active" id="zone_active" value="1">
                        <label class="form-check-label" for="flexCheckChecked">
                            Active
                        </label>
                    </div>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" onclick="onSubmitChangeStatusZone()" class="btn btn-success">Update now</button>
                </div>

            </div>
        </div>
    </div>
@endsection
<link rel="stylesheet" type="text/css" href="{{asset('/assets/user/css/bootstrap.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('/assets/user/css/daterangepicker.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('/assets/user/css/date-picker.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('/assets/user/css/sweetalert2.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('/assets/user/css/swiper-bundle.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('/assets/user/css/select2.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('/assets/user/css/style.css')}}">
@section('js')
    <script>

        let id_site
        let id_status

        function oneditStatusModal(idsite, idstatus = 1) {
            id_site = idsite;
            id_status = idstatus;

            $('select[name="status_id"]').val(id_status).change()
            $('select[name="site_id"]').val(idsite).change()
        }

        function deleteSite(siteId)
        {
            var checkDelete = confirm("Want to delete?");
            if (!checkDelete) {
                return;
            }
            $.ajax({
                type: "DELETE",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                cache: false,
                data: {
                    id: siteId,
                },
                url: "{{route('ajax.administrator.website.delete')}}",
                beforeSend: function () {
                    showLoading()
                },
                success: function (response) {
                    window.location.reload();
                    Swal.fire(
                        {
                            icon: 'success',
                            title: 'remove success',
                        }
                    );
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

        function onEditZone(zoneId, statusId, active) {
            $('input[name="zone_id"]').val(zoneId).change()
            $('select[name="zone_status_id"]').val(statusId).change()
            if (active)
            {
                $( "#zone_active").prop('checked', true);
            }else {
                $("#zone_active").prop('checked', false);
            }
        }

        function removeZone(zoneId)
        {
            var checkDelete = confirm("Want to delete?");
            if (!checkDelete) {
                return;
            }
            $.ajax({
                type: "DELETE",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                cache: false,
                data: {
                    id: zoneId,
                },
                url: "{{route('ajax.administrator.zone.delete')}}",
                beforeSend: function () {
                    showLoading()
                },
                success: function (response) {
                    window.location.reload();
                    Swal.fire(
                        {
                            icon: 'success',
                            title: 'remove success',
                        }
                    );
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

        function onSubmitChangeStatusZone()
        {
            var checkActive = 0;
            if ($('input[name="zone_active"]').is(":checked")) {
                checkActive = 1 // Nếu checked, thiết lập giá trị thành 1
            } else {
                checkActive = 0 // Nếu unchecked, thiết lập giá trị thành 0
            }

            $.ajax({
                type: "PUT",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                cache: false,
                data: {
                    zone_id: $('input[name="zone_id"]').val(),
                    zone_status_id: $('select[name="zone_status_id"]').val(),
                    zone_active: checkActive,
                },
                url: "{{route('ajax.administrator.zone.update')}}",
                beforeSend: function () {
                    showLoading()
                },
                success: function (response) {
                    window.location.reload();
                    Swal.fire(
                        {
                            icon: 'success',
                            title: 'update success',
                        }
                    );
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

        function DetailZone(id)
        {
            var $this = $('#createZoneModal');
            callAjax(
                "GET",
                "{{ route('ajax.administrator.zone.detail') }}" + "?id="+id,{},
                (response) => {
                    let data = response.data;
                    $('#ad_unit_name').val(data.name)
                    $('#zoneId').val(id)
                    $("#createZoneModalLabel").empty();
                    $("#createZoneModalLabel").append("Chi tiết Zone")
                    $this.modal('show');
                }

            )
            $this.modal('show');
        }

        function onEditWebsiteModal(idsite, idpublisher, name, url, idcategory) {
            id_site = idsite;

            $('#edit_select_idpublisher_site').val(idpublisher).change()
            $('#edit_name_site').val(name)
            $('#edit_url_site').val(url)
            $('#edit_select_idcategory_site').val(idcategory).change()
        }


        function onEditActiveModal(idsite, idstatus) {
            id_site = idsite;
            $('select[name="active_id"]').val(idstatus).change()
        }

        function onAddZone() {
            $.ajax({
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                cache: false,
                data: {
                    name: $('input[name="ad_unit_name"]').val(),
                    namedimision: $('select[name="idDimension"] option:selected').text(),
                    iddimension: $('select[name="idDimension"]').val(),
                    idDimensionMethod: $('select[name="idDimensionMethod"]').val(),
                    idzoneformat: $('select[name="idzoneformat"]').val(),
                    idsite: id_site,
                },
                url: "{{route('ajax.administrator.zone.store')}}",
                beforeSend: function () {
                    showLoading()
                },
                success: function (response) {
                    $('#createZoneModal').modal('hide');
                    $('#no_zone').remove();
                    window.location.reload();
                    Swal.fire(
                        {
                            icon: 'success',
                            title: 'Add success',
                        }
                    );
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

        function onSubmitEditActive() {

            $.ajax({
                type: "PUT",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                cache: false,
                data: {
                    idsite: id_site,
                    is_active: $('select[name="active_id"]').val() == "true" ? 1 : 0,
                },
                url: "{{route('ajax.administrator.website.update')}}",
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
            })
        }

        function onSubmitEditStatus() {

            $.ajax({
                type: "PUT",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                cache: false,
                data: {
                    idsite: $('select[name="site_id"]').val(),
                    idstatus: $('select[name="status_id"]').val(),
                },
                url: "{{route('ajax.administrator.website.update')}}",
                beforeSend: function () {
                    showLoading()
                },
                success: function (response) {
                    hideModal('editStatusModal')
                    hideLoading()
                    $('#tr_container_' + id_site).html(response.html_row)
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

        function onSubmitAddWebsite() {

            $.ajax({
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                cache: false,
                data: {
                    url: $('input[name="web_site_url"]').val(),
                    id_category: $('select[name="web_site_category"]').val(),
                    id_publisher: $('select[name="web_site_id_publisher"]').val(),
                },
                url: "{{route('ajax.administrator.website.store')}}",
                beforeSend: function () {
                    showLoading()
                },
                success: function (response) {
                    if (response.status == true) {
                        $('#createWebsiteModal').modal('hide');
                        Swal.fire(
                            {
                                icon: 'success',
                                title: 'Add success',
                            }
                        );
                        $('#container_tr').prepend(response.html);
                        window.location.reload();
                    } else {
                        Swal.fire(
                            {
                                icon: 'error',
                                title: response.message,
                            }
                        );
                    }
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

        function onSubmitEditWebsite(id_site) {

            $.ajax({
                type: "PUT",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                cache: false,
                data: {
                    idsite: id_site,
                    name: $('#edit_name_site').val(),
                    url: $('#edit_url_site').val(),
                    id_category: $('#edit_select_idcategory_site').val(),
                    id_publisher: $('#edit_select_idpublisher_site').val(),
                },
                url: "{{route('ajax.administrator.website.update')}}",
                beforeSend: function () {
                    showLoading()
                },
                success: function (response) {
                    hideModal('editWebsiteModal')
                    hideLoading()
                    $('#tr_container_' + id_site).html(response.html_row)
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

