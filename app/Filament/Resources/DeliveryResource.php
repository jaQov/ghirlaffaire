<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DeliveryRecourceResource\RelationManagers\DeliveryPricesRelationManager;
use App\Filament\Resources\DeliveryResource\Pages;
use App\Filament\Resources\DeliveryResource\RelationManagers;
use App\Models\Delivery;
use App\Models\DeliveryCompany;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;

class DeliveryResource extends Resource
{
    protected static ?string $model = DeliveryCompany::class;
    protected static ?string $navigationLabel = 'Companies';
    protected static ?string $navigationGroup = 'Delivery';
    protected static ?string $navigationParentItem = null;
    protected static ?string $activeNavigationIcon = null;
    protected static ?int $navigationSort = 1;


    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->required()
                    ->columnSpanFull(),

                FileUpload::make('image_url')
                    ->label('Image')
                    ->image()
                    ->nullable()
                    ->directory('delivery'),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([

                ImageColumn::make('image_url')
                    ->sortable()
                    ->toggleable()
                    ->searchable(),

                TextColumn::make('name')
                    ->sortable()
                    ->toggleable()
                    ->searchable(),

                TextColumn::make('delivery_time')
                    ->sortable()
                    ->toggleable()
                    ->searchable(),

                ToggleColumn::make('is_active')
                    ->sortable()
                    ->toggleable()
                    ->searchable()
                    ->label('Active')
                    ->onIcon('heroicon-o-check')
                    ->offIcon('heroicon-o-x-mark'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            DeliveryPricesRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListDeliveries::route('/'),
            'create' => Pages\CreateDelivery::route('/create'),
            'edit' => Pages\EditDelivery::route('/{record}/edit'),
        ];
    }
}
