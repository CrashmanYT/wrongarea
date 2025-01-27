<?php

namespace App\Filament\Resources\AnalyticsResource\Widgets;

use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;

class UserGrowthChart extends ChartWidget
{
    protected static ?string $heading = 'User Growth';
    public ?string $filter = 'all';

    protected function getData(): array
    {
        $startDate = $this->getStartDateForFilter($this->filter);

        $users = DB::table('users')
            ->selectRaw('DATE_FORMAT(created_at, "%Y-%m") as month, COUNT(*) as total')
            ->when($startDate, fn($query) => $query->where('created_at', '>=', $startDate))
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('total', 'month')
            ->toArray();

        return [
            'datasets' => [
                [
                    'label' => 'User Growth',
                    'data' => array_values($users),
                ],
            ],
            'labels' => array_keys($users),
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }

    protected function getFilters(): ?array
    {
        return [
            'today' => 'Today',
            'yesterday' => 'Yesterday',
            'week' => 'Last week',
            'month' => 'Last month',
            'last_90_days' => 'Last 90 Days',
            'year' => 'This Year',
            'all' => 'All'
        ];
    }

    private function getStartDateForFilter(?string $filter): ?\Illuminate\Support\Carbon
    {
        return match ($filter) {
            'today' => now()->startOfDay(),
            'yesterday' => now()->subDay()->startOfDay(),
            'week' => now()->subWeek()->startOfWeek(),
            'month' => now()->subMonth()->startOfMonth(),
            'last_90_days' => now()->subDays(90)->startOfDay(),
            'year' => now()->startOfYear(),
            'all' => null,
            default => now()->subYear()->startOfDay(),
        };
    }
}
