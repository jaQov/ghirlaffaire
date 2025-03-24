<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DeliveryRecourceResource\RelationManagers\DeliveryPricesRelationManager;
use App\Filament\Resources\DeliveryResource\Pages;
use App\Filament\Resources\DeliveryResource\RelationManagers;
use App\Models\Delivery;
use App\Models\DeliveryCompany;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Illuminate\Support\Str;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Columns\TextColumn;

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
                    ->columnSpanFull()
                    ->live(onBlur: true)
                    ->afterStateUpdated(function (?string $operation, ?string $state, Set $set) {
                        $set('slug', Str::slug($state));
                    }),

                FileUpload::make('image_url')
                    ->label('Image')
                    ->image()
                    ->nullable()
                    ->directory('delivery'),

                TextInput::make('slug')
                    ->label('Custom Slug')
                    ->helperText('Leave empty to auto-generate from title')
                    ->unique(ignoreRecord: true)
                    ->required(),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([

                TextColumn::make('name')
                    ->sortable()
                    ->toggleable()
                    ->searchable(),

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
