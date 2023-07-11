<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use OwenIt\Auditing\Contracts\Auditable;
use Maatwebsite\Excel\Facades\Excel;
use App\Traits\DeleteModelTrait;
use App\Traits\StorageImageTrait;

class Website extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    use HasFactory;
    use DeleteModelTrait;
    use StorageImageTrait;

    protected $guarded = [];

    // begin

    public function getStatFromAPI($dateBegin = null, $dateEnd = null, $idzone = null){

        $query = [
            'dateBegin' => $dateBegin ?? date("Y-m-d", Carbon::now()->startOfMonth()->timestamp),
            'dateEnd' => $dateEnd ?? date("Y-m-d", Carbon::now()->endOfMonth()->timestamp),
            'idsite' => !empty($this->api_site_id) ? $this->api_site_id : 1,
        ];

        if (!empty($idzone)){
            $query['idzone'] = $idzone;
        }

        $params = [
            'query' => $query
        ];

        $response = Helper::callGetHTTP('https://api.adsrv.net/v2/stats',  $params);

        $impressions = 0;
        $clicks = 0;
        $amount_pub = 0;

        if (!empty($response)){
            foreach ($response as $item){
                $clicks += $item['clicks'];
                $impressions += $item['impressions'];
                $amount_pub += $item['amount_pub'];
            }
        }

        return [
            'clicks' => $clicks,
            'impressions' => $impressions,
            'amount_pub' => Helper::amountPub($amount_pub),
        ];
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function getUserWeb(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function adv(){
        return $this->hasMany(Advertise::class);
    }

    public function getCategory(){
        return $this->belongsTo(TypeCategory::class, 'category_website_id');
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

    public function createdBy(){
        return $this->hasOne(User::class,'id','created_by_id');
    }

    public function searchByQuery($request, $queries = [], $randomRecord = null, $makeHiddens = null, $isCustom = false)
    {
        return Helper::searchByQuery($this, $request, $queries, $randomRecord, $makeHiddens, $isCustom);
    }

    public function storeByQuery($request)
    {
        $request->validate([
            'url' => 'required|url',
        ]);

        $params = [
            'name' => $request->name,
            'contents' => $request->description,
            'url' => $request->url,
            'idcategory' => $request->idcategory,
            'idpublisher' => $request->idpublisher ?? auth()->user()->api_publisher_id,
            'idstatus' => 3520,
            'is_active' => $request->active,
        ];
        $response = Helper::callPostHTTP("https://api.adsrv.net/v2/site", $params);

        return $response;
    }

    public function updateByQuery($request, $id)
    {
        if(Auth::user()->role_id == 1){
            $dataUpdate = [
                'status' => $request->status,
            ];
        }else{
            $dataUpdate = [
                'name' => $request->name,
                'url' => $request->url,
                'category_website_id' => $request->category_website_id,
                'description' => $request->description,
                'user_id' => auth()->id(),
            ];
        }

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

    public function findById($id){
        $item = $this->find($id);
        return $item;
    }

}
