<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Helper;
use App\Models\WalletUser;
use App\Models\WithdrawType;
use Illuminate\Http\Request;
use Illuminate\View\View;


class AjaxController extends Controller
{
    function getSite(Request $request){
        $site_id = $request->id;

        $items = Helper::callGetHTTP('https://api.adsrv.net/v2/site/'.$site_id);
        $items['category_id'] = $items['category']['id'];

        return $items;
    }

    function createZone(Request $request){
        $params = [
            "name" => $request->name,
            "iddimension" => $request->iddimension,
            "idzoneformat" => $request->idzoneformat,
        ];


        $item = Helper::callPostHTTP("https://api.adsrv.net/v2/zone?idsite=" . $request->site_id, $params);

        if($request->idzoneformat == 6){
            $name = $item['dimension']['name'];
        }
        $format = $item['format']['name'];
        $status = $item['status']['name'];
        $name = '';

        if (Helper::isErrorAPIAdserver($item)){
            return response()->json($item, 400);
        }

        return response()->json([
            'html' => view('user.websites.add_ad', compact('format', 'name', 'status', 'item'))->render()
        ]);
    }

    function getCode(Request $request){
        $code_id = $request->id;

        $items = Helper::callGetHTTP('https://api.adsrv.net/v2/zone/'.$code_id);
        $name = $items['name'];
        $codes = $items['code'];

        return response()->json([
            'html' => view('user.websites.get_code', compact('codes', 'name'))->render()
        ]);

    }

    function getMethod(Request $request){
        $bank_id = $request->bank_id;
        $banks_child = [];
        if($bank_id == 3){
            $banks_child = WithdrawType::where('parent_id', 3)->get();
        }
        $item = WithdrawType::find($bank_id);
        $image_path = $item->image_path;

        return response()->json([
            'html' => view('user.wallet_users.get_info', compact('item', 'banks_child'))->render(),
            'image' => view('user.wallet_users.logo_method', compact('image_path'))->render(),
        ]);
    }

    function editMethod(Request $request){
        $item = WalletUser::find($request->id);
        $banks_child = [];
        $banks = WithdrawType::where('parent_id', null)->get();
        if($item->withdraw_type_id == 4 || $item->withdraw_type_id == 5 || $item->withdraw_type_id == 6){
            $banks_child = WithdrawType::where('parent_id', 3)->get();
            $item->type_crypto = $item->withdraw_type_id;
            $item->withdraw_type_id = 3;
        }
        return response()->json([
            'html' => view('publisher.wallet_users.edit_popup', compact('item', 'banks', 'banks_child'))->render(),
        ]);
    }

    public function getType(Request $request){
        $type_id = $request->type_id;
        $item = WithdrawType::find($type_id);

        return response()->json([
            'html' => view('user.wallet_users.get_type', compact('item'))->render(),
        ]);
    }
}
