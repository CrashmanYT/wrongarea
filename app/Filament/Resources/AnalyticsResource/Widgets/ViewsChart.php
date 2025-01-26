<?php

namespace App\Filament\Resources\AnalyticsResource\Widgets;

use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;

class ViewsChart extends ChartWidget
{
    protected static ?string $heading = 'Last Views';
    public ?string $filter = 'all';

    protected function getData(): array
    {
        $startDate = $this->getStartDateForFilter($this->filter);

        $views = DB::table('post_views')
            ->selectRaw('DATE_FORMAT(created_at, "%Y-%m") as month, COUNT(post_id) as total')
            ->when($startDate, fn($query) => $query->where('created_at', '>=', $startDate))
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('total', 'month')
            ->toArray();

        return [
            'datasets' => [
                [
                    'label' => 'Jumlah Penonton',
                    'data' => array_values($views),
                ],
            ],
            'labels' => array_keys($views),
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
}
