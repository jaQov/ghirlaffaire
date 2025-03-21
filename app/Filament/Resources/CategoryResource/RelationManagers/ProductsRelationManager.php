<?php

namespace App\Filament\Resources\CateoryRecourceResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\DeleteAction;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\TagsInput;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Forms\Components\Section;
use PhpParser\Node\Expr\Cast\String_;

class ProductsRelationManager extends RelationManager
{
    protected static string $relationship = 'products';

    public function form(Form $form): Form
    {
        return $form->schema([

            Section::make('Product Info')
                ->schema([

                    TextInput::make('title')
                        ->required()
                        ->maxLength(255)
                        ->columnSpanFull()
                        ->live(onBlur: true),


                    TextInput::make('price')
                        ->numeric()
                        ->required(),

                    TextInput::make('compare_at_price')
                        ->numeric()
                        ->nullable(),

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
                            ->separator(',') // Use a comma to separate tags
                            ->reorderable()
                            ->color('info'),

                        TextInput::make('slug')
                            ->label('Custom Slug')
                            ->helperText('Leave empty to auto-generate from title')
                            ->unique(ignoreRecord: true)
                            ->required(),

                    ])->columnSpan(1)->columns(1),

            ]),

        ])->columns(3);
    }

    public function table(Table $table): Table
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
                ->suffix(' DZD')
                    ->sortable()
                    ->toggleable()
                    ->searchable(),

                TextColumn::make('inventory')
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
            ->headerActions([
                Tables\Actions\AttachAction::make()
                    ->preloadRecordSelect()
                    ->recordTitleAttribute('title')
                    ->multiple()
                    ->attachAnother(false),
            ])

            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DetachAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DetachBulkAction::make(),
                ]),
            ]);
    }
}
