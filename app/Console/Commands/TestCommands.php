<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class TestCommands extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:test-commands';

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
        //
        $this->info('Lệnh Artisan của bạn đã chạy thành công!');


    }
}
