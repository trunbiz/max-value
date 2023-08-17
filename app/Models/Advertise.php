<?php

namespace App\Models;

use App\Components\Recusive;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use OwenIt\Auditing\Contracts\Auditable;
use Maatwebsite\Excel\Facades\Excel;
use App\Traits\DeleteModelTrait;
use App\Traits\StorageImageTrait;

class Advertise extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    use HasFactory;
    use DeleteModelTrait;
    use StorageImageTrait;

    protected $guarded = [];

    // begin

    public function getInforAdvertiseFromAPI(){

        $response = Helper::callGetHTTP('https://api.adsrv.net/v2/zone/' . $this->api_zone_id);
        return $response;
    }

    public function getStatAdvertiseFromAPI($dateBegin = null, $dateEnd = null){

        $params = [
            'query' => [
                'dateBegin' => $dateBegin ?? date("Y-m-d", Carbon::now()->startOfMonth()->timestamp),
                'dateEnd' => $dateEnd ?? date("Y-m-d", Carbon::now()->endOfMonth()->timestamp),
                'idzone' => $this->api_zone_id,
            ]
        ];

        $response = Helper::callGetHTTP('https://api.adsrv.net/v2/stats',  $params);

        if (!empty($response) && is_array($response) && count($response) > 0){
            return $response[0];
        }

        return null;
    }


    public function getDomain(){
        return $this->belongsTo(Website::class, 'website_id');
    }

    public function getTypeAdv(){
        return $this->belongsTo(TypeAdv::class, 'type_adv_id');
    }

    public function getWeb($parent_id = null){
        $data = Website::where('status', 2)->where('user_id', Auth::id())->get();
        $recusive = new Recusive($data);
        $htmlOption = $recusive->categoryRecusive($parent_id);

        return $htmlOption;
    }

    public function getTypeAd($parent_id = null){
        $data = TypeAdv::all();
        $recusive = new Recusive($data);
        $htmlOption = $recusive->categoryRecusive($parent_id);

        return $htmlOption;
    }
    public function getCategoryRecusive($parent_id = null){
        $data = TypeAdv::all();
        $recusive = new Recusive($data);
        return $recusive->getCategoryRecusive($parent_id);
    }

    public function getDimension($parent_id = null){
        $data = Dimension::all();
        $recusive = new Recusive($data);
        $htmlOption = $recusive->categoryRecusive($parent_id);

        return $htmlOption;
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

        $params = [
            'name' => $request->name,
            'idzoneformat' => 6,
            'iddimension' => $request->iddimension,
        ];
        dd($request);
        $item = Helper::callPostHTTP("https://api.adsrv.net/v2/zone?idsite=". $request->idsite, $params);

        return $item;

    }

    public function updateByQuery($request, $id)
    {
        if(auth()->user()->role_id != 0){
            $dataUpdate = [
                'adverser_status_id' => $request->adverser_status_id ?? 1,
                'api_zone_id' => $request->api_zone_id,
            ];

        }else{
            $dataUpdate = [
                'name' => $request->name,
                'website_id' => $request->website_id,
                'type_adv_id' => $request->type_adv_id,
                'user_id' => Auth::id(),
            ];
        }
        $item = Helper::updateByQuery($this, $request, $id, $dataUpdate);

        if (isset($request->api_site_id) && !empty($request->api_site_id)){

            $website = Website::find($item->website_id);

            if (!empty($website)){
                $website->update([
                    'api_site_id' => $request->api_site_id
                ]);
            }
        }

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
