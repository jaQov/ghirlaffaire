<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ContactResource\Pages;
use App\Filament\Resources\ContactResource\RelationManagers;
use App\Models\Contact;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ContactResource extends Resource
{
    protected static ?string $model = Contact::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // Name field input
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255)
                    ->label('Name'),
                // Email field input
                Forms\Components\TextInput::make('email')
                    ->required()
                    ->email()
                    ->maxLength(255)
                    ->label('Email'),
                // Phone number input (optional)
                Forms\Components\TextInput::make('phone')
                    ->maxLength(20)
                    ->label('Phone Number'),
                // Message textarea input
                Forms\Components\Textarea::make('message')
                    ->required()
                    ->label('Message'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                // Display the contact's name
                Tables\Columns\TextColumn::make('name')
                    ->label('Name')
                    ->searchable()
                    ->sortable(),
                // Display the contact's email
                Tables\Columns\TextColumn::make('email')
                    ->label('Email')
                    ->searchable()
                    ->sortable(),
                // Display the contact's phone number
                Tables\Columns\TextColumn::make('phone')
                    ->label('Phone Number')
                    ->searchable(),
                // Display a truncated version of the message
                Tables\Columns\TextColumn::make('message')
                    ->label('Message')
                    ->limit(50),
                // Display when the message was received
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime('M d, Y')
                    ->label('Received At')
                    ->sortable(),
            ])
            ->filters([
                // You can add filters here if needed
            ])
            ->actions([
                Tables\Actions\EditAction::make(), // Allow editing of contacts
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(), // Allow bulk deletion
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
            'index' => Pages\ListContacts::route('/'),
            'create' => Pages\CreateContact::route('/create'),
            'edit' => Pages\EditContact::route('/{record}/edit'),
        ];
    }
}
