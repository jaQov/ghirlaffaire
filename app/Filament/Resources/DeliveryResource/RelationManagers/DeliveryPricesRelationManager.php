<?php

namespace App\Filament\Resources\DeliveryRecourceResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\TextInputColumn;
use Illuminate\Validation\Rules\Numeric;

class DeliveryPricesRelationManager extends RelationManager
{
    protected static string $relationship = 'DeliveryPrices';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('wilaya_code')
                    ->required()
                    ->maxLength(255),

                Forms\Components\TextInput::make('door')
                    ->required()
                    ->maxLength(255),

                Forms\Components\TextInput::make('stopdesk')
                    ->required()
                    ->maxLength(255),

                Forms\Components\TextInput::make('delivery_price')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('wilaya_code')
                    ->label('Wilaya Code')
                    ->numeric()
                    ->sortable()
                    ->badge()
                    ->searchable(),

                TextColumn::make('wilaya.wilaya_name_fr') // Access via Relationship
                    ->label('Wilaya (FR)')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('wilaya.wilaya_name_ar') // Access via Relationship
                    ->label('Wilaya (AR)')
                    ->sortable()
                    ->searchable(),

                TextInputColumn::make('door')
                    ->rules(['numeric'])
                    ->sortable(),

                TextInputColumn::make('stopdesk')
                    ->rules(['numeric'])
                    ->sortable(),

                TextInputColumn::make('delivery_time')
                    ->label('Delivery Time')
                    ->sortable()
                    ->searchable(),

            ])
            ->filters([
                //
            ])
            // ->headerActions([
            //     Tables\Actions\CreateAction::make(),
            // ])
            // ->actions([
            //     Tables\Actions\EditAction::make(),
            //     Tables\Actions\DeleteAction::make(),
            // ])
            // ->bulkActions([
            //     Tables\Actions\BulkActionGroup::make([
            //         Tables\Actions\DeleteBulkAction::make(),
            //     ]),
            // ]);
        ;
    }
}
