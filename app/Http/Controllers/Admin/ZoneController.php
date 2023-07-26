<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use App\Models\Helper;

class ZoneController extends Controller
{

    public function __construct()
    {

    }

    public function store(Request $request)
    {
        $get_url = Helper::callGetHTTP('https://api.adsrv.net/v2/site/' . $request->idsite);

        if (empty($request->name)) {
            $name = $get_url['name'] . ' ' . $request->namedimision;
        } else {
            $name = $request->name;
        }

        $check_name = Helper::callGetHTTP('https://api.adsrv.net/v2/zone?idsite=' . $request->idsite . '&filter[name]=' . $name);
        if (count($check_name) > 0) {
            $name = $name . ' #' . (count($check_name) + 1);
        } else {
            $name = $name;
        }

        $params = [
            'name' => $name,
            'idzoneformat' => $request->idzoneformat,
            'iddimension' => $request->iddimension,
            'revenue_rate' => optional(Setting::first())->percent ?? 75,
            'idrevenuemodel' => 2,
        ];

        dd($params);


        $item = Helper::callPostHTTP("https://api.adsrv.net/v2/zone?idsite=" . $request->idsite, $params);

        if (Helper::isErrorAPIAdserver($item)) {
            return response()->json($item, 400);
        }

        return response()->json([
            'html' => view('administrator.advertises.add_table', compact('item'))->render()
        ]);
    }
}
