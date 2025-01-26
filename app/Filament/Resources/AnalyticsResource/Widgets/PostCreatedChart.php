<?php

namespace App\Filament\Resources\AnalyticsResource\Widgets;

use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;

class PostCreatedChart extends ChartWidget
{
    protected static ?string $heading = 'Post Created';
    protected static string $color = 'warning';
    public ?string $filter = 'all';

    protected function getData(): array
    {
        $startDate = $this->getStartDateForFilter($this->filter);

        $posts = DB::table('posts')
            ->selectRaw('DATE_FORMAT(created_at, "%Y-%m") as month, COUNT(id) as total')
            ->when($startDate, fn($query) => $query->where('created_at', '>=', $startDate))
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('total', 'month')
            ->toArray();

        return [
            'datasets' => [
                [
                    'label' => 'Number of Posts Created',
                    'data' => array_values($posts),
                ],
            ],
            'labels' => array_keys($posts),
        ];
    }

    protected function getType(): string
    {
        return 'line';
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
}
