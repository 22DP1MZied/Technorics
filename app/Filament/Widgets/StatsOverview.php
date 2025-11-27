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
            Stat::make('Total Revenue', '€' . number_format($totalRevenue, 2))
                ->description('All time revenue')
                ->descriptionIcon('heroicon-m-currency-euro')
                ->color('success')
                ->chart([7, 3, 4, 5, 6, 3, 5, 3])
                ->extraAttributes([
                    'class' => 'bg-gradient-to-br from-emerald-500 to-emerald-700',
                ]),
                
            Stat::make('Total Orders', $totalOrders)
                ->description('All orders')
                ->descriptionIcon('heroicon-m-shopping-bag')
                ->color('success')
                ->chart([7, 3, 4, 5, 6, 3, 5, 3])
                ->extraAttributes([
                    'class' => 'bg-gradient-to-br from-emerald-500 to-emerald-700',
                ]),
                
            Stat::make('Active Products', $totalProducts)
                ->description('Products in stock')
                ->descriptionIcon('heroicon-m-cube')
                ->color('success')
                ->chart([7, 3, 4, 5, 6, 3, 5, 3])
                ->extraAttributes([
                    'class' => 'bg-gradient-to-br from-emerald-500 to-emerald-700',
                ]),
                
            Stat::make('Total Users', $totalUsers)
                ->description('Registered customers')
                ->descriptionIcon('heroicon-m-users')
                ->color('success')
                ->chart([7, 3, 4, 5, 6, 3, 5, 3])
                ->extraAttributes([
                    'class' => 'bg-gradient-to-br from-emerald-500 to-emerald-700',
                ]),
        ];
    }
}
