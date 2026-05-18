<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OrderResource\Pages;
use App\Models\Order;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class OrderResource extends Resource
{
    protected static ?string $model = Order::class;
    protected static ?string $navigationIcon = 'heroicon-o-shopping-cart';
    protected static ?string $navigationLabel = 'Pasūtījumi';
    protected static ?string $navigationGroup = 'Veikals';
    protected static ?string $modelLabel = 'Pasūtījums';
    protected static ?string $pluralModelLabel = 'Pasūtījumi';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make('Pasūtījuma informācija')->schema([
                Forms\Components\TextInput::make('order_number')->label('Pasūtījuma numurs')->disabled(),
                Forms\Components\Select::make('user_id')->label('Klients')->relationship('user', 'name')->required()->searchable(),
                Forms\Components\Select::make('status')->label('Statuss')->options(['pending' => 'Gaida', 'processing' => 'Apstrādē', 'shipped' => 'Nosūtīts', 'delivered' => 'Piegādāts', 'cancelled' => 'Atcelts'])->required(),
                Forms\Components\Select::make('payment_status')->label('Maksājuma statuss')->options(['pending' => 'Gaida', 'paid' => 'Apmaksāts', 'failed' => 'Neizdevās'])->required(),
            ])->columns(2),
            Forms\Components\Section::make('Cenas')->schema([
                Forms\Components\TextInput::make('subtotal')->label('Starpsumma')->numeric()->prefix('€')->disabled(),
                Forms\Components\TextInput::make('tax')->label('PVN')->numeric()->prefix('€')->disabled(),
                Forms\Components\TextInput::make('shipping')->label('Piegāde')->numeric()->prefix('€')->disabled(),
                Forms\Components\TextInput::make('total')->label('Kopā')->numeric()->prefix('€')->disabled(),
            ])->columns(4),
            Forms\Components\Section::make('Piegādes informācija')->schema([
                Forms\Components\Textarea::make('shipping_address')->label('Piegādes adrese')->columnSpanFull(),
            ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            Tables\Columns\TextColumn::make('order_number')->label('Pasūtījums #')->searchable()->sortable(),
            Tables\Columns\TextColumn::make('user.name')->label('Klients')->searchable()->sortable(),
            Tables\Columns\TextColumn::make('total')->label('Kopā')->money('EUR')->sortable(),
            Tables\Columns\BadgeColumn::make('status')->label('Statuss')->formatStateUsing(fn (string $state): string => match ($state) {'pending' => 'Gaida', 'processing' => 'Apstrādē', 'shipped' => 'Nosūtīts', 'delivered' => 'Piegādāts', 'cancelled' => 'Atcelts', default => $state})->colors(['secondary' => 'pending', 'warning' => 'processing', 'primary' => 'shipped', 'success' => 'delivered', 'danger' => 'cancelled']),
            Tables\Columns\BadgeColumn::make('payment_status')->label('Maksājums')->formatStateUsing(fn (string $state): string => match ($state) {'pending' => 'Gaida', 'paid' => 'Apmaksāts', 'failed' => 'Neizdevās', default => $state})->colors(['warning' => 'pending', 'success' => 'paid', 'danger' => 'failed']),
            Tables\Columns\TextColumn::make('created_at')->label('Datums')->dateTime()->sortable(),
        ])->filters([
            Tables\Filters\SelectFilter::make('status')->label('Statuss')->options(['pending' => 'Gaida', 'processing' => 'Apstrādē', 'shipped' => 'Nosūtīts', 'delivered' => 'Piegādāts', 'cancelled' => 'Atcelts']),
            Tables\Filters\SelectFilter::make('payment_status')->label('Maksājuma statuss')->options(['pending' => 'Gaida', 'paid' => 'Apmaksāts', 'failed' => 'Neizdevās']),
        ])->actions([Tables\Actions\EditAction::make(), Tables\Actions\DeleteAction::make()])->bulkActions([Tables\Actions\BulkActionGroup::make([Tables\Actions\DeleteBulkAction::make()])])->defaultSort('created_at', 'desc');
    }

    public static function getRelations(): array { return []; }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListOrders::route('/'),
            'create' => Pages\CreateOrder::route('/create'),
            'edit' => Pages\EditOrder::route('/{record}/edit'),
        ];
    }
}
