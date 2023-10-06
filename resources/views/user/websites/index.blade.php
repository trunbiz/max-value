@extends('user.layouts.master')

@include('user.'.$prefixView.'.header')

@section('css')

@endsection

@section('content')
    <div class="content-main">
        <div class="ads-wrapper__select-site bg-white websites-wrapper">
            <div class="add__site">
                <button class="filter__button" data-bs-toggle="modal" data-bs-target="#addWebsite">
                    ADD WEBSITE
                </button>
            </div>
        </div>
        <div class="row">
            <div class="accordion" id="accordionExample">
                @foreach($items as $itemWebsite)
                    <div class="accordion-item" id="item{{ $itemWebsite->api_site_id }}">
                        <h2 class="accordion-header" id="heading{{ $itemWebsite->api_site_id }}">
                            @if($itemWebsite->status == 3500)
                                <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapse{{ $itemWebsite->api_site_id }}" aria-expanded="true"
                                        aria-controls="collapse{{ $itemWebsite->api_site_id }}">
                                    @else
                                        <button class="accordion-button" type="button" style="cursor:auto;">@endif
                                            <div class="info__site">
                                                <div class="name__site">
                                                    {{$itemWebsite['url']}}
                                                </div>
                                                <div
                                                    class="status__site {{ strtolower(\App\Models\Website::STATUS[$itemWebsite->status] ?? '') }}">
                                                    {{ \App\Services\Common::STATUS_ADSERVER[$itemWebsite->status] ?? '' }}
                                                </div>
                                                <div class="category__site">
                                                    <i class="fa-regular fa-folder"></i>
                                                    <span> {{\App\Models\Website::CATEGORY[$itemWebsite->category_website_id] ?? ''}}</span>
                                                </div>
                                            </div>
                                            @if($itemWebsite->status == 3500)
                                                <div class="action__site">
                                                </div>
                                            @endif
                                        </button>
                        </h2>
                        <div id="collapse{{ $itemWebsite->api_site_id }}" data-id="{{ $itemWebsite->api_site_id }}"
                             class="accordion-collapse collapse"
                             aria-labelledby="heading{{ $itemWebsite->api_site_id }}"
                             data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                <div class="list__advs">
                                    @foreach($itemWebsite->zones as $itemZone)
                                        <div class="list__advs--item">
                                            <div class="title__advs">
                                                <div class="title__advs--title">
                                                    <span>{{$itemZone->name}}</span>
                                                    <p>{{\App\Models\ZoneModel::ID_ZONE_FORMAT[$itemZone->id_zone_format] ?? ''}}</p>
                                                </div>
                                                <div
                                                    class="title__advs--status {{ strtolower(\App\Models\ZoneModel::STATUS_ADSERVER[$itemZone->status] ?? '') }}">
                                                    {{ \App\Models\ZoneModel::STATUS_ADSERVER[$itemZone->status] ?? '' }}
                                                </div>
                                            </div>
                                            <div class="info__advs">
                                                <div
                                                    style="{{ strtolower(\App\Models\ZoneModel::STATUS_ADSERVER[$itemZone->status] ?? '') == "approved" ? "" : "cursor: no-drop;opacity: 0.5;"}}"
                                                    class="info__advs--get" {{ strtolower(\App\Models\ZoneModel::STATUS_ADSERVER[$itemZone->status] ?? '') == "approved" ? 'onclick=getCode('. $itemZone->ad_zone_id . ')' : "cursor: no-drop;opacity: 0.5;"}}>
                                                    <i class="fa-regular fa-clipboard"></i>
                                                    GET CODE
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

    <!-- Modal add website -->
    <div class="modal" id="addWebsite" tabindex="-1" role="dialog" aria-labelledby="addWebsite">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title">Add Website</h2>
                </div>
                <form action="" autocomplete="off">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="category">Category&nbsp<span class="text-danger">*</span></label>
                            <select
                                class="form-control choose_value select2_init @error("idcategory") is-invalid @enderror"
                                required name="idcategory">
                                <option value="">Choose</option>
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
                        <div class="form-group">
                            <label for="url">URL <span class="text-danger">*</span></label>
                            <input type="text" name="url" class="form-control @error("url") is-invalid @enderror"
                                   required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn-cancel" data-bs-dismiss="modal">Cancel</button>
                        <button type="button" class="btn-cancel filter__button" id="submit" onclick="addSite()">Add
                            now
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal update website -->
    <div class="modal" id="editWebsite" tabindex="-1" role="dialog" aria-labelledby="editWebsite">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title">Edit Website</h2>
                </div>
                <form action="" autocomplete="off">
                    <div class="modal-body">
                        <div class="row form-group">
                            <div class="col-md-12 col-12">
                                <label for="category">Category&nbsp<span class="text-danger">*</span></label>
                                <select
                                    class="form-control choose_value select2_init @error("idcategory") is-invalid @enderror"
                                    required name="idcategory">
                                    <option value="">Choose</option>
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
                                @error('idcategory')
                                <div class="alert alert-danger">{{$message}}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-md-12 col-12">
                                <label for="url">URL&nbsp<span class="text-danger">*</span></label>
                                <input type="text" name="url" class="form-control @error("url") is-invalid @enderror"
                                       required>
                                @error('url')
                                <div class="alert alert-danger">{{$message}}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn-cancel" data-bs-dismiss="modal">Cancel</button>
                        <button type="button" class="btn-cancel filter__button" id="submit" onclick="updateSite()">
                            Edit
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal add ad unit -->
    <div class="modal" id="addUnit" tabindex="-1" role="dialog" aria-labelledby="addUnit">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title">Add Ad Unit</h2>
                </div>
                <form action="">
                    <div class="modal-body">
                        <div class="row form-group">
                            <div class="col-md-12 col-12">
                                <label for="name">Name Ad Unit&nbsp<span class="text-danger">*</span></label>
                                <input type="text" name="name" class="form-control @error("name") is-invalid @enderror"
                                       required>
                                @error('name')
                                <div class="alert alert-danger">{{$message}}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-md-12 col-12">
                                <label for="iddimension">Type&nbsp<span class="text-danger">*</span></label>
                                <select onchange="changeValue()"
                                        class="form-select form-control @error("idzoneformat") is-invalid @enderror"
                                        name="idzoneformat" aria-label="Default select example" required>
                                    <option value="">Choose</option>
                                    <option value="6">Banner</option>
                                    <option value="18">VAST</option>
                                    @error('idzoneformat')
                                    <div class="alert alert-danger">{{$message}}</div>
                                    @enderror
                                </select>
                            </div>
                        </div>
                        <div class="row form-group size__banner" style="display: none">
                            <div class="col-md-12 col-12">
                                <label for="iddimension">Size&nbsp<span class="text-danger">*</span></label>
                                <select class="form-select form-control @error("iddimension") is-invalid @enderror"
                                        name="iddimension" aria-label="Default select example" required>
                                    <option value="">Choose</option>
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
                                    @error('iddimension')
                                    <div class="alert alert-danger">{{$message}}</div>
                                    @enderror
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn-cancel" data-bs-dismiss="modal">Cancel</button>
                        <button type="button" class="btn-cancel filter__button" id="submit" onclick="addAd()">Add now
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <!-- Modal get code -->
    <div class="modal" id="getCode" tabindex="-1" role="dialog" aria-labelledby="getCode">

    </div>

@endsection

@section('js')

    <script>
        function callAjax(method, url, data, success) {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: data,
                type: method,
                url: url,
                beforeSend: function () {
                    $('#loader').removeClass('loading');
                },
                success: function (response, textStatus, jqXHR) {
                    success(response);
                },
                complete: function () {
                    $('#loader').addClass('loading');
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    alert(errorThrown);
                }
            })
        }

        //getSite
        function getSite(id) {
            var $this = $('#editWebsite');
            $this.find('form').attr('data-id', id);
            callAjax(
                "GET",
                "{{ route('user.ajax.getSite') }}" + "?id=" + id, {},
                (response) => {
                    $this.find('input[name="name"]').val(response.name);
                    $this.find('select[name="idcategory"]').val(response.category_id);
                    $this.find('input[name="url"]').val(response.url);
                    $this.modal('show');
                }
            )
        }

        //createAd
        function openPopup(id) {
            var $this = $('#addUnit');
            $this.find('form').attr('data-id', id);
            $this.modal('show');
            console.log(id);
        }


        //updateSite
        function updateSite() {
            var $this = $('#editWebsite');
            var id = $this.find('form').data('id');
            if ($this.find('select[name="idcategory"]').val() == '') {
                swal("Erorr!", 'Please choose a option', "error");
            } else if ($this.find('input[name="url"]').val() == '') {
                swal("Erorr!", 'Url is required', "error");
            } else {
                let url = $this.find('input[name="url"]').val();

                if (!url.includes("http")) {
                    url = "https://" + url;
                }

                if (!isValidHttpUrl(url)) {
                    swal("Erorr!", 'Url is not isValid', "error");
                    return;
                }

                callAjax(
                    "PUT",
                    "{{ route('user.websites.update') }}" + "?id=" + id,
                    {
                        'idcategory': $this.find('select[name="idcategory"]').val(),
                        'url': $this.find('input[name="url"]').val(),
                    },
                    (response) => {
                        $this.modal('hide');
                        if (response.errors) {
                            swal("Erorr!", response.message, "error");
                        } else {
                            $('#item' + id).find('.name__site').html(response.url);
                            $('#item' + id).find('.category__site > span').html(response.category_name)
                            swal("Success!", 'Update successful', "success");
                        }

                    }
                )
            }
        }

        //addSite
        function addSite() {
            var $this = $('#addWebsite');
            if ($this.find('select[name="idcategory"]').val() == '') {
                swal("Erorr!", 'Please choose a option', "error");
            } else if ($this.find('input[name="url"]').val() == '') {
                swal("Erorr!", 'Url is required', "error");
            } else {
                let url = $this.find('input[name="url"]').val();

                if (!url.includes("http")) {
                    url = "https://" + url;
                }

                if (!isValidHttpUrl(url)) {
                    swal("Erorr!", 'Url is not isValid', "error");
                    return;
                }

                callAjax(
                    "POST",
                    "{{ route('user.websites.store') }}",
                    {
                        'idcategory': $this.find('select[name="idcategory"]').val(),
                        'url': url,
                    },
                    (response) => {
                        if (response.status == true) {
                            $this.modal('hide');
                            swal("Success!", 'Add successful', "success");
                            $('.accordion').prepend(response.html);
                            $this.find('input[name="url"]').val('');
                            $this.find('select[name="idcategory"]').val('');
                        } else {
                            swal("Erorr!", response.message, "error");
                        }

                    }
                )
            }

        }

        function isValidHttpUrl(string) {
            let url;
            try {
                url = new URL(string);
            } catch (_) {
                return false;
            }
            return url.protocol === "http:" || url.protocol === "https:";
        }

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

        //filter
        const url = new URL(decodeURIComponent(window.location.href));
        if (url.searchParams.get("selectSite")) {
            $('.selectSite').val(url.searchParams.get("selectSite"))
        }

        $(document).ready(function () {
            $(".selectSite").change(function () {
                let id = $(".selectSite").val();
                let searchParams = new URLSearchParams(window.location.search)
                searchParams.set('selectSite', id)
                window.location.search = searchParams.toString()
            })

        })

    </script>
@endsection

