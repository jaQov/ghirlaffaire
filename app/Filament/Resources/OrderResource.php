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
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\SelectColumn;
use Filament\Tables\Columns\TextInputColumn;

class OrderResource extends Resource
{
    protected static ?string $model = Order::class;
    protected static ?string $navigationIcon = 'heroicon-o-shopping-cart';

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form->schema([
            // Select Wilaya
            Select::make('commune.wilaya.wilaya_code')
                ->label('Wilaya')
                ->options(Wilaya::pluck('wilaya_name_fr', 'wilaya_code'))
                ->reactive() // Enables dynamic updates
                ->afterStateUpdated(fn($state, callable $set) => $set('commune_id', null)) // Reset commune when wilaya changes
                ->required(),

            // Select Commune (filtered dynamically)
            Select::make('commune_id')
                ->label('Commune')
                ->options(fn(callable $get) => Commune::where('wilaya_code', $get('wilaya_id') ?? '')->pluck('commune_name_fr', 'id'))
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
                    ->dateTime('d.m.y | H:i')
                    ->label('Created At')
                    ->sortable()
                    ->toggleable()
                    ->alignCenter(),

                TextColumn::make('id')
                    ->label('Order ID')
                    ->copyable()
                    ->sortable()
                    ->toggleable()
                    ->searchable()
                    ->formatStateUsing(fn($state) => '#C' . str_pad($state, 4, '0', STR_PAD_LEFT))
                    ->alignCenter(),

                TextColumn::make('client.name')
                    ->label('Name')
                    ->url(fn($record) => $record->client_id ? route('filament.admin.resources.clients.edit', ['record' => $record->client_id]) : null)
                    ->openUrlInNewTab()
                    ->sortable()
                    ->toggleable()
                    ->searchable()
                    ->alignCenter(),

                TextColumn::make('client.phone')
                    ->label('Phone')
                    ->copyable()
                    ->sortable()
                    ->toggleable()
                    ->searchable()
                    ->alignCenter(),

                TextColumn::make('commune.wilaya.wilaya_code')
                    ->getStateUsing(fn($record) => $record->commune?->wilaya?->wilaya_code ?? '')
                    ->label('Wilaya Code')
                    ->sortable()
                    ->toggleable()
                    ->badge()
                    ->searchable()
                    ->alignCenter(),

                TextColumn::make('commune.wilaya.wilaya_name_fr')
                    ->getStateUsing(fn($record) => $record->commune?->wilaya?->wilaya_name_fr ?? '')
                    ->label('Wilaya')
                    ->sortable()
                    ->toggleable()
                    ->searchable()
                    ->alignCenter(),

                TextColumn::make('commune.commune_name_fr')
                    ->label('Commune')
                    ->sortable()
                    ->toggleable()
                    ->searchable()
                    ->alignCenter(),

                TextColumn::make('product.title')
                    ->label('Product')
                    ->url(fn($record) => $record->product_id ? route('filament.admin.resources.products.edit', ['record' => $record->product_id]) : null)
                    ->openUrlInNewTab()
                    ->sortable()
                    ->toggleable()
                    ->searchable()
                    ->alignCenter(),

                TextColumn::make('quantity')
                    ->label('Quantity')
                    ->sortable()
                    ->toggleable()
                    ->searchable()
                    ->alignCenter(),

                TextColumn::make('ip_address')
                    ->label('IP Address')
                    ->copyable()
                    ->sortable()
                    ->toggleable()
                    ->searchable()
                    ->alignCenter(),

                TextInputColumn::make('note')
                    ->label('Note')
                    ->placeholder('Add a note here')
                    ->searchable()
                    ->toggleable()
                    ->alignCenter(),

                TextColumn::make('delivery_method')
                    ->badge()
                    ->colors([
                        'success' => fn($state) => $state === 'Door',
                        'info' => fn($state) => $state === 'StopDesk',
                    ])
                    ->alignCenter(),

                TextColumn::make('product.price')
                    ->label('Product Price')
                    ->sortable()
                    ->toggleable()
                    ->searchable()
                    ->formatStateUsing(fn($state) => $state . ' DA')
                    ->alignCenter(),

                TextColumn::make('delivery_price')
                    ->label('Delivery Price')
                    ->formatStateUsing(fn($state) => $state ? $state . ' DA' : 'N/A')
                    ->sortable()
                    ->getStateUsing(fn($record) => $record->calculateDeliveryPrice() ?? 0)
                    ->alignCenter(),

                TextColumn::make('total_price')
                    ->label('Total Price')
                    ->formatStateUsing(fn($state) => $state . ' DA')
                    ->sortable()
                    ->alignCenter(),

                IconColumn::make('status_icon')
                    ->label('')
                    ->state(fn($record) => $record->status ?? 'Unknown')
                    ->icon(fn(?string $state): string => match ($state) {
                        'Pending'   => 'heroicon-o-clock',
                        'Confirmed' => 'heroicon-o-check-circle',
                        'Canceled'  => 'heroicon-o-x-circle',
                        'Shipped'   => 'heroicon-o-truck',
                        'Delivered' => 'heroicon-o-cube',
                        'Returned'  => 'heroicon-o-arrow-uturn-left',
                        default     => 'heroicon-o-question-mark-circle',
                    })
                    ->color(fn(?string $state): string => match ($state) {
                        'Pending'   => 'warning',
                        'Confirmed' => 'success',
                        'Canceled'  => 'danger',
                        'Shipped'   => 'info',
                        'Delivered' => 'success',
                        'Returned'  => 'danger',
                        default     => 'gray',
                    })
                    ->tooltip(fn(?string $state): string => $state ?? 'Unknown')
                    ->toggleable()
                    ->alignCenter(),

                SelectColumn::make('status')
                    ->label('Status')
                    ->options([
                        'Pending' => '⏳ Pending',
                        'Confirmed' => '✅ Confirmed',
                        'Canceled' => '❌ Canceled',
                        'Shipped' => '🚚 Shipped',
                        'Delivered' => '📬 Delivered',
                        'Returned' => '↩️ Returned',
                    ])
                    ->sortable()
                    ->toggleable()
                    ->searchable()
                    ->alignCenter(),
            ])
            ->filters([])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->defaultSort('created_at', 'desc');
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
