<?php

namespace App\Filament\Widgets;

use App\Models\Order;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Database\Eloquent\Builder;

class LatestOrders extends BaseWidget
{
    protected int | string | array $columnSpan = 'full';
    
    protected static ?int $sort = 2;

    protected function getTableQuery(): Builder
    {
        return Order::query()->latest()->limit(5);
    }

    protected function getTableColumns(): array
    {
        return [
            Tables\Columns\TextColumn::make('order_number')
                ->searchable(),
            
            Tables\Columns\TextColumn::make('user.name')
                ->searchable(),
            
            Tables\Columns\TextColumn::make('total')
                ->money('EUR'),
            
            Tables\Columns\BadgeColumn::make('status')
                ->colors([
                    'secondary' => 'pending',
                    'warning' => 'processing',
                    'primary' => 'shipped',
                    'success' => 'delivered',
                    'danger' => 'cancelled',
                ]),
            
            Tables\Columns\TextColumn::make('created_at')
                ->dateTime()
                ->sortable(),
        ];
    }
}
