<?php

namespace App\Console\Commands;

use App\Mail\MailNotiUserNew;
use App\Models\User;
use App\Services\Common;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\View;

class testCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $userAdminAndSale = User::where('role_id', [1, 4])->where('active', Common::ACTIVE)->get();
        foreach ($userAdminAndSale as $adminSale)
        {
//            dd($adminSale);
            if (!filter_var($adminSale->email, FILTER_VALIDATE_EMAIL)) {
                continue;
            }
            $formEmail = [
                'userAdmin' => 'trunbiz',
                'nameUser' => 'abc',
                'emailUser' => 'XXX',
                'dateUser' => 'yyyy',
            ];
//        $viewMail = View::make('commons.mailRegisterUserNew', $formEmail)->render();
            Mail::to($adminSale->email)->send(new MailNotiUserNew($formEmail));
        }

    }
}
