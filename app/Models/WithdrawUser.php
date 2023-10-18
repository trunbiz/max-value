<?php

namespace App\Models;

use App\Mail\AlertUserWithdraw;
use App\Mail\MailNotiUserNew;
use App\Services\Common;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\View;
use OwenIt\Auditing\Contracts\Auditable;
use Maatwebsite\Excel\Facades\Excel;
use App\Traits\DeleteModelTrait;
use App\Traits\StorageImageTrait;

class WithdrawUser extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    use HasFactory;
    use DeleteModelTrait;
    use StorageImageTrait;

    protected $guarded = [];

    const STATUS_PENDING = 1;
    const STATUS_APPROVED = 2;
    const STATUS_REJECT = 3;

    const TYPE = [
        self::TYPE_PAYPAL => 'Paypal',
        self::TYPE_PAYONEER => 'Payoneer',
        self::TYPE_CRYPTO => 'Crypto',
        self::TYPE_WIRE_TRANSFER => 'Wire Transfer',
    ];

    const TYPE_ICON = [
        self::TYPE_PAYPAL => 'ri-paypal-fill',
        self::TYPE_PAYONEER => 'ri-money-dollar-circle-fill',
        self::TYPE_CRYPTO => 'ri-bit-coin-fill',
        self::TYPE_USDT => 'ri-money-dollar-circle-fill',
        self::TYPE_ETHEREUM => 'ri-money-dollar-circle-fill',
        self::TYPE_BITCOIN => 'ri-bit-coin-fill',
        self::TYPE_WIRE_TRANSFER => 'ri-bank-fill',
    ];


    const TYPE_PAYPAL = 1;
    const TYPE_PAYONEER = 2;
    const TYPE_CRYPTO = 3;
    const TYPE_USDT = 4;
    const TYPE_ETHEREUM = 5;
    const TYPE_BITCOIN = 6;
    const TYPE_WIRE_TRANSFER = 7;

    // begin

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function walletUser(){
        return $this->hasOne(WalletUser::class,"id","wallet_id");
    }

    public function statusWithdraw(){
        return $this->hasOne(WithdrawStatus::class,"id","withdraw_status_id");
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
        $walletUser = WalletUser::find($request->wallet_id);

        $min = $walletUser->withdrawType->min;

        $request->validate([
            'amount'=>'required|numeric|min:' . $min . '|lte:'. (float) auth()->user()->money,
        ],[
            'amount.lte' => 'The amount is not enough',
        ]);

        $dataInsert = [
            'amount' => $request->amount - $walletUser->withdrawType->fee,
            'wallet_id' => $request->wallet_id,
            'user_id' => auth()->id(),
            'estimate_payment' => Carbon::now()->day(15)->addMonth()->format('Y-m-d')
        ];

        try {
            // Send mail when user withdraw
            $userAdminAndSale = User::where('role_id', [1])->where('active', Common::ACTIVE)->get();
            foreach ($userAdminAndSale as $admin)
            {
                if (!filter_var($admin->email, FILTER_VALIDATE_EMAIL)) {
                    continue;
                }

                $formEmail = [
                    'title' => 'Alert user withdraw',
                    'nameUser' => $admin->name ?? '',
                    'amount' => $dataInsert['amount'],
                    'emailWithdraw' => auth()->user()->email ?? '',
                    'estimatePaymentTime' => $dataInsert['updated_at']->format('Y-m-d')
                ];
                Mail::to($admin->email)->send(new AlertUserWithdraw($formEmail));
            }
        }catch (\Exception $e)
        {

        }

        DB::beginTransaction();

        try {
            $item = Helper::storeByQuery($this, $request, $dataInsert);

            auth()->user()->addTransection(-$request->amount, "Cash out");

            DB::commit();
            return $this->findById($item->id);
        } catch (\Exception $e) {
            DB::rollback();

            return back();
        }
    }

    public function updateByQuery($request)
    {
        $dataUpdate = [
            'withdraw_status_id' => $request->withdraw_status_id,
//            'content' => $request->contents,
//            'slug' => Helper::addSlug($this,'slug', $request->title),
        ];
        $item = Helper::updateByQuery($this, $request, $request->id, $dataUpdate);


        if(Carbon::make($item->created_at)->format('d') > 15){
            $updated_at = Carbon::make($item->created_at)->day(15)->addMonth();
        }else{
            $updated_at = Carbon::make($item->created_at)->day(15);
        }

        $dataUpdate['updated_at'] = $updated_at;

        $item = Helper::updateByQuery($this, $request, $request->id, $dataUpdate);

        $item = $this->findById($item->id);

        if($request->withdraw_status_id == 2){
            NotificationCustom::create([
                'user_id' => $item->user_id,
                'title' => "System",
                'description' => "Your request payment has Approved",
                'link' => route('user.wallet_users.index'),
                'type' => 'withdraw',
            ]);
        }elseif ($request->withdraw_status_id == 3){
            // Nếu từ chối rút tiền thì hoàn tiền cho user
//            $userWithDraw = User::find($item->user_id);
//            $userWithDraw->money = $userWithDraw->money + $item->amount;
//            $userWithDraw->save();

            NotificationCustom::create([
                'user_id' => $item->user_id,
                'title' => "System",
                'description' => "Your request payment has Reject",
                'link' => route('user.wallet_users.index'),
                'type' => 'withdraw',
            ]);
        }else{
            NotificationCustom::create([
                'user_id' => $item->user_id,
                'title' => "System",
                'description' => "Your request payment has Pending",
                'link' => route('user.wallet_users.index'),
                'type' => 'withdraw',
            ]);
        }

        return $item;
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
