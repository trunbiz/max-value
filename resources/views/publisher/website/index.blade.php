@extends('publisher.base')
@section('title', 'websites & zones')
@section('content')
    <script src="lib/apexcharts/apexcharts.min.js"></script>
    <style>
        .dashboard-site .card-site {
            margin: 5px 0;
        }
    </style>
    <div class="d-flex align-items-center justify-content-between mb-4">
        <div>
            <h4 class="main-title mb-0">List websites & zones</h4>
        </div>
    </div>

    <div class="row dashboard-site">
        <div class="card-site col-md-6 col-xl-4">
            <div class="card card-one">
                <div class="card-body">
                    <div class="row">
                        <div class="col-7">
                            <h3 class="card-value mb-1">{{ number_format($totalSite) }}</h3>
                            <label class="card-title fw-medium text-dark mb-1">Total Websites</label>
                        </div><!-- col -->
                        <div class="col-5">
                            <div id="apexChart2"></div>
                        </div><!-- col -->
                    </div><!-- row -->
                </div><!-- card-body -->
            </div><!-- card-one -->
        </div><!-- col -->
        <div class="card-site col-md-6 col-xl-4">
            <div class="card card-one">
                <div class="card-body">
                    <div class="row">
                        <div class="col-7">
                            <h3 class="card-value mb-1">{{number_format($totalZone)}}</h3>
                            <label class="card-title fw-medium text-dark mb-1">Total Zones</label>
                        </div><!-- col -->
                        <div class="col-5">
                            <div id="apexChart3"></div>
                        </div><!-- col -->
                    </div><!-- row -->
                </div><!-- card-body -->
            </div><!-- card-one -->
        </div><!-- col -->
        <div class="card-site col-md-6 col-xl-4">
            <div class="card card-one">
                <div class="card-body">
                    <div class="row">
                        <div class="col-7">
                            <h3 class="card-value mb-1">{{number_format($totalZonePending)}}</h3>
                            <label class="card-title fw-medium text-dark mb-1">Pending Zones</label>
                        </div><!-- col -->
                        <div class="col-5">
                            <div id="apexChart33"></div>
                        </div><!-- col -->
                    </div><!-- row -->
                </div><!-- card-body -->
            </div><!-- card-one -->
        </div><!-- col -->
    </div>

    <div class="row" style="padding: 15px; text-align: right">
        <nav class="col-sm-12">
            <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#create-site" onclick="clearSlider()">
                <i class="ri-add-circle-fill"></i> Add website</button>
        </nav>
    </div>

    <div class="row g-3 justify-content-center">
        <table class="table table-hover">
            <thead>
            <tr>
                <th scope="col">Website</th>
                <th scope="col">Category</th>
                <th scope="col">Status</th>
                <th scope="col">Ads.txt</th>
                <th scope="col" class="col-2">Options</th>
            </tr>
            </thead>
            <tbody class="table-list-website">
            @foreach($items as $item)
                <tr class="website-info">
                    <td>{{$item->url}}</td>
                    <td>{{\App\Models\Website::CATEGORY[$item->category_website_id] ?? ''}}</td>
                    <td>
                        @if($item->status == \App\Models\Website::STATUS_PENDING)
                            <span class="badge bg-warning">Pending</span>
                        @elseif($item->status == \App\Models\Website::STATUS_APPROVED)
                            <span class="badge bg-success">Approved</span>
                        @elseif($item->status == \App\Models\Website::STATUS_VERIFICATION)
                            <span class="badge bg-info">Verification</span>
                        @elseif($item->status == \App\Models\Website::STATUS_REJECTED)
                            <span class="badge bg-danger">Rejected</span>
                        @endif
                    </td>
                    <td>
                        @if($item->ads_status == \App\Models\Website::CODE_EMPTY)
                            <i title="Not found" class="ri-checkbox-circle-line checkAdsTxt text-danger"></i>
                        @elseif($item->ads_status == \App\Models\Website::CODE_NOT_UPDATE)
                            <i title="Not update" class="ri-checkbox-circle-line checkAdsTxt text-danger"></i>
                        @elseif($item->ads_status == \App\Models\Website::CODE_ACCEPT)
                            <i title="Verify" class="ri-checkbox-circle-line checkAdsTxt text-success"></i>
                        @endif
                    </td>
                    <td>
                        <button type="button" class="btn btn-outline-primary" onclick="addZone({{$item->api_site_id}}, '{{$item->ads_status}}')"><i class="ri-add-circle-fill"></i> Add zone</button>
                    </td>
                </tr>
                <tr class="zone-info collapse" id="collapseExample">
                    <td colspan="6">
                        <div class="row g-2 align-items-center">
                            @foreach($item->zones as $zone)
                                <div class="col-sm-6 col-md-4 col-xl-3">
                                    <div class="card">
                                        <div class="card-header tx-medium">
                                            <div class="row">
                                                <div class="col-md-8">
                                                    {{$zone->name}}
                                                </div>
                                                <div class="col-md-4 float-right" style="text-align: right">
                                                    @if($zone->status == \App\Models\ZoneModel::STATUS_PENDING && $zone->display_status == \App\Models\ZoneModel::STATUS_SHOW)
                                                        <span class="badge bg-info">Verify</span>
                                                    @elseif($zone->status == \App\Models\ZoneModel::STATUS_PENDING)
                                                        <span class="badge bg-warning">Pending</span>
                                                    @elseif($zone->status == \App\Models\ZoneModel::STATUS_APPROVED)
                                                        <span class="badge bg-success">Approved</span>
                                                    @elseif($zone->status == \App\Models\ZoneModel::STATUS_REJECTED)
                                                        <span class="badge bg-danger">Rejected</span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <p class="card-text">{{\App\Models\ZoneModel::ID_ZONE_FORMAT[$zone->id_zone_format]}}</p>
                                        </div>
                                        <div class="card-footer">
                                            <div class="row">
                                                <div class="col-md-8 col-8">
                                                    <button type="button" class="btn btn-outline-primary" {{in_array($zone->status, [\App\Models\ZoneModel::STATUS_APPROVED, \App\Models\ZoneModel::STATUS_PENDING]) ? '' : 'disabled'}}
                                                            onclick=getCode({{$zone->ad_zone_id}})>Get code
                                                    </button>
                                                </div>
                                                <div class="col-md-4 col-4" style="text-align: right">
                                                    @if($zone->active == \App\Services\Common::ACTIVE)
                                                        <span class="badge bg-success">Active</span>
                                                    @else
                                                        <span class="badge bg-warning">Non-active</span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <div>
        @include('publisher.common.footer_table')
    </div>
    <!-- Modal -->
    <div class="modal fade" id="getCode" tabindex="-1" aria-labelledby="getCode" aria-hidden="true">
    </div>


    <!-- Modal -->
    <div class="modal fade modal-lg" id="create-site" tabindex="-1" aria-labelledby="create-site" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="alert-message">
                </div>
                <!-- Carousel -->
                <div id="registerCarousel" class="carousel slide" data-bs-interval="false">
                    <div class="carousel-inner">

                        <!-- Slide 1: Form đăng ký -->
                        <div class="carousel-item active">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Add website</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form action="" autocomplete="off" id="create-website">
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label for="url" class="">URL (<span class="text-danger">*</span>)  </label>
                                        <input type="text" name="url" class="form-control @error("url") is-invalid @enderror"
                                               required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="category" class="">Category (<span class="text-danger">*</span>)</label>
                                        <select
                                            class="form-control choose_value select2_init @error("idcategory") is-invalid @enderror"
                                            required name="idcategory">
                                            <option value="">Choose</option>
                                            <option value="13">Arts & Entertainment</option>
                                            <option value="33">Automotive</option>
                                            <option value="34">Business</option>
                                            <option value="35">Careers</option>
                                            <option value="36">Education</option>
                                            <option value="37">Family & Parenting</option>
                                            <option value="39">Food & Drink</option>
                                            <option value="28">Health & fitness</option>
                                            <option value="10">Hobbies & Interests</option>
                                            <option value="41">Home & Garden</option>
                                            <option value="42">Law, Government, & Politics</option>
                                            <option value="11">News & Media</option>
                                            <option value="7">Personal Finance</option>
                                            <option value="47">Pets</option>
                                            <option value="52">Real Estate</option>
                                            <option value="46">Science</option>
                                            <option value="23">Shopping</option>
                                            <option value="8">Society</option>
                                            <option value="5">Sports</option>
                                            <option value="49">Style & Fashion</option>
                                            <option value="6">Technology & Computing</option>
                                            <option value="51">Travel</option>
                                            <option value="31">Uncategorized</option>
                                        </select>
                                    </div>
                                    <div class="alert alert-primary" role="alert">
                                        For a faster approval process, please provide the following additional information.
                                    </div>
                                    <div class="mb-3">
                                        <label for="impression" class="">Monthly impression/pageView</label>
                                        <input type="number" name="impression" class="form-control impression" placeholder="1000000">
                                        <div class="form-text" style="margin-left: 10px">Impression: <span class="impression_format">1.000.000</span></div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="geo" class="">Top geo</label>
                                        <input type="text" name="geo" class="form-control geo" placeholder="US, UK, ..." value="">
                                    </div>
                                    <div class="mb-3">
                                        <label for="file_report" class="">Reports (GA, cloudflare reports, ...)</label>
                                        <input type="file" class="form-control file_report" name="file_report">
                                        <div class="form-text">Please tell us about your site's charts and reports.</div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                    <button type="button" class="btn btn-primary filter__button" id="submit" onclick="addSite()">Add website</button>
                                </div>
                            </form>
                        </div>

                        <!-- Slide 2: Tạo zones -->
                        <div class="carousel-item">
                            <!-- Nội dung slide tạo zones -->
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Add Zones</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form action="" id="create-zone" autocomplete="off">
                                <div class="modal-body">
                                    <input class="adSiteId" hidden type="text" name="adSiteId" value="">
                                    @foreach($groupDimensions as $lable => $listDimensions)
                                        <label class="control-label fw-semibold mb-3 mt-3">{{$lable}}</label>
                                        <div class="row">
                                            @foreach($listDimensions as $key => $dimensions)
                                                <div class="col-3">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value="{{$key}}" name="list_zone_dimensions[]">
                                                        <label class="form-check-label" for="flexCheckDefault">
                                                            {{$dimensions['name']}}
                                                        </label>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    @endforeach
{{--                                    <p class="mt-10-f"><a class="control link-opacity-100" target="_blank" href="{{route('publisher.pages.faqs')}}">To view detailed information, please refer to the Frequently Asked Questions (FAQ) section.</a></p>--}}
                                    <p class="mt-4"><a class="control link-opacity-100" target="_blank" href="">To view detailed information, please refer to the Frequently Asked Questions (FAQ) section.</a></p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                    <button type="button" class="btn btn-primary filter__button disabled addZones" id="submit" onclick="addZones()">Add zones
                                    </button>
                                </div>
                            </form>
                        </div>
                        <!-- Slide 3: hướng dẫn config -->
                        <div class="carousel-item">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">The zones were created successfully. Please follow the steps!</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <h5>Step 1: Add the ads.txt file to your website. <i class="ri-checkbox-circle-line checkAdsTxt text-danger"></i></h5>
                                <p class="link-ads"><a class="control link-opacity-100" target="_blank" href="{{route('user.advertises.index')}}">Link ads.txt</a></p>

                                <h5>Step 2: Copy the codes to your website.</h5>
                                <div class="zone-code">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </div>
    </div>
    <style>
    </style>
    <script>
        $(document).ready(function () {
            // Ẩn tất cả các dòng "zone-info" ban đầu
            $('.zone-info').hide();

            // Xử lý sự kiện khi nhấp vào dòng "website-info"
            $('.website-info').click(function () {
                // Tìm dòng "zone-info" liền kề và chuyển trạng thái hiển thị
                $(this).next('.zone-info').toggle();
            });

            $(".select-multiple").select2({
                dropdownParent: $("#create-site")
            });

            @if($items->count() > 0)
                removeCookie('newUser')
            @endif

            if (getCookie('newUser')) {
                $('#create-site').modal('show');
            }

            $('.impression').on('input', function() {
                var input = $(this);
                var value = input.val();
                var formattedValue = value.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ".");
                $('.impression_format').text(formattedValue);
            });

            // Sự kiện khi checkbox được tích hoặc bỏ tích
            $('input[name="list_zone_dimensions[]"]').change(function () {
                // Lấy giá trị của checkbox được thay đổi
                var checkboxValue = $(this).val();

                // Lấy trạng thái (checked hoặc unchecked) của checkbox
                var isChecked = $(this).prop('checked');

                // Tìm tất cả các checkbox có cùng giá trị và đặt trạng thái cho chúng
                $('input[name="list_zone_dimensions[]"][value="' + checkboxValue + '"]').prop('checked', isChecked);
            });
        });

        function addZone(adSiteId, adsStatus)
        {
            $(".adSiteId").val(adSiteId);
            $(".addZones").removeClass("disabled");
            var $this = $('#create-site');
            $this.modal('show');

            $('i.checkAdsTxt').removeClass('text-success');
            $('i.checkAdsTxt').removeClass('text-warning');

            if(adsStatus !== undefined)
            {
                if(adsStatus === 'EMPTY' || adsStatus === 'NOT_UPDATE')
                {
                    $('i.checkAdsTxt').addClass('text-warning');
                }
                else if(adsStatus === 'ACCEPT')
                {
                    $('i.checkAdsTxt').addClass('text-success');
                    $('.link-ads').addClass('d-none');
                }
            }

            // Quay lại slide đầu tiên
            var carousel = new bootstrap.Carousel(document.getElementById('registerCarousel'));
            carousel.to(1);
        }

        function clearSlider()
        {
            // Quay lại slide đầu tiên
            var carousel = new bootstrap.Carousel(document.getElementById('registerCarousel'));
            carousel.to(0);
        }

        //get code
        function getCode(id) {
            var $loading = $('#loading');
            $loading.modal('show');
            var $this = $('#getCode');
            $this.find('form').attr('data-id', id);
            callAjax(
                "GET",
                "{{ route('user.ajax.getcode') }}" + "?id=" + id, {},
                (response) => {
                    $loading.modal('hide');
                    let html = '';
                    $this.find('.getcode__info--name input').val(response.name);
                    $this.html(response.html);
                    $this.modal('show');
                }
            )
        }

        function callAjax(method, url, data, success) {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: data,
                type: method,
                url: url,
                processData: false,
                contentType: false,
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

        function getAllSite()
        {
            $.ajax({
                url: "{{ route('user.ajax.websites.listWebsiteInPage') }}",
                type: "GET",
                processData: false,
                contentType: false,
                success: function (response) {
                    if (response.success == true) {
                        $(".table-list-website").empty();
                        $(".table-list-website").html(response.data.html);
                    } else {
                    }
                },
                error: function(XMLHttpRequest, textStatus, errorThrown) {
                    $('#registerCarousel').carousel('prev')
                    alert(XMLHttpRequest.responseText);
                }
            });
        }

        //addSite
        function addSite() {
            $(".alert-message").empty();
            var $this = $('#create-website');
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

                var formData = new FormData;
                formData.append('idcategory', $this.find('select[name="idcategory"]').val());
                formData.append('url', url);
                formData.append('impression', $( ".impression" ).val());
                formData.append('geo', $( ".geo" ).val());
                formData.append('file_report', $( ".file_report" )[0].files[0]); //
                formData.append('_token', $('meta[name="csrf-token"]').attr('content'));

                $('#registerCarousel').carousel('next')
                $.ajax({
                    url: "{{ route('user.websites.store') }}",
                    type: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function (response) {
                        if (response.status == true) {
                            $(".adSiteId").val(response.data.api_site_id);
                            removeCookie('newUser')
                            $(".addZones").removeClass("disabled");
                            getAllSite();
                            // $(".alert-message").append('<div class="alert alert-success" role="alert">' + response.message + '</div>')
                        } else {
                            $('#registerCarousel').carousel('prev')
                            $(".alert-message").append('<div class="alert alert-danger" role="alert">' + response.message + '</div>')
                        }
                    },
                    error: function(XMLHttpRequest, textStatus, errorThrown) {
                        $('#registerCarousel').carousel('prev')
                        alert(XMLHttpRequest.responseText);
                    }
                });
            }

        }

        function addZones()
        {
            $(".alert-message").empty();
            var $this = $('#create-zone');
            var formZoneData = new FormData();
            formZoneData.append('adSiteId', $this.find('input[name="adSiteId"]').val());

            $this.find('input[name="list_zone_dimensions[]"]:checked').each(function() {
                formZoneData.append('list_zone_dimensions[]', $(this).val());
            });
            formZoneData.append('_token', $('meta[name="csrf-token"]').attr('content'));
            var $loading = $('#loading');
            $loading.modal('show');
            $.ajax({
                url: "{{ route('user.ajax.zone.store') }}",
                type: "POST",
                data: formZoneData,
                processData: false,
                contentType: false,
                success: function (response) {
                    if (response.success == true) {
                        $(".zone-code").html(response.data.html)
                        $('#registerCarousel').carousel('next')
                        getAllSite();
                    } else {
                        $(".alert-message").append('<div class="alert alert-danger" role="alert">' + response.message + '</div>')
                    }
                    $loading.modal('hide');
                },
                error: function(XMLHttpRequest, textStatus, errorThrown) {
                    $loading.modal('hide');
                    alert(XMLHttpRequest.responseText);
                }
            });
        }

        // Ẩn modal
        function hideModal() {
            myModal.classList.remove('show');
            myModal.style.display = 'none';
            myModal.setAttribute('aria-hidden', 'true');
            myModal.setAttribute('aria-modal', 'false');
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
    </script>
    <script src="assets/js/db.data.js"></script>
    <script src="assets/js/db.analytics.js"></script>
@endsection
