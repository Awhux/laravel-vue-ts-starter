<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class AnalyzeCode extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'code:analyze';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Perform static analysis on the codebase.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $dusterCommand = 'php ./vendor/bin/duster lint';
        $phpstanCommand = 'php ./vendor/bin/phpstan:analyse --level max';

        // Run laravel Duster
        $this->info('Analyzing code (Duster)...');
        if (! exec($dusterCommand)) {
            $this->error('Duster found some issues. Please fix them before continuing.');
            exit(1);
        }

        // Run PHPStan
        $this->info('Analyzing code (PHPStan)...');
        if (! exec($phpstanCommand)) {
            $this->error('PHPStan found some issues. Please fix them before continuing.');
            exit(1);
        }

        // Done
        $this->info('Done!');
    }
}
