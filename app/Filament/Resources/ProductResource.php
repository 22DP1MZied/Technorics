<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Models\Product;
use App\Models\Category;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;
    protected static ?string $navigationIcon = 'heroicon-o-shopping-bag';
    protected static ?string $navigationLabel = 'Produkti';
    protected static ?string $navigationGroup = 'Veikals';
    protected static ?string $modelLabel = 'Produkts';
    protected static ?string $pluralModelLabel = 'Produkti';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make('Produkta informācija')->schema([
                Forms\Components\TextInput::make('name')->label('Nosaukums')->required()->maxLength(255)->live(onBlur: true)->afterStateUpdated(fn (string $operation, $state, Forms\Set $set) => $operation === 'create' ? $set('slug', Str::slug($state)) : null),
                Forms\Components\TextInput::make('slug')->label('Slug')->required()->maxLength(255)->unique(ignoreRecord: true),
                Forms\Components\Select::make('category_id')->label('Kategorija')->options(Category::pluck('name', 'id'))->required()->searchable(),
                Forms\Components\TextInput::make('brand')->label('Zīmols')->required()->maxLength(255),
                Forms\Components\Textarea::make('description')->label('Apraksts')->required()->maxLength(65535)->columnSpanFull(),
            ])->columns(2),
            Forms\Components\Section::make('Cenas')->schema([
                Forms\Components\TextInput::make('price')->label('Cena')->required()->numeric()->prefix('€')->maxValue(99999.99),
                Forms\Components\TextInput::make('discount_price')->label('Atlaides cena')->numeric()->prefix('€')->maxValue(99999.99)->nullable(),
            ])->columns(2),
            Forms\Components\Section::make('Krājumi')->schema([
                Forms\Components\TextInput::make('stock')->label('Daudzums')->required()->numeric()->default(0)->minValue(0),
                Forms\Components\Toggle::make('is_active')->label('Aktīvs')->default(true),
                Forms\Components\Toggle::make('is_featured')->label('Izceltais')->default(false),
            ])->columns(3),
            Forms\Components\Section::make('Attēli')->schema([
                Forms\Components\TextInput::make('image_url')->label('Galvenā attēla URL')->url()->required(),
                Forms\Components\Textarea::make('images')->label('Papildu attēli (JSON masīvs)')->helperText('Ievadiet kā JSON: ["url1", "url2"]')->columnSpanFull(),
            ]),
            Forms\Components\Section::make('Papildu informācija')->schema([
                Forms\Components\TextInput::make('rating')->label('Vērtējums')->numeric()->default(4.5)->minValue(0)->maxValue(5)->step(0.1),
                Forms\Components\TextInput::make('reviews_count')->label('Atsauksmju skaits')->numeric()->default(0)->minValue(0),
                Forms\Components\Textarea::make('specifications')->label('Specifikācijas (JSON)')->helperText('Ievadiet kā JSON: {"key": "value"}')->columnSpanFull(),
            ])->columns(2),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            Tables\Columns\ImageColumn::make('image_url')->label('Attēls')->square(),
            Tables\Columns\TextColumn::make('name')->label('Nosaukums')->searchable()->sortable(),
            Tables\Columns\TextColumn::make('category.name')->label('Kategorija')->sortable()->searchable(),
            Tables\Columns\TextColumn::make('brand')->label('Zīmols')->searchable()->sortable(),
            Tables\Columns\TextColumn::make('price')->label('Cena')->money('EUR')->sortable(),
            Tables\Columns\TextColumn::make('discount_price')->label('Atlaides cena')->money('EUR')->sortable(),
            Tables\Columns\TextColumn::make('stock')->label('Krājums')->sortable()->badge()->color(fn (int $state): string => match (true) {$state === 0 => 'danger', $state < 10 => 'warning', default => 'success'}),
            Tables\Columns\IconColumn::make('is_active')->label('Aktīvs')->boolean(),
            Tables\Columns\IconColumn::make('is_featured')->label('Izceltais')->boolean(),
            Tables\Columns\TextColumn::make('created_at')->label('Izveidots')->dateTime()->sortable()->toggleable(isToggledHiddenByDefault: true),
        ])->filters([
            Tables\Filters\SelectFilter::make('category')->label('Kategorija')->relationship('category', 'name'),
            Tables\Filters\TernaryFilter::make('is_active')->label('Aktīvs')->boolean()->trueLabel('Aktīvie produkti')->falseLabel('Neaktīvie produkti')->native(false),
            Tables\Filters\TernaryFilter::make('is_featured')->label('Izceltais')->boolean()->trueLabel('Izceltie produkti')->falseLabel('Nav izceltie')->native(false),
        ])->actions([Tables\Actions\EditAction::make(), Tables\Actions\DeleteAction::make()])->bulkActions([Tables\Actions\BulkActionGroup::make([Tables\Actions\DeleteBulkAction::make()])]);
    }

    public static function getRelations(): array { return []; }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}
