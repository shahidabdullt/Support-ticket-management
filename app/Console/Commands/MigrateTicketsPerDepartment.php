<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;


use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Config;

class MigrateTicketsPerDepartment extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'migrate:tickets-multi-db';

    protected $description = 'Run ticket migration on all department databases';

    protected $connections = ['technical', 'billing', 'product', 'general', 'feedback'];
    /**
     * The console command description.
     *
     * @var string
     */
    

    /**
     * Execute the console command.
     */
    public function handle()
    {
        foreach ($this->connections as $connection) {
            $this->info("Migrating for: $connection");
            Artisan::call('migrate', [
                '--database' => $connection,
                '--path' => 'database/migrations/2025_06_11_162144_create_tickets_table.php', // Use your migration file
                '--force' => true,
            ]);
            $this->info(Artisan::output());
        }
    }
}
