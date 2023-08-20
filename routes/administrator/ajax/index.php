<?php

use App\Events\ChatPusherEvent;
use App\Http\Requests\PusherChatRequest;
use App\Models\Chat;
use App\Models\ChatImage;
use App\Models\Helper;
use App\Models\Image;
use App\Models\Notification;
use App\Models\ParticipantChat;
use App\Models\RestfulAPI;
use App\Models\Setting;
use App\Models\SingleImage;
use App\Models\User;
use App\Traits\StorageImageTrait;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Mail;

// ajax
Route::prefix('ajax/administrator')->group(function () {
    Route::group(['middleware' => ['auth']], function () {

        Route::prefix('website-by-idpublisher')->group(function () {
            Route::get('/', function (Request $request) {

                $params = [
                    'query' => [
                        'filter[idpublisher]' => $request->idpublisher,
                        'page' => 1,
                        'per-page' => 10000,
                    ]
                ];

                $item = Helper::callGetHTTP("https://api.adsrv.net/v2/site", $params) ?? [];

                return response()->json($item);

            })->name('ajax.administrator.website_by_idpublisher');
        });

        Route::prefix('website')->group(function () {
            Route::post('/store', function (Request $request) {

                $requestParams = $request->all();
                $params = [
                    "url" => $request->url,
                    "idcategory" => $request->id_category,
                    "idpublisher" => $request->id_publisher,
                ];

                $urls = Helper::callGetHTTP("https://api.adsrv.net/v2/site?filter[url]=".$request->url."&page=1&per-page=10000");
                if(!empty($urls)){
                    return response()->json([
                        'status' => false,
                        'message' => 'URL is had already',
                    ]);
                }

                // Lấy thông tin người assign publisher được gán

                $infoPublisher = User::where('api_publisher_id', $request->id_publisher)->first();
                $assignUser = !empty($infoPublisher->getFirstUserAssign()->id) ? ($infoPublisher->getFirstUserAssign()->getInfoAssign()->id) : $infoPublisher->id;


                $item = Helper::callPostHTTP("https://api.adsrv.net/v2/site", $params);

                // Lưu dữ lieu vao database
                \App\Models\Website::create([
                    'user_id' => $assignUser,
                    'name' => $item['name'] ?? '0',
                    'url' => $item['url'] ?? '0',
                    'category_website_id' => $item['category']['id'] ?? '0',
                    'description' => '0',
                    'status' => $item['status']['id'] ?? '0',
                    'api_site_id' => $item['id'] ?? '0',
                    'is_delete' => 0,
                    'created_by' => auth()->user()->id ?? '0',
                ]);

                $users = User::where('is_admin', 0)->get();

                if (Helper::isErrorAPIAdserver($item)){
                    return response()->json($item, 400);
                }

                return response()->json([
                    'status' => true,
                    'html' => \view('administrator.websites.add_table', compact('item', 'users'))->render(),
                ]);

            })->name('ajax.administrator.website.store');

            Route::put('/update', function (Request $request) {

                $params = [];
                if (isset($request->is_active)){
                    $params['is_active'] = $request->is_active;
                }

                if (isset($request->idstatus)){
                    $params['idstatus'] = $request->idstatus;
                }

                if (isset($request->id_publisher)){
                    $params['idpublisher'] = $request->id_publisher;
                }

                if (isset($request->id_category)){
                    $params['idcategory'] = $request->id_category;
                }

                if (isset($request->url)){
                    $params['url'] = $request->url;
                }

                if (isset($request->name)){
                    $params['name'] = $request->name;
                }

                $item = Helper::callPutHTTP("https://api.adsrv.net/v2/site/" . $request->idsite, $params);

                $users = User::where('is_admin', 0)->get();

                if (Helper::isErrorAPIAdserver($item)){
                    return response()->json($item, 400);
                }

                $item['html_row'] = View::make('administrator.websites.row_edit', compact('item', 'users'))->render();

                $send_to = Helper::callGetHTTP('https://api.adsrv.net/v2/site/'. $request->idsite)['publisher']['email'];

                Mail::to($send_to)->send(new \App\Mail\Mail($item));

                return response()->json($item);

            })->name('ajax.administrator.website.update');

            Route::get('/list-by-publisher', [
                'as' => 'ajax.administrator.website.listByPublisher',
                'uses' => 'App\Http\Controllers\Admin\WebsiteController@listByPublisher',
            ]);

            Route::delete('/delete', [
                'as' => 'ajax.administrator.website.delete',
                'uses' => 'App\Http\Controllers\Admin\WebsiteController@delete',
            ]);
        });

        Route::prefix('zone')->group(function () {
            Route::delete('/', [
                'as' => 'ajax.administrator.zone.delete',
                'uses' => 'App\Http\Controllers\Admin\ZoneController@delete',
            ]);

            Route::get('/get', function (Request $request) {

                $item = Helper::callGetHTTP("https://api.adsrv.net/v2/zone/" . $request->idzone);
                if (Helper::isErrorAPIAdserver($item)){
                    return response()->json($item, 400);
                }

                foreach ($item['assigned_ads'] as $index => $ad){
                    $campaign = Helper::callGetHTTP("https://api.adsrv.net/v2/campaign/" . $ad['idcampaign']);
                    $item['assigned_ads'][$index]['campaign'] = $campaign;
                }

                return response()->json($item);

            })->name('ajax.administrator.zone.get');

            Route::post('/store', [
                'as' => 'ajax.administrator.zone.store',
                'uses' => 'App\Http\Controllers\Admin\ZoneController@store',
            ]);

            Route::get('/detail', [
                'as' => 'ajax.administrator.zone.detail',
                'uses' => 'App\Http\Controllers\Admin\ZoneController@detailZone',
            ]);

            Route::get('/list-by-site', [
                'as' => 'ajax.administrator.zone.listBySite',
                'uses' => 'App\Http\Controllers\Admin\ZoneController@listBySite',
            ]);
//            Route::post('/store', function (Request $request) {
//                $get_url = Helper::callGetHTTP('https://api.adsrv.net/v2/site/'.$request->idsite);
//
//                if(empty($request->name)){
//                    $name = $get_url['name'].' '.$request->namedimision;
//                }else{
//                    $name = $request->name;
//                }
//
//                $check_name = Helper::callGetHTTP('https://api.adsrv.net/v2/zone?idsite='.$request->idsite.'&filter[name]='.$name);
//                if(count($check_name) > 0){
//                    $name = $name.' #'.(count($check_name) + 1);
//                }else{
//                    $name = $name;
//                }
//
//                $params = [
//                    "name" => $name,
//                    "iddimension" => $request->iddimension,
//                    "idzoneformat" => $request->idzoneformat,
//                ];
//
//                $item = Helper::callPostHTTP("https://api.adsrv.net/v2/zone?idsite=" . $request->idsite, $params);
//
//                if (Helper::isErrorAPIAdserver($item)){
//                    return response()->json($item, 400);
//                }
//
//                return response()->json([
//                    'html' => \view('administrator.websites.add_zone', compact('item'))->render()
//                ]);
//
//            })->name('ajax.administrator.zone.store');

            Route::put('/update', function (Request $request) {


                $params = [
                    "idstatus" => $request->zone_status_id,
                    "is_active" => $request->zone_active ? 1 : 0,
                ];

                $item = Helper::callPutHTTP("https://api.adsrv.net/v2/zone/" . $request->zone_id, $params);

                \App\Models\ZoneModel::where('ad_zone_id', $request->zone_id)->update([
                    'updated_by' => auth()->user()->id ?? '0'
                ]);

//                $site_id  = Helper::callGetHTTP('https://api.adsrv.net/v2/zone/'. $request->zone_id)['site']['id'];
//                $send_to = Helper::callGetHTTP('https://api.adsrv.net/v2/site/'. $site_id)['publisher']['email'];
//
//                Mail::to($send_to)->send(new \App\Mail\ZoneMail($item));

                return response()->json([
                    'html' => \view('administrator.advertises.add_table')->with(compact('item'))->render(),
                ]);

            })->name('ajax.administrator.zone.update');

        });

        Route::prefix('ad')->group(function () {
            Route::post('/store', [
                'as' => 'ajax.administrator.ad.store',
                'uses' => 'App\Http\Controllers\Admin\ZoneController@store',
            ]);

        });

        Route::prefix('campaign')->group(function () {
            Route::delete('/delete', function (Request $request) {
                $item = Helper::callDeleteHTTP("https://api.adsrv.net/v2/campaign/". $request->id);
                return response()->json($item);

            })->name('ajax.administrator.campaign.delete');

            Route::post('/store', [
                'as' => 'ajax.administrator.campaign.store',
                'uses' => 'App\Http\Controllers\Admin\CampaignController@storeAjaxCampaign',
            ]);
            Route::delete('/', [
                'as' => 'ajax.administrator.campaign.delete',
                'uses' => 'App\Http\Controllers\Admin\CampaignController@deleteAjaxCampaign',
            ]);

        });

        Route::prefix('user')->group(function () {
            Route::put('/update', function (Request $request) {

                $params = [];

                if (isset($request->is_active)){
                    $params['is_active'] = $request->is_active;
                }

                if (isset($request->idstatus)){
                    $params['idstatus'] = $request->idstatus;
                }

                $item = Helper::callPutHTTP("https://api.adsrv.net/v2/user/" . $request->id, $params);

                if (Helper::isErrorAPIAdserver($item)){
                    return response()->json($item, 400);
                }

                return response()->json($item);

            })->name('ajax.administrator.user.update');

        });

        Route::prefix('upload-image')->group(function () {
            Route::post('/store', function (Request $request) {

                $item = SingleImage::firstOrCreate([
                    'relate_id' => $request->id,
                    'table' => $request->table,
                ],[
                    'relate_id' => $request->id,
                    'table' => $request->table,
                    'image_path' => 'waiting_update',
                    'image_name' => 'waiting_update',
                ]);

                $dataUploadFeatureImage = StorageImageTrait::storageTraitUpload($request, 'image', 'single', $item->id);

                $item->update([
                    'image_path' => $dataUploadFeatureImage['file_path'],
                    'image_name' => $dataUploadFeatureImage['file_name'],
                ]);
                $item->refresh();

                return response()->json($item);

            })->name('ajax,administrator.upload_image.store');
        });

        Route::prefix('upload-multiple-images')->group(function () {

            Route::post('/store', function (Request $request) {

                $item = Image::create([
                    'uuid' => $request->id,
                    'table' => $request->table,
                    'image_path' => "waiting",
                    'image_name' => "waiting",
                    'relate_id' => $request->relate_id ?? 0,
                ]);

                $dataUploadFeatureImage = StorageImageTrait::storageTraitUpload($request, 'image','multiple', $item->id);

                $dataUpdate = [
                    'image_path' => $dataUploadFeatureImage['file_path'],
                    'image_name' => $dataUploadFeatureImage['file_name'],
                ];

                $item->update($dataUpdate);
                $item->refresh();

                return response()->json($item);

            })->name('ajax,administrator.upload_multiple_images.store');

            Route::delete('/delete', function (Request $request) {
                $image = Image::find($request->id);
                if (empty($image)){
                    $image = Image::where('uuid', $request->id)->first();
                }
                if (!empty($image)){
                    $image->delete();
                }
                return response()->json($image);
            })->name('ajax,administrator.upload_multiple_images.delete');

            Route::put('/sort', function (Request $request) {

                foreach ($request->ids as $index => $id){
                    $image = Image::find($id);
                    if (empty($image)){
                        $image = Image::where('uuid', $id)->first();
                    }

                    if (!empty($image)){
                        $image->update([
                            'index' => $index
                        ]);
                    }
                }

                return response()->json($request->ids);
            })->name('ajax,administrator.upload_multiple_images.sort');

        });
    });

    Route::prefix('/orders')->group(function () {
        Route::group(['middleware' => ['auth']], function () {
            Route::put('/update-to-shipping/{id}', [
                'as' => 'ajax.administrator.orders.update_to_shipping',
                'uses' => 'App\Http\Controllers\Admin\OrderController@updateToShipping',
                'middleware' => 'can:orders-edit',
            ]);
        });
    });


    Route::prefix('/')->group(function () {
        Route::group(['middleware' => ['auth']], function () {
            Route::prefix('chat')->group(function () {
                Route::prefix('participant')->group(function () {

                    Route::get('/{id}', function (Request $request, $chatGroupId) {
                        if (empty(ParticipantChat::where('user_id', auth()->id())->where('chat_group_id', $chatGroupId)->first())) {
                            return response()->json([
                                "code" => 404,
                                "message" => "Không tìm thấy nhóm chat"
                            ], 404);
                        }

                        $queries = ["chat_group_id" => $chatGroupId];
                        $results = RestfulAPI::response(Chat::class, $request, $queries);

                        foreach ($results as $item) {
                            $item->user;
                            $item->images;
                        }
                        return $results;
                    })->name('administrator.chat.participant');

                });

                Route::post('/create', function (PusherChatRequest $request) {

                    $chat = Chat::create([
                        'content' => $request->contents,
                        'user_id' => auth()->id(),
                        'chat_group_id' => $request->chat_group_id,
                    ]);

                    for ($x = 0; $x < $request->total_files; $x++) {
                        if ($request->hasFile('feature_image' . $x)) {
                            $dataChatImageDetail = StorageImageTrait::storageTraitUploadMultiple( $request->file('feature_image'.$x),  'chat');

                            ChatImage::create([
                                'image_name' => $dataChatImageDetail['file_name'],
                                'image_path' => $dataChatImageDetail['file_path'],
                                'chat_id' => $chat->id,
                            ]);
                        }
                    }

                    foreach (ParticipantChat::where('chat_group_id', $request->chat_group_id)->get() as $item) {
                        if (auth()->id() != $item->user_id) {
                            $image_link = User::find($item->user_id)->feature_image_path;
                            event(new ChatPusherEvent($request, $item, auth()->id(), $image_link,$chat->images));
                        }

                        Notification::sendNotificationFirebase($item->user_id, $request->contents,null,'Chat',auth()->id(), $request->chat_group_id);

                        if ($item->user_id == auth()->id()){
                            $item->update([
                                'is_read' => 1
                            ]);
                        }else{
                            $item->update([
                                'is_read' => 0
                            ]);
                        }

                    }

//                    return view('administrator.chat.components')->with(['itemChat' => $chat])->render();

                    return response()->json($chat);
                })->name('administrator.chat.create');

            });
        });
    });

});

