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
        $request = $request->all();
        $adSiteId = $request['adSiteId'] ?? null;
        if (empty($adSiteId))
            return returnApi(false, 'site id not empty');

        $data = $this->zoneService->storeZone($adSiteId, $request);
        return returnApi(true, 'created zone', $data);
    }
}
