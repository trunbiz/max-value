<?php

namespace App\Console\Commands;

use App\Services\WalletService;
use Illuminate\Console\Command;

class CalculateRevenue extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'calculate:revenue';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Tính toán lại doanh thu';

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
        $walletService->calculateRevenue();
        return 0;
    }
}
