<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\CampaignService;
use Illuminate\Http\Request;

class CampaignController extends Controller
{

    public function __construct()
    {
        $this->campaignService = new CampaignService();
    }


    public function storeAjaxCampaign(Request $request)
    {
        $request = $request->all();
        $this->campaignService->storeCampaignByAjax($request);
        return response()->json([
            'status' => true,
            'message' => 'Tạo campaign thành công',
        ]);
    }
}
