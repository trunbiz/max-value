<?php

namespace App\Console\Commands;

use App\Services\WalletService;
use Illuminate\Console\Command;

class RevenuePublisher extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'revenue:publisher';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Tính tổng tiền cho publisher';

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
        $walletService = new WalletService();
        return $walletService->revenuePublisherDaily();
    }
}
