<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PackageResource\Pages;
use App\Filament\Resources\PackageResource\RelationManagers;
use App\Models\Package;
use App\Models\Paket;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\Layout\Panel;
use Filament\Tables\Columns\Layout\Split;
use Filament\Tables\Filters\TrashedFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PackageResource extends Resource
{
    protected static ?string $model = Paket::class;

    protected static ?string $navigationIcon = 'heroicon-o-archive';

    protected static ?string $navigationGroup = 'Product Management';

    protected static ?string $slug = 'product/package';

    protected static ?int $navigationSort = 1;

    protected static function getNavigationLabel(): string
    {
        return "Package";
    }

    public static function getPluralLabel(): string
    {
        return "Packages";
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Data Package')
                    ->schema([
                        Forms\Components\TextInput::make('jenis')
                            ->required()
                            ->label('Package'),
                        Forms\Components\TextInput::make('harga')
                            ->numeric()
                            ->required()
                            ->label('Price'),
                        Forms\Components\TextInput::make('satuan_harga')
                            ->required()
                            ->label('Satuan Harga'),
                    ]),
                Section::make('Description')
                    ->schema([
                        Forms\Components\Textarea::make('deskripsi')
                            ->required(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->contentGrid([
                'md' => 2,
                'xl' => 3,
            ])
            ->columns([
                Tables\Columns\TextColumn::make('jenis')
                    ->searchable()
                    ->sortable()
                    ->label('Paket'),
                Split::make([
                    Tables\Columns\TextColumn::make('Rp')
                        ->default('Rp')
                        ->grow(false),
                    Tables\Columns\TextColumn::make('harga')
                        ->searchable()
                        ->sortable()
                        ->label('Harga')
                        ->grow(false),
                    Tables\Columns\TextColumn::make('/')
                        ->default('/')
                        ->grow(false),
                    Tables\Columns\TextColumn::make('satuan_harga')
                        ->searchable()
                        ->sortable()
                        ->label('/Satuan'),
                ]),
                Panel::make([
                    Tables\Columns\TextColumn::make('deskripsi')
                        ->toggleable(isToggledHiddenByDefault: true)
                        ->wrap()
                        ->limit(200)
                        ->label('Ket.'),
                ])->collapsible(),
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make()
                    ->disabled(function($record) {
                        $statuses = $record->pemesanan()->pluck('status')->toArray();
                        return (in_array('waiting', $statuses) || in_array('process', $statuses) || in_array('pickup', $statuses));
                    }),
                Tables\Actions\DeleteAction::make()
                    ->disabled(function($record) {
                        $statuses = $record->pemesanan()->pluck('status')->toArray();
                        return (in_array('waiting', $statuses) || in_array('process', $statuses) || in_array('pickup', $statuses));
                    }),
                Tables\Actions\ForceDeleteAction::make(),
                Tables\Actions\RestoreAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
                Tables\Actions\ForceDeleteBulkAction::make(),
                Tables\Actions\RestoreBulkAction::make(),
            ]);
    }
    
    public static function getPages(): array
    {
        return [
            'index' => Pages\ManagePackages::route('/'),
        ];
    }    
}
