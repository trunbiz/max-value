<?php

namespace App\Console\Commands;

use App\Services\CallDataService;
use Illuminate\Console\Command;

class CheckCodeSite extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'check:codeSite';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Run job check code ads.txt and zone gen code';

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
        $callDataService = new CallDataService();
        $callDataService->runCheckCodeSite();
        return 0;
    }
}
