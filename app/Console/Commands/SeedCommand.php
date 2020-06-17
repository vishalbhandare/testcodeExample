<?php
namespace App\Console\Commands;

use Exception;
use Illuminate\Console\Command;
use RouterSeeder;

class SeedCommand extends Command
{
    protected $signature = 'app:seed {limit}';

    public function handle(RouterSeeder $seeder)
    {
        $limit = $this->argument('limit');
        try {
            $seeder->run($limit);
            $this->line('<fg=green;bg=default>Created '.$limit.' Routers</>');
        } catch(Exception $e) {
            $this->line('<fg=red;bg=default>Failed to create '.$limit.' Router '.$e->getMessage().' </>');
        }

    }
}