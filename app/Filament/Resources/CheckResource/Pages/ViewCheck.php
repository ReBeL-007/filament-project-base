<?php

namespace App\Filament\Resources\CheckResource\Pages;

use Filament\Pages\Actions;
use Filament\Tables\Contracts\HasTable;
use Filament\Resources\Pages\ViewRecord;
use App\Filament\Resources\CheckResource;
use Filament\Tables\Concerns\InteractsWithTable;

class ViewCheck extends ViewRecord implements HasTable
{
    use InteractsWithTable;

    protected static string $resource = CheckResource::class;

    protected static ?string $title = 'View Checks';

    protected static string $view = 'filament.checks.view';
}
