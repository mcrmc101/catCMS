<?php

namespace App\Console\Commands;

use App\Services\UmamiService;
use Illuminate\Console\Command;

class TestUmami extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:test-umami';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // $test = UmamiService::getReport();
        //$test = UmamiService::testConnection();
        //$test = UmamiService::getEvents();
        $test = UmamiService::getPageViews();
        dd($test->body());
    }
}
