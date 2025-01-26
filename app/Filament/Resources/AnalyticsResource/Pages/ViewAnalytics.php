<?php

namespace App\Filament\Resources\AnalyticsResource\Pages;

use App\Filament\Resources\AnalyticsResource;
use Filament\Resources\Pages\Page;

class ViewAnalytics extends Page
{
    protected static string $resource = AnalyticsResource::class;

    protected static string $view = 'filament.resources.analytics-resource.pages.view-analytics';

    protected function getHeaderWidgets(): array
    {
        return AnalyticsResource::getWidgets();
    }

}
