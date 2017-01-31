<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\Chat\TelegramService;

class UpdateSubscribers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'subscribers:update';

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
        $telegramService = new TelegramService();

        while (true) {
            $telegramService->updateSubscribers();
        }
    }
}
