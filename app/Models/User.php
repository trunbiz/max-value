<?php

namespace App\Models;

use App\Components\Recusive;
use App\Services\Common;
use App\Services\UserService;
use App\Traits\DeleteModelTrait;
use App\Traits\StorageImageTrait;
use App\Traits\UserTrait;
use Carbon\Carbon;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Laravel\Sanctum\HasApiTokens;
use MongoDB\Driver\Session;

class User extends Authenticatable implements MustVerifyEmail
{
    use UserTrait;
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;
    use \Awobaz\Compoships\Compoships;
    use DeleteModelTrait;
    use StorageImageTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    const IS_ADMIN = 1;
    const IS_PUBLISHER = 0;

    const ACTIVE = 1;

    protected $guarded = [
//        'is_admin',
    ];

//    protected $guarded = [];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    const ROLE_PUBLISHER_MANAGER = 5;

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($user) {
            $user->code = Helper::generateRandomString();
        });

        static::saving(function ($user) {
            if (!empty($user->referral_code)) {
                $existingUser = static::where('code', $user->referral_code)->first();
                if (!$existingUser) {
                    $user->referral_code = null;
                }
            }
        });
    }

    // begin

    public function addTransection($amount, $description){

        $amount = (float) $amount;
        DB::beginTransaction();

        try {
            TransectionUser::create([
                'user_id' => $this->id,
                'amount' => $amount,
                'description' => $description,
            ]);

            $amount =( (float) $this->money ) + $amount;

            $this->update([
                'money' => $amount
            ]);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
        }
    }

    public function wallets(){
        return $this->hasMany(WalletUser::class,'user_id','id');
    }

    public static function getCategory($parent_id = null){
        $data = User::where('is_admin', '!=', 0)->get();
        $recusive = new Recusive($data);
        $htmlOption = $recusive->categoryRecusive($parent_id);

        return $htmlOption;
    }

    public function manager(){
        return $this->hasOne(User::class, 'id','manager_id');
    }

    public function getReportStatsFromAPI($query){

        $params = [
            'query' => $query
        ];

        $response = Helper::callGetHTTP('https://api.adsrv.net/v2/stats',  $params);

        if (!empty($response)){
            return  array_reverse($response);
        }

        return [];
    }


    public function getTodayEarningFromAPI(){

        $params = [
            'query' => [
                'dateBegin' => date("Y-m-d", Carbon::now()->timestamp),
                "dateEnd" => date("Y-m-d", Carbon::now()->timestamp),
                "idpublisher" => $this->api_publisher_id]
        ];

        $response = Helper::callGetHTTP('https://api.adsrv.net/v2/stats', $params);

        $total = 0;

        if (!empty($response) && is_array($response)){
            foreach ($response as $item){
                $total += $item['amount_pub'];
            }
        }


        return $total;
    }

    public function getTotalEarningFromAPI(){

        $params = [
            'query' => [
                'dateBegin' => date("Y-m-d", Carbon::now()->startOfMonth()->timestamp),
                "dateEnd" => date("Y-m-d", Carbon::now()->endOfMonth()->timestamp),
                "idpublisher" => $this->api_publisher_id]
        ];

        $response = Helper::callGetHTTP('https://api.adsrv.net/v2/stats', $params);

        $total = 0;

        if (!empty($response) && is_array($response)){
            foreach ($response as $item){
                $total += $item['amount_pub'];
            }
        }

        return $total;
    }

    public function userType(){
        return $this->hasOne(UserType::class,'id','user_type_id');
    }

    public function userWeb(){
        return $this->hasMany(Website::class);
    }

    public function zones(){
        return $this->hasMany(Advertise::class);
    }

    public function zonesAvtive(){
        return $this->hasMany(Advertise::class)->where('adverser_status_id', 2);
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

    public function avatar($size = "100x100"){
        $image = $this->image;
        if (!empty($image)){
            return Formatter::getThumbnailImage($image->image_path,$size);
        }

        return config('_my_config.default_avatar');
    }

    public function image(){
        return $this->hasOne(SingleImage::class,'relate_id','id')->where('table' , $this->getTable());
    }

    public function images(){
        return $this->hasMany(Image::class,'relate_id','id')->where('table' , $this->getTable())->orderBy('index');
    }

    public function gender()
    {
        return $this->belongsTo(GenderUser::class);
    }

    public function role()
    {
        return $this->hasOne(Role::class, 'id', 'role_id');
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_user', 'user_id', 'role_id');
    }

    public function checkPermissionAccess($permissionCheck)
    {
        if (optional(auth()->user())->is_admin == 2) return true;

        $roles = optional(auth()->user())->roles;

        foreach ($roles as $role) {
            $permissions = $role->permissions;
            if ($permissions->contains('key_code', $permissionCheck)) {
                return true;
            }
        }

        $role = optional(auth()->user())->role;
        if (!empty($role))
        {
            $permissions = $role->permissions;
            if ($permissions->contains('key_code', $permissionCheck)) {
                return true;
            }
        }

        return false;
    }

    public function isAdmin(){
        return auth()->check() && optional(auth()->user())->is_admin == 2;
    }

    public function isEmployee(){
        return auth()->check() && optional(auth()->user())->is_admin != 0;
    }

    public function searchByQuery($request, $queries = [])
    {
        return Helper::searchByQuery($this, $request, $queries);
    }

    public function storeByQuery($request)
    {
        $updateAdsTxt = false;
        $params = [
            'name' => $request->name == '' ? $request->email : $request->name,
            'email' => $request->email,
            'idrole' => $request->idcloudrole == 3 ? 3 : 4,
            'is_active' => $request->user_status_id == 2 ? 0 : 1,
        ];

        $manager = \auth()->user();
        if (!empty($request->manager_id)){
            $manager = User::findOrFail($request->manager_id);
        }else{
            if (auth()->user()->is_admin != 2){
                $manager = \auth()->user();
            }
        }

        $itemApi = Helper::callPostHTTP("https://api.adsrv.net/v2/user", $params);

        if (Helper::isErrorAPIAdserver($itemApi)){
            return $itemApi;
        }

        $dataInsert = [
            'name' => $request->name == '' ? $request->email : $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'user_type_id' => $request->user_type_id ?? 1,
            'date_of_birth' => $request->date_of_birth,
            'gender_id' => $request->gender_id ?? 1,
            'email_verified_at' => now(),
            'password' => Hash::make($request->password),
            'manager_id' =>  optional($manager)->id ? optional($manager)->id : 0,
            'api_publisher_id' => $itemApi['id'],
            'user_status_id' => $request->user_status_id ?? 2,
        ];


        if(!empty($request->partner_code)){
            $dataInsert['partner_code'] = $request->partner_code;
            $updateAdsTxt = true;
        }

        if(!empty($request->idcloudrole)){
            $dataInsert['role_id'] = $request->idcloudrole ?? 0;
        }

        if ($this->isAdmin()){
            $dataInsert['is_admin'] = $request->is_admin ?? 0;
            $dataInsert['user_status_id'] = 1;
            $dataInsert['url'] = $request->url;
        }

        $item = Helper::storeByQuery($this, $request, $dataInsert);

        // update file ads.txt
        if ($updateAdsTxt)
        {
            try {
                $userService = new UserService();
                $userService->updateAdsTxt();
            }catch (\Exception $e)
            {
                Log::error('error update ads.txt', $e->getMessage());
            }
        }


        if (!empty($request->is_admin && $request->is_admin == 1 && isset($request->role_ids))){
            $item->roles()->attach($request->role_ids);
        }

        return $this->findById($item->id);
    }

    public function updateByQuery($request, $id, $isPartner = false)
    {
        $updateAdsTxt = false;

        $item = User::where('api_publisher_id', $id)->first();

        $params = [];

        if (isset($request->email)){
            $params['email'] = $request->email;
        }

        if (isset($request->name)){
            $params['name'] = $request->name;
        }

        if (isset($request->idrole)){
            $params['idrole'] = $request->idcloudrole == 3 ? 3 : 4;
        }

        if (isset($request->user_status_id)){
            $params['is_active'] = $request->user_status_id == 2 ? 0 : 1;
        }

        $manager = User::find($request->manager_id);

        if (!$isPartner)
        {
            if (empty($manager)){
                $params['idmanager'] = "";
            }else{
                $params['idmanager'] = $manager->api_publisher_id != 0 ? $manager->api_publisher_id : "";
            }
        }

        Helper::callPutHTTP("https://api.adsrv.net/v2/user/" . $id, $params);

        $dataUpdate = [
            'user_type_id' => $request->user_type_id ?? 1,
        ];

        if (isset($request->email)){
            $dataUpdate['email'] = $request->email;
        }

        if (!empty($request->name)){
            $dataUpdate['name'] = $request->name;
        }

        if (!empty($request->date_of_birth)){
            $dataUpdate['date_of_birth'] = $request->date_of_birth;
        }

        if (!empty($request->gender_id)){
            $dataUpdate['gender_id'] = $request->gender_id;
        }

        if (!empty($request->password)) {
            $dataUpdate['password'] = Hash::make($request->password);
        }

        if (!empty($request->user_status_id)) {
            $dataUpdate['active'] = $request->user_status_id == 2 ? 0 : 1;
        }

        $dataUpdate['manager_id'] = $request->manager_id;

        if (!empty($request->user_status_id)) {
            $dataUpdate['user_status_id'] = $request->user_status_id;
        }

        if (!empty($request->url)) {
            $dataUpdate['url'] = $request->url;
        }


        if ($isPartner)
        {
            // Nếu có sự thay đổi thì cập nhật lại ads.txt
            if (strcmp($request->partner_code, $item->partner_code))
                $updateAdsTxt = true;

            $dataUpdate['partner_code'] = $request->partner_code;
        }
        $item = Helper::updateByQuery($this, $request, $item->id, $dataUpdate);

        if ($item->is_admin != 0 && isset($request->role_ids)){
            $item->roles()->sync($request->role_ids);
        }

        // update file ads.txt
        if ($updateAdsTxt)
        {
            try {
                $userService = new UserService();
                $userService->updateAdsTxt();
            }catch (\Exception $e)
            {
                Log::error('error update ads.txt', $e->getMessage());
            }
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

    public function findById($id)
    {
        $item = $this->find($id);
        $item->gender;
        $item->role;
        return $item;
    }

    public function getArrayUserAssign()
    {
        return $this->hasOne(AssignUserModel::class, 'user_id', 'id')
            ->where('type', AssignUserModel::TYPE['PUBLISHER'])
            ->where('is_delete', Common::NOT_DELETE)->pluck('service_id')->toArray();
    }

    public function getListUserAssign()
    {
        return $this->hasOne(AssignUserModel::class, 'user_id', 'id')
            ->where('type', AssignUserModel::TYPE['PUBLISHER'])
            ->where('is_delete', Common::NOT_DELETE)->pluck('service_id')->toArray();
    }
    public function getFirstUserAssign()
    {
        return $this->hasOne(AssignUserModel::class, 'service_id', 'id')
            ->where('type', AssignUserModel::TYPE['PUBLISHER'])
            ->where('user_id', '<>', 0)
            ->where('is_delete', Common::NOT_DELETE)
            ->orderBy('id', 'DESC')->first();
    }

    public function getFirstAdminAssign()
    {
        return $this->hasOne(AssignUserModel::class, 'user_id', 'id')
            ->where('type', AssignUserModel::TYPE['PUBLISHER'])
            ->where('user_id', '<>', 0)
            ->where('is_delete', Common::NOT_DELETE)->orderBy('id', 'DESC')->first();
    }

    public function getListSite($listStatus = [])
    {
        $query = $this->hasMany(Website::class, 'user_id', 'id')
            ->where('is_delete', 0);
        if (!empty($listStatus))
        {
            $query->whereIn('status', $listStatus);
        }
        return $query->get();
    }
}
