<?php

namespace App\Console\Commands;

use App\Services\ReportService;
use Illuminate\Console\Command;

class GetReportDaily extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'get:reportDaily';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command get data report daily';

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
        $reportService = new ReportService();
        $data = $reportService->getDataReportDaily();
        return 0;
    }
}
