<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Advertise;
use App\Models\Formatter;
use App\Models\Helper;
use App\Models\User;
use App\Models\Website;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(){
        if(auth()->check()){
            $title = "Dashboard";

            $now = Carbon::now()->addDays(-5);

            $dateStartOfWeek = $now->startOfWeek()->format('Y-m-d');
            $dateEndOfWeek = $now->endOfWeek()->format('Y-m-d');

            $params = [
                'query' => [
                    'dateBegin' => $dateStartOfWeek,
                    'dateEnd' => $dateEndOfWeek,
                    'idpublisher' => \auth()->user()->api_publisher_id,
                ]
            ];

            $stats = Helper::callGetHTTP("https://api.adsrv.net/v2/stats", $params) ?? [];


            $days = [];
            $impressions = [];
            $cpms = [];
            $earnings = [];

            for ($i = 0 ; $i < 7 ; $i++){

                $date = $now->startOfWeek()->addDays($i)->format('Y-m-d');
                $days[] = $date;

                $impression = 0;
                $cpm = 0;
                $amount_pub = 0;

                foreach ($stats as $itemStat){
                    if ($date == $itemStat['dimension']){
                        $impression = Helper::impressPub($itemStat['impressions']);
                        $cpm = Helper::cpmPub($itemStat['cpm']);
                        $amount_pub = Helper::amountPub($itemStat['impressions'], $itemStat['cpm']);
                        break;
                    }
                }

                $impressions[] = $impression;
                $cpms[] = $cpm;
                $earnings[] = $amount_pub;
            }

            $name = "1";
            $avatar_name  = "1";
            $email  = "1";

            return view('user.dashboard.index', compact('title','days','impressions','name','avatar_name','email','cpms','earnings'));
        }
        return redirect()->to('/login');
    }
}
