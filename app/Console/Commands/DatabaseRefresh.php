<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class DatabaseRefresh extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'medlabs:db-refresh {--force} {--seeder=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Refresh database';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $options = $this->options();
        $force = $options['force'];
        $productionSeeder = $options['seeder'] === 'production';
        $isProduction = env('APP_ENV') == 'production';

        if ($isProduction && !$force) {
            $this->error('Do NOT run this in production!');
            exit;
        }

        echo "Composer dump-autoload... \n";
        $output = shell_exec('composer dump-autoload');
        echo "\n$output\n";

        echo "Database: Dropping tables... \n";
        $output = shell_exec('php artisan db:wipe');
        echo "\n$output\n";

        echo "Database: Migrating Tables... \n";
        $output = shell_exec('php artisan migrate');
        echo "\n$output\n";

        if ($isProduction || $productionSeeder) {
            echo "Inserting necesarry seeders... \n";
            $output = shell_exec('php artisan db:seed --class=FreshDatabaseSeeder');
            echo "\n$output\n";
        } else {
            echo "Database: Seeding Tables... \n";
            $output = shell_exec('php artisan db:seed');
            echo "\n$output\n";
            $output = shell_exec('php artisan db:seed --class=ClientCredentialsSeeder');
            echo "\n$output\n";
        }
    }
}
