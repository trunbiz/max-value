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
                        <div>
                            @include('administrator.components.footer_table')
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
                        <label class="bold">Type</label>
                        <select
                            class="form-control choose_value select2_init @error("idzoneformat") is-invalid @enderror"
                            required name="idzoneformat">
                            <option value="6">Banner</option>
                            <option value="18">VAST</option>
                        </select>
                    </div>
                    <div class="mt-3">
                        <label class="bold">Size</label>
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

@endsection

@section('js')
    <script>

        let id_site
        let id_status

        function oneditStatusModal(idsite, idstatus = 1) {
            id_site = idsite;
            id_status = idstatus;

            $('select[name="status_id"]').val(id_status).change()
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
                    namedimision: $('select[name="iddimension"] option:selected').text(),
                    iddimension: $('select[name="iddimension"]').val(),
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
                    Swal.fire(
                        {
                            icon: 'success',
                            title: 'Add success',
                        }
                    );
                    $('#tr_container_'+id_site).find('td:nth-child(8) div').append(response.html);
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
                    idsite: id_site,
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
                    if(response.status == true){
                        $('#createWebsiteModal').modal('hide');
                        Swal.fire(
                            {
                                icon: 'success',
                                title: 'Add success',
                            }
                        );
                        $('#container_tr').prepend(response.html);
                    }else{
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

        function onSubmitEditWebsite() {

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

    </script>
@endsection

