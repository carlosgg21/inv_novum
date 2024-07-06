<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ResetApp extends Command
{
    protected $signature = 'app:reset';
    protected $description = 'Reset the application';

    public function handle()
    {
        $this->call('migrate:refresh', ['--seed' => true]);
    }
}
