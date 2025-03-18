<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Models\Product;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\DeleteAction;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\TagsInput;
use Illuminate\Support\Str;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Forms\Components\Section;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form->schema([

            Section::make('Product Info')
                ->schema([

                    TextInput::make('title')
                        ->required()
                        ->maxLength(255)
                        ->columnSpanFull(),

                    TextInput::make('price')
                        ->numeric()
                        ->required(),

                    TextInput::make('compare_at_price')
                        ->numeric()
                        ->nullable(),

                    Select::make('category')
                        ->options([
                            'electronics' => 'Electronics',
                            'fashion' => 'Fashion',
                            'home' => 'Home & Kitchen',
                        ])
                        ->searchable(),

                    TextInput::make('inventory')
                        ->numeric()
                        ->required(),

                    RichEditor::make('description')
                        ->required()
                        ->columnSpanFull(),

                ])->columnSpan(2)->columns(2),

            Group::make()->schema([

                Section::make('Media')
                    ->schema([

                        FileUpload::make('image_url')
                            ->label('Images')
                            ->image()
                            ->required()
                            ->directory('products'),

                    ])->columnSpan(1)->columns(1),

                Section::make('SEO')
                    ->schema([

                        TagsInput::make('tags')
                            ->placeholder('Add tags...')
                            ->suggestions(['smartphone', 'laptop', 'gaming', 'new']) // Optional suggestions
                            ->separator(','), // Use a comma to separate tags

                        TextInput::make('slug')
                            ->label('Custom Slug')
                            ->helperText('Leave empty to auto-generate from title')
                            ->default(fn($get) => $get('title') ? Str::slug($get('title')) : null)
                            ->dehydrated() // Ensures it saves to the database
                            ->unique(ignoreRecord: true),

                    ])->columnSpan(1)->columns(1),

            ]),

        ])->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([

                ImageColumn::make('image_url')
                    ->sortable()
                    ->toggleable()
                    ->searchable(),

                TextColumn::make('title')
                    ->sortable()
                    ->toggleable()
                    ->searchable(),

                TextColumn::make('price')
                    ->sortable()
                    ->toggleable()
                    ->searchable(),

                TextColumn::make('inventory')
                    ->sortable()
                    ->toggleable()
                    ->searchable(),

                TextColumn::make('category')
                    ->sortable()
                    ->toggleable()
                    ->searchable(),

                ToggleColumn::make('status')
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
                EditAction::make(),
                DeleteAction::make(),
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
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}
