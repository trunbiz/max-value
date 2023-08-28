<?php

namespace App\Listeners;

use App\Events\UserRegistered;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class NewUserRegistered
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\UserRegistered  $event
     * @return void
     */
    public function handle(UserRegistered $event)
    {
        //
        // Lấy thông tin người dùng đã đăng ký
        $user = $event->user;

        // Thực hiện các chức năng bạn muốn thực hiện sau khi người dùng đăng ký mới
        // Ví dụ: Gửi email chào mừng, tạo dữ liệu liên quan, vv.
        // Ví dụ:
        Log::info('Message log okey');
        Mail::to($user->email)->send(new WelcomeEmail($user));
        $user->createProfile();
    }
}
