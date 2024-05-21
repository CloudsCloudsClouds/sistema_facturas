<?php

namespace App\Filament\Widgets;

use App\Models\Bill;
use App\Models\PaymentPlanData;
use App\Models\Student;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Students', value: Student::count())
                ->label(__('Dashboard.Students'))
                ->description(__('Dashboard.StudentsDescription'))
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->chart([7, 2, 10, 3, 15, 4, 17])
                ->color('success'),
            Stat::make(label: __('Bills'), value: Bill::count())
                ->description('Number of bills emited this semester')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->chart([7, 2, 10, 3, 15, 4, 17])
                ->color('success'),
            Stat::make(label: 'Payments', value: PaymentPlanData::count())
                ->description('Number of things to pay')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->chart([7, 2, 10, 3, 15, 4, 17])
                ->color('success'),
        ];
    }
}
