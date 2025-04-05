<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ClientResource\Pages;
use App\Models\Client;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Section;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Resources\Resource;
use Filament\Tables\Columns\TextInputColumn;

class ClientResource extends Resource
{
    protected static ?string $model = Client::class;
    protected static ?string $navigationIcon = 'heroicon-o-users';

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form
            ->schema([
                Section::make('Client Information')
                    ->schema([
                        TextInput::make('name')
                            ->required()
                            ->maxLength(255),

                        TextInput::make('phone')
                            ->required()
                            ->tel()
                            ->maxLength(10)
                            ->unique(ignoreRecord: true)
                            ->numeric(),

                        Textarea::make('note')
                            ->maxLength(500),
                    ]),
            ]);
    }

    public static function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->columns([
                TextColumn::make('created_at')
                    ->dateTime('d.m.y | H:i') // Format updated
                    ->label('Created At')
                    ->sortable()
                    ->toggleable(),

                TextColumn::make('name')->searchable()
                    ->sortable()
                    ->toggleable(),

                TextColumn::make('phone')->searchable()
                    ->copyable()
                    ->sortable()
                    ->toggleable(),

                TextColumn::make('total_orders')
                    ->badge()
                    ->colors([
                        'success' => fn($state) => $state === 1, // Green for 1 order
                        'primary' => fn($state) => $state >= 2 && $state <= 3, // Blue for 2-3 orders
                        'warning' => fn($state) => $state >= 4, // Custom color (e.g., yellow) for 4+ orders
                    ])
                    ->sortable(),

                TextColumn::make('amount_spent')
                    ->sortable()
                    ->formatStateUsing(fn($state) => $state . ' DZD'),

                TextColumn::make('ip_address')->copyable(),

                TextInputColumn::make('note')
                    ->label('Note')
                    ->placeholder('Add a note here')
                    ->searchable()
                    ->toggleable(),
            ])
            ->filters([])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            ClientResource\RelationManagers\OrdersRelationManager::class, // Show orders inside Client details
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListClients::route('/'),
            'create' => Pages\CreateClient::route('/create'),
            'edit' => Pages\EditClient::route('/{record}/edit'),
        ];
    }
}
