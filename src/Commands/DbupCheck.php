<?php

namespace Programic\Dbup\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class DbupCheck extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'dbup:check';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check if the database connection is alive.';

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
     * @return mixed
     */
    public function handle()
    {
        $totalRetries = 0;
        $maxRetries = 60;

        while (true) {
            $totalRetries++;

            try {
                DB::connection()->getPdo();
                $this->line('<fg=green>Database is alive.');
                break;
            } catch (\Exception $e) {
                if ($totalRetries == $maxRetries) {
                    $this->line('<fg=red>Database connection is dead. Exit 1.');
                    return 1;
                }

                $this->line('<fg=red>Database not responding yet. Retry...');
                sleep(1);
            }
        }
    }
}
