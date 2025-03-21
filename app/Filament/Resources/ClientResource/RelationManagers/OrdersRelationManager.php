<?php

namespace App\Filament\Resources\ClientResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;

class OrdersRelationManager extends RelationManager
{
    protected static string $relationship = 'orders';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('product_id')
                    ->relationship('product', 'title')
                    ->required(),

                Select::make('commune_id')
                    ->relationship('commune', 'commune_name_fr')
                    ->searchable()
                    ->required(),

                Select::make('delivery_method')
                    ->options([
                        'Door' => 'Door',
                        'StopDesk' => 'Stop Desk',
                    ])
                    ->required(),

                TextInput::make('quantity')
                    ->numeric()
                    ->minValue(1)
                    ->default(1)
                    ->required(),

                TextInput::make('total_price')
                    ->numeric()
                    ->required(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                    ->label('Order ID')
                    ->sortable(),

                TextColumn::make('product.title')
                    ->label('Product')
                    ->sortable(),

                TextColumn::make('commune.commune_name_fr')
                    ->label('Commune')
                    ->sortable(),

                TextColumn::make('delivery_method')
                    ->sortable(),

                TextColumn::make('quantity')
                    ->sortable(),

                TextColumn::make('total_price')
                    ->money('DZD')->sortable(),

                TextColumn::make('created_at')
                    ->dateTime()->sortable(),
            ])


            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
