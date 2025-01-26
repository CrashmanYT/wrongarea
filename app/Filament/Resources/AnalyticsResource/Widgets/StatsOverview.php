<?php

namespace App\Filament\Resources\AnalyticsResource\Widgets;

use App\Models\Post;
use App\Models\User;
use Filament\Forms\Components\Card;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Posts Total', Post::query()->count()),
            Stat::make('Users Total', User::query()->count()),
            Stat::make('Draft Total', Post::query()->where('status', '=', 'draft')->count())
        ];
    }

}
