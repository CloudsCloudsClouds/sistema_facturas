<?php

namespace App\Filament\Pages;

use App\Models\Payment;
use App\Models\Student;
use Filament\Pages\Page;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Concerns\InteractsWithTable;

class PaymentHistory extends Page
{
    use InteractsWithTable;

    protected static ?string $navigationIcon = 'heroicon-o-user';
    protected static string $view = 'filament.pages.payment-history';
}
