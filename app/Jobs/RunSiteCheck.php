<?php

namespace App\Jobs;

use App\Models\Site;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Http;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class RunSiteCheck implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(protected Site $site)
    {

    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $check = $this->site->checks()->create([
                'status' => 'in_progress'
            ]);

        $result = [];

        foreach($this->site->urls as ['name' => $name, 'url' => $url]) {
            $response = Http::get($url);

            $result[$name] = match (true) {
                $response->redirect() => 'redirected',
                $response->failed() => 'failed',
                default => 'ok',
            };
        }

        $check->update([
            'status' => collect($result)->values()->filter(fn ($value) => $value == 'failed')->isNotEmpty() ? 'failed' : 'complete',
            'results' => $result,
            'completed_at' => now(),
        ]);
    }
}
