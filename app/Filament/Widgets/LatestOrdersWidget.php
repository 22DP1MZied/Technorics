<?php

namespace App\Filament\Widgets;

use App\Models\Order;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class LatestOrdersWidget extends BaseWidget
{
    protected int | string | array $columnSpan = 'full';
    protected static ?int $sort = 2;
    protected static ?string $heading = 'Jaunākie pasūtījumi';

    public function table(Table $table): Table
    {
        return $table->query(Order::query()->latest()->limit(5))->columns([
            Tables\Columns\TextColumn::make('order_number')->label('Pasūtījums #')->searchable(),
            Tables\Columns\TextColumn::make('user.name')->label('Klients')->searchable(),
            Tables\Columns\TextColumn::make('total')->label('Kopā')->money('EUR'),
            Tables\Columns\BadgeColumn::make('status')->label('Statuss')->formatStateUsing(fn (string $state): string => match ($state) {'pending' => 'Gaida', 'processing' => 'Apstrādē', 'shipped' => 'Nosūtīts', 'delivered' => 'Piegādāts', 'cancelled' => 'Atcelts', default => $state})->colors(['secondary' => 'pending', 'warning' => 'processing', 'primary' => 'shipped', 'success' => 'delivered', 'danger' => 'cancelled']),
            Tables\Columns\TextColumn::make('created_at')->label('Datums')->dateTime()->sortable(),
        ]);
    }
}
