<?php

namespace App\Models;

use App\Mail\AlertUserChangeProfile;
use App\Mail\AlertUserWithdraw;
use App\Services\Common;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\View;
use OwenIt\Auditing\Contracts\Auditable;
use Maatwebsite\Excel\Facades\Excel;
use App\Traits\DeleteModelTrait;
use App\Traits\StorageImageTrait;

class WalletUser extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    use HasFactory;
    use DeleteModelTrait;
    use StorageImageTrait;

    protected $guarded = [];

    protected $fillable=[
        'default',
        'email'
    ];

    // begin

    protected static function boot()
    {
        parent::boot();

        static::updating(function ($model) {
            $changes = [];
            foreach ($model->getDirty() as $attribute => $value) {
                $originalValue = $model->getOriginal($attribute);
                $changes[$attribute] = [
                    'old' => $originalValue,
                    'new' => $value,
                ];
            }

            // Bắn mail khi user thay đổi khoản vay
            try {
                // Send mail when user withdraw
                $userAdminAndSale = User::where('role_id', [1])->where('active', Common::ACTIVE)->get();
                foreach ($userAdminAndSale as $admin)
                {
                    if (!filter_var($admin->email, FILTER_VALIDATE_EMAIL)) {
                        continue;
                    }

                    $formEmail = [
                        'title' => 'Alert user change profile withdraw',
                        'nameUser' => $admin->name ?? '',
                        'email' => Auth::user()->email ?? '',
                        'dataChange' => $changes
                    ];
                    Mail::to($admin->email)->send(new AlertUserChangeProfile($formEmail));
                }
            }catch (\Exception $e)
            {

            }
        });
    }

    public function withdrawType(){
        return $this->belongsTo(WithdrawType::class);
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
        $network = $withdraw_type_id = '';
        $withdraw_type_id = $request->withdraw_type_id;

        if($request->withdraw_type_id == 3){
            $withdraw_type_id = $request->type_crypto;
        }

        if($request->type_crypto == 4){
            $network = $request->usdt_network;
        }else if($request->type_crypto == 5){
            $network = $request->eth_network;
        }else if($request->type_crypto == 6){
            $network = $request->bitcoin_network;
        }

        if($request->default == 1){
            $checkDefault = WalletUser::where('user_id', auth()->id())->where('default', 1)->first();
            if(isset($checkDefault) && !empty($checkDefault)){
                WalletUser::find($checkDefault->id)->update(['default' => 0]);
            }
        }

        $dataInsert = [
            'user_id' => auth()->id(),
            'withdraw_type_id' => $withdraw_type_id,
            'method_id' => $request->method_id,
            'email' => $request->email,
            'network' => $network,
            'network_address' => $request->address_network,
            'beneficiary_name' => $request->beneficiary_name,
            'account_number' => $request->acc_number,
            'bank_name' => $request->bank_name,
            'swift' => $request->swift_code,
            'bank_address' => $request->bank_address,
            'routing_number' => $request->routing_number,
            'default' => $request->default
        ];

        $item = Helper::storeByQuery($this, $request, $dataInsert);

        return $this->findById($item->id);
    }

    public function updateByQuery($request)
    {
        $network = '';
        $withdraw_type_id = $request->withdraw_type_id;

        if($request->withdraw_type_id == 3){
            $withdraw_type_id = $request->type_crypto;
        }

        if($request->type_crypto == 4){
            $network = $request->usdt_network;
        }else if($request->type_crypto == 5){
            $network = $request->eth_network;
        }else if($request->type_crypto == 6){
            $network = $request->bitcoin_network;
        }

        if($request->default == 1){
            $checkDefault = WalletUser::where('user_id', auth()->id())->where('default', 1)->first();
            if(isset($checkDefault) && !empty($checkDefault)){
                WalletUser::find($checkDefault->id)->update(['default' => 0]);
            }
        }

        $dataUpdate = [
            'user_id' => auth()->id(),
            'withdraw_type_id' => $withdraw_type_id,
            'method_id' => $request->method_id,
            'email' => $request->email,
            'network' => $network,
            'network_address' => $request->address_network,
            'beneficiary_name' => $request->beneficiary_name,
            'account_number' => $request->acc_number,
            'bank_name' => $request->bank_name,
            'swift' => $request->swift_code,
            'bank_address' => $request->bank_address,
            'routing_number' => $request->routing_number,
            'default' => $request->default
        ];

        $item = Helper::updateByQuery($this, $request, $request->id, $dataUpdate);

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
