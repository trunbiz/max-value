<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Models\ZoneModel;
use App\Services\Common;
use App\Services\ZoneService;
use Illuminate\Http\Request;
use App\Models\Helper;

class ZoneController extends Controller
{

    public function __construct()
    {
        $this->zoneService = new ZoneService();
    }

    public function store(Request $request)
    {
        $params = $request->all();
        $get_url = Helper::callGetHTTP('https://api.adsrv.net/v2/site/' . $request->idsite);

        if (empty($request->name)) {
            $name = $get_url['name'] . ' ' . $request->namedimision;
        } else {
            $name = $request->name;
        }

        $check_name = Helper::callGetHTTP('https://api.adsrv.net/v2/zone?idsite=' . $request->idsite . '&filter[name]=' . $name);
        if (count($check_name) > 0) {
            $name = $name . ' #' . (count($check_name) + 1);
        } else {
            $name = $name;
        }
        $keyIdDimension = $params['iddimension'] ?? null;
        $dimensionInfo = Common::DIMENSIONS[$params['iddimension']] ?? [];


        $params = [
            'name' => $name,
            'idzoneformat' => $request->idzoneformat,
            'iddimension' => 666,
            'match_algo' => $request->idDimensionMethod,
            'revenue_rate' => optional(Setting::first())->percent ?? 100,
            'idrevenuemodel' => 2,
            'height' => (string)$dimensionInfo['size'][0],
            'width' => (string)$dimensionInfo['size'][1],
        ];

        $item = Helper::callPostHTTP("https://api.adsrv.net/v2/zone?idsite=" . $request->idsite, $params);

        ZoneModel::create([
           'ad_site_id' =>$request->idsite,
           'ad_zone_id' => $item['id'],
           'name' => $name,
           'id_zone_format' => $request->idzoneformat,
           'id_dimension_method' => $request->idDimensionMethod,
           'dimensions' => json_encode([
               'paramsIdDimension' =>$keyIdDimension ?? null,
               'iddimension' => 666,
               'width' => (string)$dimensionInfo['size'][1],
               'height' => (string)$dimensionInfo['size'][0],
           ]),
           'active' => $item['is_active'] ? 1 : 0,
           'status' => $item['status']['id'],
           'extra_params' => json_encode($params),
           'extra_response' => json_encode($item),
           'created_by' => auth()->user()->id ?? '0',
           'updated_by' => auth()->user()->id ?? '0',
        ]);

        if (Helper::isErrorAPIAdserver($item)) {
            return response()->json($item, 400);
        }

        return response()->json([
            'status' => true,
//            'html' => view('administrator.advertises.add_table', compact('item'))->render()
        ]);
    }


    public function detailZone(Request $request)
    {
        $request = $request->all();
        $id = $request['id'] ?? null;
        $item = Helper::callGetHTTP("https://api.adsrv.net/v2/zone/" . $id);
        return response()->json([
            'status' => true,
            'data' => $item
        ]);
    }

    public function listBySite(Request $request)
    {
        $request = $request->all();
        $id = $request['id'] ?? null;
        $datas = $this->zoneService->listAllZone($id);

        $dataResult = [];
        foreach ($datas as $item)
        {
            $dataResult[$item['id']] = $item['name'];
        }
        return response()->json([
            'status' => true,
            'data' => $dataResult
        ]);
    }

    public function delete(Request $request)
    {
        $request = $request->all();
        $id = $request['id'] ?? null;
        $this->zoneService->deleteZoneAdServer($id);
        // xoa trong database
        ZoneModel::where('ad_zone_id', $id)->update([
            'is_delete' => 1,
            'updated_by' => auth()->user()->id ?? '0'
        ]);

        return response()->json([
            'status' => true,
            'message' => 'remove zone success',
            'data' => []
        ]);
    }
}
