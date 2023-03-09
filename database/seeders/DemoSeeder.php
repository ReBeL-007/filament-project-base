<?php

namespace Database\Seeders;

use App\Models\Site;
use App\Models\Check;
use Illuminate\Support\Arr;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DemoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Site::truncate();
        // Check::truncate();

        $site = Site::create([
            'name' => 'tallstack.dev',
            'urls' => [
                [
                    'name' => 'Home',
                    'url' => 'https://tallstack.dev'
                ],
                [
                    'name' => 'Resources',
                    'url' => 'https://tallstack.dev/resources'
                ]
            ],
        ]);


        foreach (range(0, 50) as $_) {
            $status = Arr::random(['in_progress', 'complete', 'failed']);

            $site->checks()->create([
                'status' => $status,
                'completed_at' => $status == 'complete' || $status == 'failed' ? now() : null,
            ]);
        }
    }
}
