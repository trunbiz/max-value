<?php

namespace App\Console\Commands;

use App\Mail\MailNotiUserNew;
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
        $formEmail = [
            'userAdmin' => 'trunbiz',
            'nameUser' => 'abc',
            'emailUser' => 'XXX',
            'dateUser' => 'yyyy',
        ];
//        $viewMail = View::make('commons.mailRegisterUserNew', $formEmail)->render();
        Mail::to('trungtb@9pay.vn')->send(new MailNotiUserNew($formEmail));
        return 0;
    }
}
