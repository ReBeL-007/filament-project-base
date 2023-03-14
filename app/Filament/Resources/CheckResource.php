<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Check;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Resources\Resource;
use Illuminate\Support\HtmlString;
use Filament\Tables\Actions\LinkAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\BadgeColumn;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\CheckResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\CheckResource\Pages\ListChecks;
use App\Filament\Resources\CheckResource\RelationManagers;
use App\Filament\Resources\PostResource\RelationManagers\ChecksRelationManager;

class CheckResource extends Resource
{
    protected static ?string $model = Check::class;

    protected static ?string $navigationIcon = 'heroicon-o-shield-check';

    protected static ?string $navigationGroup = 'Uptime Checker';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('site.name')
                    ->url(fn ($record) => SiteResource::getUrl('edit',['record' => $record->site]))
                    ->hidden(fn ($livewire) => $livewire instanceof ChecksRelationManager)
                    ->searchable()
                    ->sortable(),
                BadgeColumn::make('status')
                    ->enum([
                        'in_progress' => 'In Progress',
                        'complete' => 'Complete',
                        'failed' => 'Failed'
                    ])
                    ->colors([
                        'danger' => 'failed',
                        'warning' => 'in_progress',
                        'success' => 'complete'
                    ])
                    ->sortable(),
                TextColumn::make('created_at')
                    ->label('Start Date & Time')
                    ->dateTime(),
                TextColumn::make('completed_at')
                    ->label('End Date & Time')
                    // ->default(new HtmlString('&ndash;'))
                    ->dateTime()
                    ->sortable(),
            ])
            ->defaultSort('completed_at','desc')
            ->prependActions([
                LinkAction::make('View')
                    ->url(fn ($record) => static::getUrl('view', ['record' => $record]))
                    ->hidden(fn ($livewire) => $livewire instanceof ListChecks),
            ])
            ->filters([
                //
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListChecks::route('/'),
            'view' => Pages\ViewCheck::route('/{record}'),
        ];
    }
}
