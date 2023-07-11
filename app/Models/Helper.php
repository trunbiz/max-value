<?php

namespace App\Models;

use App\Notifications\Notifications;
use App\Traits\DeleteModelTrait;
use App\Traits\StorageImageTrait;
use GuzzleHttp\Client;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class Helper extends Model
{
    use HasFactory;

    use DeleteModelTrait;
    use StorageImageTrait;

    public static function getNextIdTable($table)
    {

        try {
            $item = DB::table($table)->orderBy('id', 'DESC')->first();

            if (empty($item)) {
                return 1;
            }

            return $item->id + 1;
//            $statement = DB::select("SHOW TABLE STATUS LIKE '$table'");
//            return $statement[0]->Auto_increment;
        } catch (\Exception $exception) {
            return 0;
        }

    }

    public static function getTableName($object)
    {
        return $object->getTable();
    }

    public static function getDefaultIcon($object, $size = "100x100")
    {
        $image = $object->image;

        if (!empty($image)) return Formatter::getThumbnailImage($image->image_path, $size);

        if (!empty($object->feature_image_path)) return $object->feature_image_path;

        return config('_my_config.default_avatar');
    }

    public static function image($object)
    {
        $item = $object->hasOne(SingleImage::class, 'relate_id', 'id')->where('table', $object->getTable());

        $isSingle = SingleImage::where('relate_id', $object->id)->where('table', $object->getTable())->first();

        if (!empty($isSingle)) {
            return $item;
        }

        return $object->hasOne(Image::class, 'relate_id', 'id')->where('table', $object->getTable())->orderBy('index');
    }

    public static function images($object)
    {
        $item = $object->hasOne(SingleImage::class, 'relate_id', 'id')->where('table', $object->getTable());
        $isSingle = SingleImage::where('relate_id', $object->id)->where('table', $object->getTable())->first();
        if (!empty($isSingle)) {
            return $item;
        }

        return $object->hasMany(Image::class, 'relate_id', 'id')->where('table', $object->getTable())->orderBy('index');
    }

    public static function getAllColumsOfTable($object)
    {
        return Schema::getColumnListing($object->getTableName());
    }

    public static function searchByQuery($object, $request, $queries = [], $randomRecord = null, $makeHiddens = null, $isCustom = false)
    {
        $columns = Schema::getColumnListing($object->getTableName());
        $query = $object->query();

        $searchLikeColumns = ['name', 'title', 'search_query'];
        $searchColumnBanned = ['limit', 'page', 'with_trashed'];

        foreach ($request->all() as $key => $item) {
            $item = trim($item);

            if (in_array($key, $searchColumnBanned)) continue;

            if (in_array($key, $searchLikeColumns)) {
                if (!empty($item) || strlen($item) > 0) {

                    $query = $query->where(function ($query) use ($item, $columns, $searchLikeColumns) {
                        foreach ($searchLikeColumns as $searchColumn) {
                            if (in_array($searchColumn, $columns)) {
                                $query->orWhere($searchColumn, 'LIKE', "%{$item}%");
                            }
                        }
                    });
                }
            } else if ($key == "start" || $key == "from") {
                if (!empty($item) || strlen($item) > 0) {
                    $query = $query->whereDate('created_at', '>=', $item);
                }
            } else if ($key == "end" || $key == "to") {
                if (!empty($item) || strlen($item) > 0) {
                    $query = $query->whereDate('created_at', '<=', $item);
                }
            } else {
                if (!in_array($key, $columns)) continue;
                if (!empty($item) || strlen($item) > 0) {
                    $query = $query->where($key, $item);
                }
            }
        }

        if (is_array($queries)) {
            foreach ($queries as $key => $item) {
                $item = trim($item);

                if (in_array($key, $searchColumnBanned)) continue;

                if (in_array($key, $searchLikeColumns)) {
                    if (!empty($item) || strlen($item) > 0) {

                        $query = $query->where(function ($query) use ($item, $columns, $searchLikeColumns) {
                            foreach ($searchLikeColumns as $searchColumn) {
                                if (in_array($searchColumn, $columns)) {
                                    $query->orWhere($searchColumn, 'LIKE', "%{$item}%");
                                }
                            }
                        });
                    }
                } else if ($key == "start" || $key == "from") {
                    if (!empty($item) || strlen($item) > 0) {
                        $query = $query->whereDate('created_at', '>=', $item);
                    }
                } else if ($key == "end" || $key == "to") {
                    if (!empty($item) || strlen($item) > 0) {
                        $query = $query->whereDate('created_at', '<=', $item);
                    }
                } else {
                    if (!in_array($key, $columns)) continue;
                    if (!empty($item) || strlen($item) > 0) {
                        $query = $query->where($key, $item);
                    }
                }
            }

            foreach ($queries as $key => $item) {
                $item = trim($item);

                if ($key == 'with_trashed' && $item == true) {
                    $query = $query->withTrashed();
                    break;
                }
            }
        }

        if ($isCustom) {
            return $query;
        }

        $items = $query->latest()->paginate(Formatter::getLimitRequest($request->limit))->appends(request()->query());

        if (!empty($makeHiddens) && is_array($makeHiddens)) {
            foreach ($items as $item) {
                $item->makeHidden($makeHiddens)->toArray();
            }
        }
        return $items;
    }

    public static function searchAllByQuery($object, $request, $queries = [])
    {
        $columns = Schema::getColumnListing($object->getTableName());
        $query = $object->query();

        $searchLikeColumns = ['name', 'title'];
        $searchColumnBanned = ['limit', 'page', 'with_trashed'];

        foreach ($request->all() as $key => $item) {
            $item = trim($item);
            if ($key == "search_query") {
                if (!empty($item) || strlen($item) > 0) {

                    $query = $query->where(function ($query) use ($item, $columns, $searchLikeColumns) {
                        foreach ($searchLikeColumns as $searchColumn) {
                            if (in_array($searchColumn, $columns)) {
                                $query->orWhere($searchColumn, 'LIKE', "%{$item}%");
                            }
                        }
                    });
                }
            } else if ($key == "gender_id") {
                if (!empty($item) || strlen($item) > 0) {
                    $query = $query->where('gender_id', $item);
                }
            } else if ($key == "start" || $key == "from") {
                if (!empty($item) || strlen($item) > 0) {
                    $query = $query->whereDate('created_at', '>=', $item);
                }
            } else if ($key == "end" || $key == "to") {
                if (!empty($item) || strlen($item) > 0) {
                    $query = $query->whereDate('created_at', '<=', $item);
                }
            }
        }

        foreach ($queries as $key => $item) {
            $item = trim($item);

            if (in_array($key, $searchColumnBanned)) continue;

            if ($key == "search_query") {
                if (!empty($item) || strlen($item) > 0) {
                    $query = $query->where(function ($query) use ($item) {
                        $query->orWhere('name', 'LIKE', "%{$item}%");
                    });
                }
            } else if ($key == "gender_id") {
                if (!empty($item) || strlen($item) > 0) {
                    $query = $query->where('gender_id', $item);
                }
            } else if ($key == "start" || $key == "from") {
                if (!empty($item) || strlen($item) > 0) {
                    $query = $query->whereDate('created_at', '>=', $item);
                }
            } else if ($key == "end" || $key == "to") {
                if (!empty($item) || strlen($item) > 0) {
                    $query = $query->whereDate('created_at', '<=', $item);
                }
            } else {
                if (!empty($item) || strlen($item) > 0) {
                    $query = $query->where($key, $item);
                }
            }
        }

        foreach ($queries as $key => $item) {
            $item = trim($item);

            if ($key == 'with_trashed' && $item == true) {
                $query = $query->withTrashed();
                break;
            }
        }

        return $query->latest()->get();
    }

    public static function storeByQuery($object, $request, $dataCreate)
    {
//        $dataUploadFeatureImage = $object->storageTraitUpload($request, 'feature_image_path', $object->getTableName());
//        if (!empty($dataUploadFeatureImage)) {
//            $dataCreate['feature_image_name'] = $dataUploadFeatureImage['file_name'];
//            $dataCreate['feature_image_path'] = $dataUploadFeatureImage['file_path'];
//        }

        $item = $object->create($dataCreate);
        return $item;
    }

    public static function updateByQuery($object, $request, $id, $dataUpdate)
    {
//        $dataUploadFeatureImage = $object->storageTraitUpload($request, 'feature_image_path', $object->getTableName());
//        if (!empty($dataUploadFeatureImage)) {
//            $dataUpdate['feature_image_name'] = $dataUploadFeatureImage['file_name'];
//            $dataUpdate['feature_image_path'] = $dataUploadFeatureImage['file_path'];
//        }
        $object->find($id)->update($dataUpdate);
        $item = $object->find($id);
        return $item;
    }

    public static function deleteByQuery($object, $request, $id, $forceDelete = false)
    {
        return $object->deleteModelTrait($id, $object, $forceDelete);
    }

    public static function deleteManyByIds($object, $request, $forceDelete = false)
    {
        $items = [];
        foreach ($request->ids as $id) {
            $item = $object->deleteModelTrait($id, $object, $forceDelete);
            $items[] = $item;
        }

        return $items;
    }

    public static function addSlug($object, $key, $value)
    {
        $item = $object->where($key, Str::slug($value))->first();
        if (empty($item)) {
            return Str::slug($value);
        }
        for ($i = 1; $i < 100000; $i++) {
            $item = $object->where($key, Str::slug($value) . '-' . $i)->first();
            if (empty($item)) {
                return Str::slug($value) . '-' . $i;
            }
        }
        return Str::random(40);
    }

    public static function logoImagePath()
    {
        $logo = Logo::first();
        if (empty($logo)) {
            $table = 'logos';
        } else {
            $table = $logo->getTableName();
        }

        return optional(SingleImage::where('relate_id', Helper::getNextIdTable($table))->where('table', $table)->first())->image_path;
    }

    public static function sendNotificationToTopic($topicName, $title, $body, $save = false, $user_id = null, $image_path = null, $activity = null)
    {
        if ($save && !empty($user_id)) {
            UserNotification::create([
                'user_id' => $user_id,
                'title' => $title,
                'content' => $body,
                'image_path' => $image_path ?? Helper::logoImagePath(),
                'activity' => $activity,
            ]);
        }

        if (env('FIREBASE_SERVER_NOTIFIABLE', true)) {
            $client = new Client();
            $client->post(
                'https://fcm.googleapis.com/fcm/send',
                [
                    'headers' => [
                        'Content-Type' => 'application/json',
                        'Authorization' => env('FIREBASE_SERVER_KEY')],
                    'json' => [
                        'to' => '/topics/' . $topicName,
                        'notification' => [
                            'title' => $title,
                            'body' => $body,
                            "click_action" => "TOP_STORY_ACTIVITY",
                        ],
                        'apns' => [
                            'headers' => [
                                'apns-priority' => '10'
                            ],
                            'payload' => [
                                'aps' => [
                                    'sound' => 'notification'
                                ]
                            ],
                        ],
                        'android' => [
                            'priority' => 'high',
                            'notification' => [
                                'sound' => 'notification'
                            ],
                        ],
                    ],
                    'timeout' => 1, // Response timeout
                    'connect_timeout' => 1, // Connection timeout
                ],
            );
        }

    }

    public static function getToken(){
        $setting = Setting::first();
        return optional($setting)->token_api;
    }

    public static function callGetHTTP($url, $params = [])
    {

        try {
//            $headers = [
//                'Content-Type' => 'application/json',
//                'AccessToken' => 'C_RnD5JkSIN2Ylcb4loeYNe4MZ5cAL8DL1OqG0DY',
//                'Authorization' => 'Bearer '. self::getToken(),
//            ];
//
//            $response = Http::withHeaders($headers)->timeout(10)
//                ->send('GET', $url)->json();
//
//            return $response;

            $headers = [
                'Content-Type' => 'application/json',
                'AccessToken' => 'C_RnD5JkSIN2Ylcb4loeYNe4MZ5cAL8DL1OqG0DY',
                'Authorization' => 'Bearer '. self::getToken(),
            ];

            $client = new Client([
                'headers' => $headers
            ]);

            $response = $client->request('GET', $url, $params);

            return json_decode($response->getBody(), true);
        } catch (\Exception $exception) {
            if ($exception->getCode() == 429) return self::callGetHTTP($url, $params);
            Log::error($exception->getMessage());
            return null;
        }
    }

    public static function callPostHTTP($url, $params = [])
    {
        try {
            $headers = [
                'Content-Type' => 'application/json',
                'AccessToken' => 'C_RnD5JkSIN2Ylcb4loeYNe4MZ5cAL8DL1OqG0DY',
                'Authorization' => 'Bearer '. self::getToken(),
            ];

            $response = Http::withHeaders($headers)->timeout(10)
                ->send('POST', $url, [
                    'body' => json_encode($params)
                ])->json();

            return $response;
        } catch (\Exception $exception) {
            if ($exception->getCode() == 429) return self::callPostHTTP($url, $params);
            Log::error($exception->getMessage());
            return null;
        }
    }

    public static function callPutHTTP($url, $params = [])
    {

        try {
            $headers = [
                'Content-Type' => 'application/json',
                'AccessToken' => 'C_RnD5JkSIN2Ylcb4loeYNe4MZ5cAL8DL1OqG0DY',
                'Authorization' => 'Bearer '. self::getToken(),
            ];

            $response = Http::withHeaders($headers)->timeout(10)
                ->send('PUT', $url, [
                    'body' => json_encode($params)
                ])->json();

            return $response;
        } catch (\Exception $exception) {
            if ($exception->getCode() == 429) return self::callPutHTTP($url, $params);
            Log::error($exception->getMessage());
            return null;
        }
    }

    public static function callDeleteHTTP($url, $params = [])
    {

        try {
            $headers = [
                'Content-Type' => 'application/json',
                'AccessToken' => 'C_RnD5JkSIN2Ylcb4loeYNe4MZ5cAL8DL1OqG0DY',
                'Authorization' => 'Bearer '. self::getToken(),
            ];

            $response = Http::withHeaders($headers)->timeout(10)
                ->send('DELETE', $url, [
                    'body' => json_encode($params)
                ])->json();

            return $response;
        } catch (\Exception $exception) {
            if ($exception->getCode() == 429) return self::callDeleteHTTP($url, $params);
            Log::error($exception->getMessage());
            return null;
        }
    }

    public static function errorAPI($code, $data, $message)
    {
        return [
            'success' => false,
            'code' => $code,
            'data' => $data,
            'message' => $message
        ];

    }

    public static function randomString()
    {
        return Str::random(10);
    }

    public static function sendEmailToShop($subject, $body)
    {
        $email = env('EMAIL_SHOP');

        $user = (new User([
            'email' => $email,
            'name' => substr($email, 0, strpos($email, '@')), // here we take the name form email (string before "@")
        ]));

        $user->notify(new Notifications($subject, $body));
    }

    public static function amountPub($impre, $cpm)
    {
        return round(self::impressPub($impre) / 1000 * self::cpmPub($cpm), 2);
    }

    public static function cpmPub($cpm_input)
    {
        return round($cpm_input * (optional(Setting::first())->percent ?? 100) / 100, 2);
    }

    public static function impressPub($amount)
    {
        return (int) (((float)$amount) * (optional(Setting::first())->count ?? 0) / 100);
    }

    public static function totalByKeyInArray($array, $key)
    {

        $total = 0;

        foreach ($array as $item) {
            if (isset($item[$key])){
                $total += (float) $item[$key];
            }
        }

        return $total;
    }

    public static function isErrorAPIAdserver($input)
    {
        return (empty($input) || (is_array($input) && isset($input['errors'])));
    }

    public static function htmlStatus($input)
    {
        if ($input == "Pending"){
            return "<span style=\"display: flex;align-items: center;background-color: #fffcf9;padding: 5px;border-radius: 15px;color: #ffc500;\"><a class='ms-1 me-1'>{$input}</a><i class=\"fa-solid fa-rotate\"></i></span>";
        }else if ($input == "Approved"){
            return "<span style=\"display: flex;align-items: center;background-color: #d0ffef;padding: 5px;border-radius: 15px;color: #03a900;\"><a class='ms-1 me-1'>{$input}</a><i class=\"fa-solid fa-rotate\"></i></span>";
        }else{
            return "<span style=\"display: flex;align-items: center;background-color: #ffdbdb;padding: 5px;border-radius: 15px;color: #ff0000;\"><a class='ms-1 me-1'>{$input}</a><i class=\"fa-solid fa-rotate\"></i></span>";
        }
    }

}
