<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;
use OwenIt\Auditing\Contracts\Auditable;
use Maatwebsite\Excel\Facades\Excel;
use App\Traits\DeleteModelTrait;
use App\Traits\StorageImageTrait;

class Ads extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    use HasFactory;
    use DeleteModelTrait;
    use StorageImageTrait;

    protected $guarded = [];

    // begin

    public function adApi()
    {
        $ads = Helper::callGetHTTP("https://api.adsrv.net/v2/ad/" . $this->ads_api_id);
        return $ads;
    }

    public function zoneApi()
    {
        $zone = Helper::callGetHTTP("https://api.adsrv.net/v2/zone/" . $this->zone_api_id);
        return $zone;
    }

    public function advertisers()
    {
        $results = [];
        foreach ($this->adsAdvertisers as $item) {
            $advertiser = Helper::callGetHTTP("https://api.adsrv.net/v2/user/" . $item->advertiser_api_id);
            if (!empty($advertiser)) {
                $results[] = $advertiser;
            }
        }

        return $results;
    }

    public function adsAdvertisers()
    {
        return $this->hasMany(AdsAdvertiser::class)->orderBy('order', 'DESC');
    }

    // end

    public function getTableName()
    {
        return Helper::getTableName($this);
    }

    public function toArray()
    {
        $array = parent::toArray();
        $array['image_path_avatar'] = $this->avatar();
        $array['path_images'] = $this->images;
        return $array;
    }

    public function avatar($size = "100x100")
    {
        return Helper::getDefaultIcon($this, $size);
    }

    public function image()
    {
        return Helper::image($this);
    }

    public function images()
    {
        return Helper::images($this);
    }

    public function createdBy()
    {
        return $this->hasOne(User::class, 'id', 'created_by_id');
    }

    public function searchByQuery($request, $queries = [], $randomRecord = null, $makeHiddens = null, $isCustom = false)
    {
        return Helper::searchByQuery($this, $request, $queries, $randomRecord, $makeHiddens, $isCustom);
    }

    public function storeByQuery($request)
    {
        $dataInsert = [
//            'name' => $request->name,
//            'ads_api_id' => $request->ads_api_id,
            'ads_api_id' => 0,
            'share' => $request->share,
        ];

        $item = Helper::storeByQuery($this, $request, $dataInsert);

        $campaign = Helper::callPostHTTP("https://api.adsrv.net/v2/campaign", ["idadvertiser" => $request->advertiser_api_id, "name" => $request->name]);

        $adsParam = [
            "idcampaign" => $campaign['id'],
            "details" => [
                "iddimension" => 46,
                "lib_ver" => "v7",
                "bids" => $request->bids,
            ],
        ];

        $ads = Helper::callPostHTTP("https://api.adsrv.net/v2/ad?idformat=37", $adsParam);

        if( is_array($ads) && count($ads) == 2){
            return $ads;
        }


        $zoneName = "";

        if (!empty($request->zone_name)){
            $zoneName = $request->zone_name;
        }

        $zoneParam = [
            "name" => $zoneName,
            "idzoneformat" => $request->idzoneformat,
            "iddimension" => $request->iddimension,
        ];
        $zone = Helper::callPostHTTP("https://api.adsrv.net/v2/zone?idsite=".$request->idsite, $zoneParam);

        $item->update([
            'ads_api_id' => $ads['id'],
            'zone_api_id' => $zone['id'],
        ]);

        AdsAdvertiser::create([
            'ads_id' => $item->id,
            'advertiser_api_id' => $request->advertiser_api_id,
        ]);

        return $this->findById($item->id);
    }

    public function updateByQuery($request, $id)
    {
        $dataUpdate = [
            'title' => $request->title,
            'content' => $request->contents,
            'slug' => Helper::addSlug($this, 'slug', $request->title),
        ];
        $item = Helper::updateByQuery($this, $request, $id, $dataUpdate);
        return $this->findById($item->id);
    }

    public function deleteByQuery($request, $id, $forceDelete = false)
    {
        return Helper::deleteByQuery($this, $request, $id, $forceDelete);
    }

    public function deleteManyByIds($request, $forceDelete = false)
    {
        return Helper::deleteManyByIds($this, $request, $forceDelete);
    }

    public function findById($id)
    {
        $item = $this->find($id);
        return $item;
    }

}
