<?php

namespace App\Console\Commands;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Console\Command;

class Adstxt extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:adstxt';

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
        $textStart =  '#maxvalue.media update - ' . Carbon::now()->format('m-d-y') . '\n';
        $textEnd =  '#maxvalue.media update end - ' . Carbon::now()->format('m-d-y'). '\n';
        $users = User::whereNotNull('partner_code')->pluck('partner_code')->all();

        $adsTxtContent = implode("\n", $users);
        $adsTxtContent = $textStart . $adsTxtContent . $textEnd;

        $filePath = public_path('ads.txt');

        file_put_contents($filePath, $adsTxtContent);

        $this->info('ads.txt file generated successfully!');
        return 0;
    }
}
