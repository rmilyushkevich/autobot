<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Parsers\OnlinerParser;
use Illuminate\Support\Facades\Redis;

class UpdateCars extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cars:update';

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
     * @return mixed
     */
    public function handle()
    {
        $onlinerParser = new OnlinerParser();
        $cars = $onlinerParser->parse();

        Redis::set('cars', json_encode($cars));
    }
}
