<?php

namespace App\Filament\Resources\OrderResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;

class ClientsRelationManager extends RelationManager
{
    protected static string $relationship = 'client';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('full_name')
                    ->required()
                    ->maxLength(255),

                TextInput::make('phone')
                    ->tel()
                    ->unique(ignoreRecord: true)
                    ->required(),

                TextInput::make('ip_address')
                    ->disabled(),

                TextInput::make('total_orders')
                    ->numeric()
                    ->default(0)
                    ->disabled(),

                TextInput::make('amount_spent')
                    ->numeric()
                    ->default(0)
                    ->disabled(),

                Textarea::make('note')
                    ->rows(3),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->label('Client ID')
                    ->sortable(),
                TextColumn::make('name')
                    ->label('Full Name')
                    ->sortable(),
                TextColumn::make('phone')
                    ->label('Phone')->sortable(),
                TextColumn::make(
                    'total_orders'
                )->label('Orders Count')
                    ->sortable(),
                TextColumn::make('amount_spent')
                    ->label('Total Spent')
                    ->money('DZD')
                    ->sortable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable(),
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
