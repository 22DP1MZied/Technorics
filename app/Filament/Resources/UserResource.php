<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Hash;

class UserResource extends Resource
{
    protected static ?string $model = User::class;
    protected static ?string $navigationIcon = 'heroicon-o-users';
    protected static ?string $navigationLabel = 'Lietotāji';
    protected static ?string $navigationGroup = 'Lietotāju pārvaldība';
    protected static ?string $modelLabel = 'Lietotājs';
    protected static ?string $pluralModelLabel = 'Lietotāji';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('name')->label('Vārds')->required()->maxLength(255),
            Forms\Components\TextInput::make('email')->label('E-pasts')->email()->required()->maxLength(255)->unique(ignoreRecord: true),
            Forms\Components\TextInput::make('password')->label('Parole')->password()->dehydrateStateUsing(fn ($state) => Hash::make($state))->dehydrated(fn ($state) => filled($state))->required(fn (string $context): bool => $context === 'create')->maxLength(255),
            Forms\Components\DateTimePicker::make('email_verified_at')->label('E-pasts apstiprināts'),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            Tables\Columns\TextColumn::make('name')->label('Vārds')->searchable()->sortable(),
            Tables\Columns\TextColumn::make('email')->label('E-pasts')->searchable()->sortable(),
            Tables\Columns\IconColumn::make('email_verified_at')->label('Apstiprināts')->boolean(),
            Tables\Columns\TextColumn::make('orders_count')->counts('orders')->label('Pasūtījumi'),
            Tables\Columns\TextColumn::make('created_at')->label('Reģistrēts')->dateTime()->sortable(),
        ])->filters([])->actions([Tables\Actions\EditAction::make(), Tables\Actions\DeleteAction::make()])->bulkActions([Tables\Actions\BulkActionGroup::make([Tables\Actions\DeleteBulkAction::make()])]);
    }

    public static function getRelations(): array { return []; }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
