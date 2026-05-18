<?php

namespace App\Filament\Widgets;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        $totalRevenue = Order::where('status', '!=', 'cancelled')->sum('total');
        $totalOrders = Order::count();
        $totalProducts = Product::where('is_active', true)->count();
        $totalUsers = User::count();

        return [
            Stat::make('Kopējie ieņēmumi', '€' . number_format($totalRevenue, 2))->description('Visu laiku ieņēmumi')->descriptionIcon('heroicon-m-currency-euro')->color('success')->chart([7, 3, 4, 5, 6, 3, 5, 3])->extraAttributes(['class' => 'bg-gradient-to-br from-emerald-500 to-emerald-700']),
            Stat::make('Kopējie pasūtījumi', $totalOrders)->description('Visi pasūtījumi')->descriptionIcon('heroicon-m-shopping-bag')->color('success')->chart([7, 3, 4, 5, 6, 3, 5, 3])->extraAttributes(['class' => 'bg-gradient-to-br from-emerald-500 to-emerald-700']),
            Stat::make('Aktīvie produkti', $totalProducts)->description('Produkti noliktavā')->descriptionIcon('heroicon-m-cube')->color('success')->chart([7, 3, 4, 5, 6, 3, 5, 3])->extraAttributes(['class' => 'bg-gradient-to-br from-emerald-500 to-emerald-700']),
            Stat::make('Kopējie lietotāji', $totalUsers)->description('Reģistrētie klienti')->descriptionIcon('heroicon-m-users')->color('success')->chart([7, 3, 4, 5, 6, 3, 5, 3])->extraAttributes(['class' => 'bg-gradient-to-br from-emerald-500 to-emerald-700']),
        ];
    }
}
