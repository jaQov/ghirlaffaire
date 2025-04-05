<?php

namespace App\Filament\Resources\OrderResource\Pages;

use App\Filament\Resources\OrderResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Resources\Pages\ListRecords\Tab;
use Illuminate\Database\Eloquent\Builder;

class ListOrders extends ListRecords
{
    protected static string $resource = OrderResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    public function getTabs(): array
    {
        return [
            'all' => Tab::make()
                ->label('') // hide default label
                ->badge(fn(): string => '📦 All (' . $this->getRecordCount() . ')')
                ->badgeColor('gray'),

            'pending' => Tab::make()
                ->label('')
                ->query(fn(Builder $query) => $query->where('status', 'Pending'))
                ->badge(fn() => '⏳ Pending (' . $this->getStatusCount('Pending') . ')')
                ->badgeColor('warning'),

            'canceled' => Tab::make()
                ->label('')
                ->query(fn(Builder $query) => $query->where('status', 'Canceled'))
                ->badge(fn() => '❌ Canceled (' . $this->getStatusCount('Canceled') . ')')
                ->badgeColor('danger'),

            'confirmed' => Tab::make()
                ->label('')
                ->query(fn(Builder $query) => $query->where('status', 'Confirmed'))
                ->badge(fn() => '✅ Confirmed (' . $this->getStatusCount('Confirmed') . ')')
                ->badgeColor('success'),

            'shipped' => Tab::make()
                ->label('')
                ->query(fn(Builder $query) => $query->where('status', 'Shipped'))
                ->badge(fn() => '🚚 Shipped (' . $this->getStatusCount('Shipped') . ')')
                ->badgeColor('info'),

            'delivered' => Tab::make()
                ->label('')
                ->query(fn(Builder $query) => $query->where('status', 'Delivered'))
                ->badge(fn() => '📬 Delivered (' . $this->getStatusCount('Delivered') . ')')
                ->badgeColor('success'),

            'returned' => Tab::make()
                ->label('')
                ->query(fn(Builder $query) => $query->where('status', 'Returned'))
                ->badge(fn() => '↩️ Returned (' . $this->getStatusCount('Returned') . ')')
                ->badgeColor('danger'),
        ];
    }

    /**
     * Get the count of all records.
     */
    protected function getRecordCount(): int
    {
        return static::getModel()::count();
    }

    /**
     * Get the count of records with a specific status.
     */
    protected function getStatusCount(string $status): int
    {
        return static::getModel()::where('status', $status)->count();
    }
}
