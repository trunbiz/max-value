@foreach($zoneCode as $item)
    <label class="control-label fw-semibold mt-10-f">{{$item['name'] ?? ''}}</label>
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="Normal-tab{{$item['id']}}" data-bs-toggle="tab"
                    data-bs-target="#Normal{{$item['id']}}" type="button" role="tab" aria-controls="Normal"
                    aria-selected="true">{{$item['code'][0]['title']}}</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="IFrame-tab{{$item['id']}}" data-bs-toggle="tab"
                    data-bs-target="#IFrame{{$item['id']}}" type="button" role="tab" aria-controls="IFrame"
                    aria-selected="true">{{$item['code'][1]['title']}}</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="AMP-tab{{$item['id']}}" data-bs-toggle="tab"
                    data-bs-target="#AMP{{$item['id']}}" type="button" role="tab" aria-controls="AMP"
                    aria-selected="true">{{$item['code'][2]['title']}}</button>
        </li>

    </ul>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="Normal-tab{{$item['id']}}" role="tabpanel" aria-labelledby="Normal-tab{{$item['id']}}">
            <div class="row mt-3">
                <div class="col-12">
                    <textarea class="form-control" disabled rows="8" placeholder="Code ...">{{$item['code'][0]['code']}}</textarea>
                </div>
            </div>
        </div>
        <div class="tab-pane fade show" id="IFrame{{$item['id']}}" role="tabpanel" aria-labelledby="IFrame-tab{{$item['id']}}">
            <div class="row mt-3">
                <div class="col-12">
                    <textarea class="form-control" disabled rows="8" placeholder="Code ...">{{$item['code'][1]['code']}}</textarea>
                </div>
            </div>
        </div>
        <div class="tab-pane fade show" id="AMP{{$item['id']}}" role="tabpanel" aria-labelledby="AMP-tab{{$item['id']}}">
            <div class="row mt-3">
                <div class="col-12">
                    <textarea class="form-control" disabled rows="8" placeholder="Code ...">{{$item['code'][2]['code']}}</textarea>
                </div>
            </div>
        </div>
    </div>
@endforeach
