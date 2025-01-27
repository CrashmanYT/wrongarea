<?php

namespace App\Filament\Resources\AnalyticsResource\Widgets;

use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class MostViewPost extends BaseWidget
{
    protected static ?string $heading = 'Most Popular Post';
    protected int | string | array $columnSpan = 'full';
    public function table(Table $table): Table
    {
        return $table
            ->query(
                \App\Models\Post::query()->orderByDesc('views')
            )
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->label('Title'),
                Tables\Columns\TextColumn::make('views')
                    ->label('Views'),
                Tables\Columns\TextColumn::make('user.name')
                    ->label('Author'),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Created At')
                    ->dateTime(),
            ]);
    }
}
