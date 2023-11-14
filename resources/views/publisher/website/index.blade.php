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
            <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#create-site">
                <i class="ri-add-circle-fill"></i> Add</button>
        </nav>
    </div>

    <div class="row g-3 justify-content-center">
        <table class="table table-hover">
            <thead>
            <tr>
                <th scope="col">Website</th>
                <th scope="col">Category</th>
                <th scope="col">Status</th>
            </tr>
            </thead>
            <tbody>
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
                </tr>
                <tr class="zone-info collapse" id="collapseExample">
                    <td colspan="4">
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
                                                    @if($zone->status == \App\Models\ZoneModel::STATUS_PENDING)
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
                                                <div class="col-md-4">
                                                    <button type="button" class="btn btn-outline-primary" {{$zone->status == \App\Models\ZoneModel::STATUS_APPROVED ? '' : 'disabled'}}
                                                            onclick=getCode({{$zone->ad_zone_id}})>Get code
                                                    </button>
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
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Create Site</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="" autocomplete="off">
                    <div class="modal-body">
                        <div class="alert alert-primary" role="alert">
                            For a faster approval process, please provide the following additional information.
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
                        <div class="mb-3">
                            <label for="url" class="">URL (<span class="text-danger">*</span>)  </label>
                            <input type="text" name="url" class="form-control @error("url") is-invalid @enderror"
                                   required>
                        </div>
                        <div class="mb-3">
                            <label for="impression" class="">Monthly impression/pageview</label>
                            <input type="number" name="impression" class="form-control impression" placeholder="1.000.000">
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
                        <button type="button" class="btn btn-primary filter__button" id="submit" onclick="addSite()">Add
                            now
                        </button>
                    </div>
                </form>
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

        //addSite
        function addSite() {
            var $this = $('#create-site');
            if ($this.find('select[name="idcategory"]').val() == '') {
                swal("Erorr!", 'Please choose a option', "error");
            } else if ($this.find('input[name="url"]').val() == '') {
                swal("Erorr!", 'Url is required', "error");
            } else {
                var $createSite = $('#create-site').modal('hide');
                $createSite.modal('hide');
                var $loading = $('#loading');
                $loading.modal('show');

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
                $.ajax({
                    url: "{{ route('user.websites.store') }}",
                    type: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if (response.status == true) {
                            removeCookie('newUser')
                            window.location.reload();
                            $this.modal('hide');
                            swal("Success!", 'Add successful', "success");
                            $('.accordion').prepend(response.html);
                            $this.find('input[name="url"]').val('');
                            $this.find('select[name="idcategory"]').val('');
                        } else {
                            swal("Error!", response.message, "error");
                        }
                    }
                });
            }

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
