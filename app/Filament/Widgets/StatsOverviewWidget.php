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
            Stat::make('Total Revenue', '€' . number_format($totalRevenue, 2))
                ->description('All time revenue')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('success'),
            
            Stat::make('Total Orders', Order::count())
                ->description($todayOrders . ' orders today')
                ->descriptionIcon('heroicon-m-shopping-bag')
                ->color('info'),
            
            Stat::make('Total Products', Product::count())
                ->description(Product::where('stock', '>', 0)->count() . ' in stock')
                ->descriptionIcon('heroicon-m-cube')
                ->color('warning'),
            
            Stat::make('Total Customers', User::count())
                ->description('Registered users')
                ->descriptionIcon('heroicon-m-users')
                ->color('primary'),
        ];
    }
}
