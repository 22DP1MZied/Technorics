<?php

namespace App\Filament\Widgets;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverviewWidget extends BaseWidget
{
    protected function getStats(): array
    {
        $totalRevenue = Order::where('payment_status', 'paid')->sum('total');
        $todayOrders = Order::whereDate('created_at', today())->count();

        return [
            Stat::make('Kopējie ieņēmumi', '€' . number_format($totalRevenue, 2))->description('Visu laiku ieņēmumi')->descriptionIcon('heroicon-m-arrow-trending-up')->color('success'),
            Stat::make('Kopējie pasūtījumi', Order::count())->description($todayOrders . ' pasūtījumi šodien')->descriptionIcon('heroicon-m-shopping-bag')->color('info'),
            Stat::make('Kopējie produkti', Product::count())->description(Product::where('stock', '>', 0)->count() . ' noliktavā')->descriptionIcon('heroicon-m-cube')->color('warning'),
            Stat::make('Kopējie klienti', User::count())->description('Reģistrētie lietotāji')->descriptionIcon('heroicon-m-users')->color('primary'),
        ];
    }
}
