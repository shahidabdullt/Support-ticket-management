<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class RollbackTicketsPerDepartment extends Command
{
    protected $signature = 'migrate:tickets-multi-db:rollback';
    protected $description = 'Rollback the tickets migration on all department databases';

    protected $connections = [
        'technical',
        'billing',
        'product',
        'general',
        'feedback',
    ];

    public function handle()
    {
        

        foreach ($this->connections as $conn) {
            $this->info("Rolling back tickets migration for: {$conn}");
            Artisan::call('migrate:rollback', [
                '--database' => $conn,
                '--path'     => 'database/migrations/2025_06_11_162144_create_tickets_table.php',
                '--force'    => true,
            ]);
            $this->line(Artisan::output());
        }

        $this->info(' All department rollbacks complete.');
       
    }
}
