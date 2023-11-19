<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Helper;
use App\Services\ZoneService;
use Illuminate\Http\Request;

class ZoneController extends Controller
{

    public $zoneService;
    public function __construct()
    {
        $this->zoneService = new ZoneService();
    }

    public function store(Request $request)
    {
        $dataResult = [];
        $request = $request->all();
        $adSiteId = $request['adSiteId'] ?? null;
        $listZoneDimensions = $request['list_zone_dimensions'] ?? null;

        if (empty($adSiteId))
            return returnApi(false, 'site id not empty');

        if (empty($listZoneDimensions))
            return returnApi(false, 'list_zone_dimensions not empty');

        $data = [];
        // Create list zones
        foreach ($listZoneDimensions as $item)
        {
            $params = [
                'idDimension' => $item
            ];

            $zoneInfo = $this->zoneService->storeZone($adSiteId, $params);
            if ($zoneInfo['success'])
            {
                $data[] = [
                    'id' => $zoneInfo['data']->id,
                    'name' => $zoneInfo['data']->name,
                    'code' => $zoneInfo['zoneCode']
                ];
            }
        }

        $dataResult['html'] = view('publisher.common.zoneCode', ['zoneCode'=>$data])->render();
        return returnApi(true, 'created zone', $dataResult);
    }
}
