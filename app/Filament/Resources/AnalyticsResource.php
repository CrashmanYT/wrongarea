<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AnalyticsResource\Pages;
use App\Filament\Resources\AnalyticsResource\Widgets\LatestComments;
use App\Filament\Resources\AnalyticsResource\Widgets\PostCreatedChart;
use App\Filament\Resources\AnalyticsResource\Widgets\StatsOverview;
use App\Filament\Resources\AnalyticsResource\Widgets\ViewsChart;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AnalyticsResource extends Resource
{
//    protected static ?string $model = Analytics::class;
    protected static ?string $navigationIcon = 'heroicon-o-chart-bar';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getWidgets(): array
    {

        return [
            ViewsChart::class,
            PostCreatedChart::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ViewAnalytics::route('/'),
        ];
    }

}
