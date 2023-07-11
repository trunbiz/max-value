<?php

namespace App\Http\Controllers\Cronner;

use App\Http\Controllers\Controller;
use App\Models\Calendar;
use App\Models\Formatter;
use App\Models\Helper;
use App\Models\JobEmail;
use App\Models\SunCalendar;
use App\Models\User;
use App\Models\Website;
use App\Notifications\Notifications;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class CronnerController extends Controller
{
    public function __construct()
    {
//        $this->middleware('XSS');
    }

    public function callback()
    {

        $jobEmails = JobEmail::whereDate('time_send' , '<=', now())->limit(env('MAXIMUM_SEND_EMAIL_ONE_MINUTE', 10))->get();

        foreach ($jobEmails as $jobEmail) {
            if (!empty($jobEmail->user)){
                $jobEmail->user->notify(new Notifications($jobEmail->title, $jobEmail->content, $jobEmail->user));
            }
            $jobEmail->delete();
        }


    }
}
