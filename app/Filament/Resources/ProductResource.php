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

    protected static ?string $navigationGroup = 'Shop';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Product Information')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->required()
                            ->maxLength(255)
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn (string $operation, $state, Forms\Set $set) => 
                                $operation === 'create' ? $set('slug', Str::slug($state)) : null
                            ),
                        
                        Forms\Components\TextInput::make('slug')
                            ->required()
                            ->maxLength(255)
                            ->unique(ignoreRecord: true),
                        
                        Forms\Components\Select::make('category_id')
                            ->label('Category')
                            ->options(Category::pluck('name', 'id'))
                            ->required()
                            ->searchable(),
                        
                        Forms\Components\TextInput::make('brand')
                            ->required()
                            ->maxLength(255),
                        
                        Forms\Components\Textarea::make('description')
                            ->required()
                            ->maxLength(65535)
                            ->columnSpanFull(),
                    ])->columns(2),

                Forms\Components\Section::make('Pricing')
                    ->schema([
                        Forms\Components\TextInput::make('price')
                            ->required()
                            ->numeric()
                            ->prefix('€')
                            ->maxValue(99999.99),
                        
                        Forms\Components\TextInput::make('discount_price')
                            ->numeric()
                            ->prefix('€')
                            ->maxValue(99999.99)
                            ->nullable(),
                    ])->columns(2),

                Forms\Components\Section::make('Inventory')
                    ->schema([
                        Forms\Components\TextInput::make('stock')
                            ->required()
                            ->numeric()
                            ->default(0)
                            ->minValue(0),
                        
                        Forms\Components\Toggle::make('is_active')
                            ->label('Active')
                            ->default(true),
                        
                        Forms\Components\Toggle::make('is_featured')
                            ->label('Featured')
                            ->default(false),
                    ])->columns(3),

                Forms\Components\Section::make('Media')
                    ->schema([
                        Forms\Components\TextInput::make('image_url')
                            ->label('Main Image URL')
                            ->url()
                            ->required(),
                        
                        Forms\Components\Textarea::make('images')
                            ->label('Additional Images (JSON array)')
                            ->helperText('Enter as JSON: ["url1", "url2"]')
                            ->columnSpanFull(),
                    ]),

                Forms\Components\Section::make('Additional Info')
                    ->schema([
                        Forms\Components\TextInput::make('rating')
                            ->numeric()
                            ->default(4.5)
                            ->minValue(0)
                            ->maxValue(5)
                            ->step(0.1),
                        
                        Forms\Components\TextInput::make('reviews_count')
                            ->numeric()
                            ->default(0)
                            ->minValue(0),
                        
                        Forms\Components\Textarea::make('specifications')
                            ->label('Specifications (JSON)')
                            ->helperText('Enter as JSON: {"key": "value"}')
                            ->columnSpanFull(),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image_url')
                    ->label('Image')
                    ->square(),
                
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable(),
                
                Tables\Columns\TextColumn::make('category.name')
                    ->sortable()
                    ->searchable(),
                
                Tables\Columns\TextColumn::make('brand')
                    ->searchable()
                    ->sortable(),
                
                Tables\Columns\TextColumn::make('price')
                    ->money('EUR')
                    ->sortable(),
                
                Tables\Columns\TextColumn::make('discount_price')
                    ->money('EUR')
                    ->sortable(),
                
                Tables\Columns\TextColumn::make('stock')
                    ->sortable()
                    ->badge()
                    ->color(fn (int $state): string => match (true) {
                        $state === 0 => 'danger',
                        $state < 10 => 'warning',
                        default => 'success',
                    }),
                
                Tables\Columns\IconColumn::make('is_active')
                    ->boolean(),
                
                Tables\Columns\IconColumn::make('is_featured')
                    ->boolean(),
                
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('category')
                    ->relationship('category', 'name'),
                
                Tables\Filters\TernaryFilter::make('is_active')
                    ->label('Active')
                    ->boolean()
                    ->trueLabel('Active products')
                    ->falseLabel('Inactive products')
                    ->native(false),
                
                Tables\Filters\TernaryFilter::make('is_featured')
                    ->label('Featured')
                    ->boolean()
                    ->trueLabel('Featured products')
                    ->falseLabel('Not featured')
                    ->native(false),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
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
