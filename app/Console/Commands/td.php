<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class td extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:td';

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
        $a = 123;
        $a++;
        dd($a);
    }
}
