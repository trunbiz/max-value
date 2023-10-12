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
            <button type="button" class="btn btn-outline-primary"><i class="ri-add-line"></i></button>
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
                                                    <a href="">Get code</a>
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

    <style>
    </style>
    <script>
        $(document).ready(function() {
            // Ẩn tất cả các dòng "zone-info" ban đầu
            $('.zone-info').hide();

            // Xử lý sự kiện khi nhấp vào dòng "website-info"
            $('.website-info').click(function() {
                // Tìm dòng "zone-info" liền kề và chuyển trạng thái hiển thị
                $(this).next('.zone-info').toggle();
            });
        });
    </script>
@endsection
