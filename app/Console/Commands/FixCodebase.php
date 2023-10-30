<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class FixCodebase extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'code:fix';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fix codebase issues.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $dusterCommand = 'php ./vendor/bin/duster fix';
        $phpstanCommand = 'php ./vendor/bin/php-cs-fixer fix';

        // Run laravel Duster
        $this->info('Fixing code (Duster)...');
        if (! exec($dusterCommand)) {
            $this->error('Duster found some issues. Please fix them before continuing.');
            exit(1);
        }

        // Run PHPStan
        $this->info('Fixing code (PHP-CS-Fixer)...');
        if (! exec($phpstanCommand)) {
            $this->error('PHP-CS-Fixer found some issues. Please fix them before continuing.');
            exit(1);
        }

        // Done
        $this->info('Done!');
    }
}
