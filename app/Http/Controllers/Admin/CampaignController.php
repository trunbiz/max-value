<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdsCampaignModel;
use App\Models\CampaignModel;
use App\Services\AdsService;
use App\Services\CampaignService;
use App\Services\ZoneService;
use Illuminate\Http\Request;

class CampaignController extends Controller
{

    public function __construct()
    {
        $this->campaignService = new CampaignService();
        $this->adsService = new AdsService();
        $this->zoneService = new ZoneService();
    }


    public function storeAjaxCampaign(Request $request)
    {
        $request = $request->all();
        $result = $this->campaignService->storeCampaignByAjax($request, $message);
        if (empty($result)) {
            return response()->json([
                'status' => false,
                'message' => $message ?? 'Tạo tiến trình thất bại',
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

        $zoneInfo = $this->zoneService->getInfoZoneAdServer($request['zone']['id']);
        $params['ads']['iddimension'] = $zoneInfo['dimension']['id'] ?? 666;
        $params['ads']['width'] = (string)$zoneInfo['width'] ?? 'auto';
        $params['ads']['height'] = (string)$zoneInfo['height'] ?? 'auto';

        // Update campaign
        $campaignInfo = $this->campaignService->updateCampaignAdServer($params['campaign']['ad_campaign_id'], $params['campaign']);
        CampaignModel::find($params['campaign']['id'])->update([
            'ad_campaign_id' => $campaignInfo['id'],
            'name' => $params['campaign']['name'],
            'id_advertiser' => $campaignInfo['advertiser']['id'],
            'id_status' => $campaignInfo['status']['id'],
            'id_run_status' => $campaignInfo['runstatus']['id'],
            'extra_request' => json_encode($params['campaign']),
            'extra_response' => json_encode($campaignInfo),
            'updated_by' => auth()->user()->id ?? '0',
        ]);

        // Update Ads
        $adsAdInfo = $this->adsService->updateAdsAdService($params['ads']['ad_ad_id'], $params['campaign']['ad_campaign_id'], $params['ads']);
        AdsCampaignModel::where('ad_ad_id', $params['ads']['ad_ad_id'])->update([
            'is_active' => $adsAdInfo['is_active'],
            'extra_request' => json_encode($params['ads']),
            'extra_response' => json_encode($adsAdInfo)
        ]);

        return back();
    }

    public function deleteAjaxCampaign(Request $request)
    {
        $request = $request->all();
        $campaignInfo = $this->campaignService->getInfoCampaignAdServer($request['campaignId']);

        $this->campaignService->removeCampaignAdServer($request['campaignId']);
        CampaignModel::where('ad_campaign_id', $request['campaignId'])->update([
            'is_delete' => 1
        ]);

        foreach ($campaignInfo['ads'] ?? [] as $item) {
            $this->adsService->deleteAdsAdService($item['id']);
            AdsCampaignModel::where('ad_ad_id', $item['id'])->delete();
        }
        return response()->json([
            'status' => true,
            'message' => 'remove campaign success',
        ]);
    }
}
