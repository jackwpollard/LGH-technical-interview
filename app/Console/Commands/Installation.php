<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Throwable;

class Installation extends Command
{
    protected $signature   = 'lgh:install';
    protected $description = 'Application installation script';

    public function handle() : void
    {
        try
        {
            Artisan::call('down');
            Artisan::call('migrate:fresh', ['--force' => true]);
            Artisan::call('db:seed');
            Artisan::call('route:clear');
            Artisan::call('config:clear');
            Artisan::call('view:clear');
            Artisan::call('up');

            $this->info("Installation complete");
        }
        catch (Throwable $throwable)
        {
            $this->error($throwable->getMessage());
        }
    }
}
