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
                ->label(__('Estudiantes'))
                ->description(__('cantidad de estudiantes'))
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->chart([7, 2, 10, 3, 15, 4, 17])
                ->color('success'),
            Stat::make(label: __('Facturas'), value: Bill::count())
                ->description('Numero de facturas')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->chart([7, 2, 10, 3, 15, 4, 17])
                ->color('success'),
            Stat::make(label: 'Pagos', value: PaymentPlanData::count())
                ->description('Numero de pagos')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->chart([7, 2, 10, 3, 15, 4, 17])
                ->color('success'),
        ];
    }
}
