<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class InstallTestData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'install:testdata';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Run the migrations and install test data.';

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
     * @return void
     */
    public function handle()
    {
        $this->line('Run migrations...');
        shell_exec('php artisan migrate:fresh');

        $this->line('Install test data...');
        shell_exec('php artisan db:seed --class=DefaultSeeder');

        $this->line('Seed the database...');
        shell_exec('php artisan db:seed');

        $this->info('Done!');
    }
}
