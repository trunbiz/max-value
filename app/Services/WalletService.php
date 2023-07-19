<?php

namespace App\Services;

use App\Models\ReportModel;
use App\Models\User;
use App\Models\WalletRevenueModel;
use Carbon\Carbon;

class WalletService
{

    public function __construct()
    {

    }

    public function calculateRevenue()
    {
        $users = User::all();
        foreach ($users as $user)
        {
            $reports = ReportModel::where('publisher_id', $user->api_publisher_id)->where('status', 1)->orderBy('id', 'DESC')->get();
            if ($reports->isEmpty())
                continue;

            foreach ($reports as $report)
            {
                $user->money += $report->change_revenue ?? 0;
            }
            $user->save();
        }

    }

    public function depositWalletPublisher($publisherId, $revenue)
    {
        $user = User::where('api_publisher_id', $publisherId)->first();
        if (empty($user))
            return false;
        $user->money += $revenue;
        $user->save();
        return true;
    }

    public function revenuePublisherDaily()
    {
        // checkDay
        $checkDay = false;

        $users = User::all();
        $yesterDay = Carbon::yesterday()->format('Y-m-d');
        foreach ($users as $user)
        {
            $query = ReportModel::where('publisher_id', $user->api_publisher_id)->where('status', 1);
            if ($checkDay)
            {
                $query->where('date', $yesterDay);
            }
            $reports = $query->orderBy('id', 'DESC')->get();
            if ($reports->isEmpty())
                continue;
            $datas = [];
            foreach ($reports as $report)
            {
                if (isset($datas[$report->date]))
                {
                    $datas[$report->date] += $report->change_revenue;
                }
                else{
                    $datas[$report->date] = $report->change_revenue;
                }
            }

            $addTotal = 0;
            // save wallet revenue
            foreach ($datas as $date => $revenue)
            {
                $checkIsset = WalletRevenueModel::where('user_id', $user->id)->where('date', $date)->first();
                if (!empty($checkIsset))
                    continue;

                WalletRevenueModel::create([
                    'user_id' => $user->id,
                    'date' => $date,
                    'revenue' => $revenue
                ]);
                $addTotal += $revenue;
            }

            // add revenue for money user
            $user->money += $addTotal;
            $user->save();
        }
        return true;
    }
}
