<?php

namespace App\Filament\Resources\AnalyticsResource\Widgets;

use App\Models\Comment;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Database\Eloquent\Relations\Relation;

class LatestComments extends BaseWidget
{
    protected int | string | array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        return $table->query(
            Comment::query()->latest()
        )->columns([
            Tables\Columns\TextColumn::make('user.name'),
            Tables\Columns\TextColumn::make('content')
                ->searchable()
                ->sortable()
                ->wrap()
                ->words(10),
            Tables\Columns\TextColumn::make('created_at')
                ->dateTime()
                ->label('Created Date')
                ->sortable(),

        ])->defaultPaginationPageOption(5);
    }


}
