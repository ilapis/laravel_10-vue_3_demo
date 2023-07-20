<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ListDBConnections extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:connections';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'List all database connections';

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
     * @return int
     */
    public function handle()
    {
        $connections = config('database.connections');
        foreach ($connections as $name => $details) {
            $this->line($name);
        }

        return 0;
    }
}
