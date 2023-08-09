<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdsCampaignModel;
use App\Models\CampaignModel;
use App\Services\AdsService;
use App\Services\CampaignService;
use Illuminate\Http\Request;

class CampaignController extends Controller
{

    public function __construct()
    {
        $this->campaignService = new CampaignService();
        $this->adsService = new AdsService();
    }


    public function storeAjaxCampaign(Request $request)
    {
        $request = $request->all();
        $result = $this->campaignService->storeCampaignByAjax($request);
        if (empty($result))
        {
            return response()->json([
                'status' => false,
                'message' => 'Tạo tiến trình thất bại',
            ], 500);
        }
        return response()->json([
            'status' => true,
            'message' => 'Tạo campaign thành công',
        ]);
    }

    public function update(Request $request)
    {
        $request = $request->all();
        $params = [
            'campaign' => $request['campaignUpdate'] ?? [],
            'ads' => $request['adsUpdate'] ?? [],
        ];

        // Update campaign
        $campaignInfo = $this->campaignService->updateCampaignAdServer($params['campaign']['ad_campaign_id'], $params['campaign']);
        $campaignDBInfo = CampaignModel::find($params['campaign']['id'])->update([
            'ad_campaign_id' => $campaignInfo['id'],
            'name' => $params['campaign']['name'],
            'id_advertiser' => $campaignInfo['advertiser']['id'],
            'id_run_status' => $campaignInfo['status']['id'],
            'extra_request' => json_encode($params['campaign']),
            'extra_response' => json_encode($campaignInfo),
        ]);

        // Update Ads
        $adsAdInfo = $this->adsService->updateAdsAdService($params['ads']['ad_ad_id'], $params['campaign']['ad_campaign_id'], $params['ads']);
        AdsCampaignModel::update([
            'ad_ad_id' => $adsAdInfo['id'],
            'campaign_id' => $campaignDBInfo->id,
            'is_active' => $adsAdInfo['is_active'],
            'extra_request' => json_encode($params['ads']),
            'extra_response' => json_encode($adsAdInfo)
        ])->where('ad_ad_id', $params['ads']['ad_ad_id'])->first();
        return true;
    }
}
