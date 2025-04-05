<?php

namespace App\Filament\Resources\ProductResource\Pages;

use App\Filament\Resources\ProductResource;
use App\Models\Category;
use App\Models\Product;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Resources\Pages\ListRecords\Tab;
use Illuminate\Database\Eloquent\Builder;

class ListProducts extends ListRecords
{
    protected static string $resource = ProductResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    public function getTabs(): array
    {
        // Retrieve all categories
        $categories = Category::all();

        // "All" tab showing all products
        $tabs = [
            'all' => Tab::make('All')
                ->label('') // Hide the default label since we use a badge
                ->badge(fn(): string => 'All (' . Product::count() . ')')
                ->badgeColor('gray'),
        ];

        // Create a tab for each category
        foreach ($categories as $category) {
            $tabs[$category->slug] = Tab::make($category->name)
                ->label('') // Hide default label so only badge is shown
                ->query(
                    fn(Builder $query) =>
                    $query->whereHas(
                        'categories',
                        fn(Builder $q) =>
                        $q->where('id', $category->id)
                    )
                )
                ->badge(fn() => $category->name . ' (' . Product::whereHas(
                    'categories',
                    fn(Builder $q) =>
                    $q->where('id', $category->id)
                )->count() . ')')
                ->badgeColor('primary'); // You can adjust this or change per category if desired
        }

        return $tabs;
    }
}
