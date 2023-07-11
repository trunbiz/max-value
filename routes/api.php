<?php

use App\Events\ChatPusherEvent;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\CalendarController;
use App\Http\Controllers\API\CartController;
use App\Http\Controllers\API\CategoryNewsController;
use App\Http\Controllers\API\CategoryProductsController;
use App\Http\Controllers\API\NewsController;
use App\Http\Controllers\API\NotificationController;
use App\Http\Controllers\API\OrderController;
use App\Http\Controllers\API\ProductController;
use App\Http\Controllers\API\SliderController;
use App\Http\Controllers\API\SystemBranchController;
use App\Http\Controllers\API\VoucherController;
use App\Http\Requests\Chat\ParticipantAddRequest;
use App\Http\Requests\PusherChatRequest;
use App\Models\Chat;
use App\Models\ChatGroup;
use App\Models\ChatImage;
use App\Models\Helper;
use App\Models\Notification;
use App\Models\ParticipantChat;
use App\Models\RestfulAPI;
use App\Models\User;
use App\Traits\StorageImageTrait;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('cron')->group(function () {

    Route::get('/', [
        'uses'=>'App\Http\Controllers\Cronner\CronnerController@callback',
    ]);

});

Route::post('/quick-register', function (Request $request){

    $request->validate([
        'email' => 'required|email:rfc,dns|unique:users',
        'website' => 'required|url',
        'password' => 'required',
    ]);

    $urls = Helper::callGetHTTP("https://api.adsrv.net/v2/site?filter[url]=".$request->website."&page=1&per-page=10000");
    if(!empty($urls)){
        return response()->json([
            'status' => false,
            'code' => 400,
            'message' => 'Website is had already',
        ], 400);
    }

    $params = [
        'name' => $request->email,
        'email' => $request->email,
        'idrole' => 4,
    ];

    $response = Helper::callPostHTTP("https://api.adsrv.net/v2/user", $params);

    if (Helper::isErrorAPIAdserver($response)){
        return response()->json([
            'status' => false,
            'code' => 400,
            'message' => 'Email already used',
        ], 400);
    }

    $dataCreate = [
        'name' => $request->email,
        'role_id' => '0',
        'api_publisher_id' => $response['id'],
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'ip_register' => request()->ip(),
    ];

    $user = User::create($dataCreate);

    $params = [
        'url' => $request->website,
        'idcategory' => 13,
        'idpublisher' => $user->api_publisher_id,
        'idstatus' => 3520,
    ];

    Helper::callPostHTTP("https://api.adsrv.net/v2/site", $params);

    event(new Registered($user));

    return response()->json($user);

});
