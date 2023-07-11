<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Maatwebsite\Excel\Facades\Excel;
use App\Traits\DeleteModelTrait;
use App\Traits\StorageImageTrait;

class Contact extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    use HasFactory;
    use DeleteModelTrait;
    use StorageImageTrait;

    protected $guarded = [];

    // begin

    public function user(){
        return $this->belongsTo(User::class);
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
        $dataInsert = [
            'user_id' => auth()->id(),
            'subject' => $request->subject,
            'message' => $request->message,
        ];

        $item = Helper::storeByQuery($this, $request, $dataInsert);

        NotificationCustom::create([
            'title' => 'You have a new message',
            'description' => 'You have a new message sended at '.Carbon::now()->toDateTimeString(),
            'user_id' => 1,
            'link' => route('administrator.contacts.index' ),
            'type' => 'contacts',
            'value' => $item->id
        ]);

        return $this->findById($item->id);
    }

    public function updateByQuery($request, $id)
    {
        $dataUpdate = [
            'status' => $request->status == 1 ? 1 : 2,
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

    public function findById($id){
        $item = $this->find($id);
        return $item;
    }

}
