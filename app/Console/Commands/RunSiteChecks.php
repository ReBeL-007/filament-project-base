<?php

namespace App\Console\Commands;

use App\Models\Site;
use App\Jobs\RunSiteCheck;
use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\Builder;

class RunSiteChecks extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cron:run-site-checks';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Run all site checks that need to be run.';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // Site's that have no checks or where the last check was more than 5 minutes ago

        $sites = Site::query()
            ->requiresCheck()
            ->get();

            $this->info("Running checks for {$sites->count()} site(s).");

        foreach($sites as $site) {
            $this->info("Running checks for {$site->name} [{$site->id}].");
            dispatch(new RunSiteCheck($site));
        }

        $this->info("Dispatched checks for all pending sites.");
    }
}
