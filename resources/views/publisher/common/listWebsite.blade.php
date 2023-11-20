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
                <span class="badge bg-danger">Empty</span>
            @elseif($item->ads_status == \App\Models\Website::CODE_NOT_UPDATE)
                <span class="badge bg-warning">Not Update</span>
            @elseif($item->ads_status == \App\Models\Website::CODE_ACCEPT)
                <span class="badge bg-success">Verify</span>
            @endif
        </td>
        <td>
            <button type="button" class="btn btn-outline-primary" onclick="addZone({{$item->api_site_id}})">add zone</button>
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
                                        @if($zone->status == \App\Services\Common::ACTIVE)
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
