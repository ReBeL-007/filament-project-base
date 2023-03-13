<?php

namespace App\Filament\Widgets;

use App\Models\Check;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Card;

class ChecksToday extends StatsOverviewWidget
{
    protected function getCards(): array
    {
        return [
            Card::make('No. of checks today', Check::query()->whereDate('created_at', today())->count()),
        ];
    }
}
