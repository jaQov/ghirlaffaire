<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OrderResource\Pages;
use App\Models\Order;
use App\Models\Client;
use App\Models\Product;
use App\Models\Commune;
use App\Models\Wilaya;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Section;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Resources\Resource;
use Filament\Forms\Components\Textarea;

class OrderResource extends Resource
{
    protected static ?string $model = Order::class;
    protected static ?string $navigationIcon = 'heroicon-o-shopping-cart';

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form->schema([
            // Select Wilaya
            Select::make('wilaya_id')
                ->label('Wilaya')
                ->options(Wilaya::pluck('wilaya_name_fr', 'wilaya_code'))
                ->reactive() // Enables dynamic updates
                ->afterStateUpdated(fn($state, callable $set) => $set('commune_id', null)) // Reset commune when wilaya changes
                ->required(),

            // Select Commune (filtered dynamically)
            Select::make('commune_id')
                ->label('Commune')
                ->options(fn(callable $get) => Commune::where('wilaya_code', $get('wilaya_id'))->pluck('commune_name_fr', 'id'))
                ->reactive()
                ->required(),

            // Select Client
            Select::make('client_id')
                ->label('Client')
                ->relationship(name: 'client', titleAttribute: 'name')
                ->required()
                ->createOptionForm([
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
                ]),

            // Select Product
            Select::make('product_id')
                ->label('Product')
                ->relationship(name: 'product', titleAttribute: 'title')
                ->required(),

            // Quantity
            TextInput::make('quantity')
                ->numeric()
                ->default(1)
                ->minValue(1)
                ->required(),

            // Delivery Method
            Select::make('delivery_method')
                ->label('Delivery Method')
                ->options([
                    'Door' => 'Door',
                    'StopDesk' => 'StopDesk',
                ])
                ->required(),
        ]);
    }

    public static function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->columns([
                TextColumn::make('created_at')
                    ,

                TextColumn::make('id')
                    ->sortable(),

                TextColumn::make('client.name')
                    ->label('Client')
                    ->searchable(),

                TextColumn::make('product.title')
                    ->label('Product')
                    ->searchable(),

                TextColumn::make('commune.commune_name_fr')
                    ->label('Commune')
                    ->sortable(),

                TextColumn::make('quantity')
                    ->sortable(),

                BadgeColumn::make('delivery_method')
                    ->colors([
                        'success' => fn($state) => $state === 'Door',
                        'info' => fn($state) => $state === 'StopDesk',
                    ]),

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
            OrderResource\RelationManagers\ClientsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListOrders::route('/'),
            'create' => Pages\CreateOrder::route('/create'),
            'edit' => Pages\EditOrder::route('/{record}/edit'),
        ];
    }
}
