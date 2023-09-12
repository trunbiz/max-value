<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Services\CallDataService;
use Illuminate\Console\Command;

class CallDataAdServer extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'callData:AdServer';

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
        $callDataAdServer = new CallDataService();
        $callDataAdServer->callDataSite();

//        $userP = [];
//        $callDataAdServer->callDataPublisher(1, $userP);
//        // Cập nhât trạng thái no active cho publihser
//        if (!empty($userP))
//        {
//            User::where('is_admin', 0)->where('role_id', 4)->whereNotIn('api_publisher_id', $userP)
//                ->update(['active' => 0]);
//        }
    }
}
