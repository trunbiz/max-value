@extends('publisher.base')
@section('title', 'Dashboard')
@section('content')
    <div class="d-flex align-items-center justify-content-between mb-4">
        <div>
            <ol class="breadcrumb fs-sm mb-1">
                <li class="breadcrumb-item"><a href="#">Websites & zones</a></li>
            </ol>
            <h4 class="main-title mb-0">List websites & zones</h4>
        </div>
        <nav class="nav nav-icon nav-icon-lg">
            <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#create-site">
                <i class="ri-add-line"></i></button>
            {{--            <a href="" class="nav-link" data-bs-toggle="tooltip" title="Share"></a>--}}
        </nav>
    </div>

    <div class="row g-3 justify-content-center">
        <table class="table table-hover">
            <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Website</th>
                <th scope="col">Category</th>
                <th scope="col">Status</th>
            </tr>
            </thead>
            <tbody>
            @foreach($items as $item)
                <tr class="website-info">
                    <th scope="row">{{$item->id}}</th>
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
                                <div class="col-sm-3">
                                    <div class="card">
                                        <div class="card-header tx-medium">
                                            <div class="row">
                                                <div class="col-md-10">
                                                    {{$zone->name}}
                                                </div>
                                                <div class="col-md-2 float-right">
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
                                                    <button type="button" class="btn btn-outline-primary"
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

    <div class="main-footer mt-5">
        <span>&copy; 2023. Maxvalue. All Rights Reserved.</span>
        <span>Created by: <a href="https://maxvalue.media" target="_blank">MaxValue Center</a></span>
    </div><!-- main-footer -->


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
                        <div class="mb-3">
                            <label for="category" class="mb-3">Category<span class="text-danger">*</span></label>
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
                        <div class="mb-3">
                            <label for="url" class="mb-3">URL <span class="text-danger">*</span></label>
                            <input type="text" name="url" class="form-control @error("url") is-invalid @enderror"
                                   required>
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
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#loading">
        Launch demo modal
    </button>
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

                callAjax(
                    "POST",
                    "{{ route('user.websites.store') }}",
                    {
                        'idcategory': $this.find('select[name="idcategory"]').val(),
                        'url': url,
                    },
                    (response) => {
                        if (response.status == true) {
                            window.location.reload()
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
@endsection
