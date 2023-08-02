<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CustomerResource\Pages;
use App\Filament\Resources\CustomerResource\RelationManagers;
use App\Models\Customer;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Pages\Page;
use Filament\Resources\Form;
use Filament\Resources\Pages\CreateRecord;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Filters\TrashedFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Hash;

class CustomerResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-shopping-bag';

    protected static ?int $navigationSort = 2;

    protected static function getNavigationLabel(): string
    {
        return "Customer";
    }

    public static function getPluralLabel(): string
    {
        return "Customers";
    }

    protected static ?string $navigationGroup = 'User Management';

    protected static ?string $slug = 'users/customers';

    public static function getFormDefaults(): array
    {
        return [
            'usertype' => 'customer',
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->where('usertype', 'customer')
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Data Customer')
                    ->schema([
                        Grid::make()
                            ->schema([
                                Forms\Components\TextInput::make('name')
                                    ->required()
                                    ->label('Name'),
                                Forms\Components\TextInput::make('email')
                                    ->email()
                                    ->required()
                                    ->label('Email'),
                                Forms\Components\TextInput::make('password')
                                    ->password()
                                    ->dehydrateStateUsing(fn ($state) => Hash::make($state))
                                    ->dehydrated(fn ($state) => filled($state))
                                    ->required(fn (Page $livewire) => ($livewire instanceof CreateRecord))
                                    ->label('Password'),
                                Forms\Components\TextInput::make('usertype')
                                    ->label('User-type')
                                    ->disabled()
                                    ->default('customer')
                                    ->required(),
                            ]),
                        Fieldset::make('Address User')
                            ->relationship('address_user')
                            ->schema([
                                Forms\Components\TextInput::make('telp')
                                    ->numeric()
                                    ->maxLength(13)
                                    ->required()
                                    ->label('Telephone'),
                                Forms\Components\Textarea::make('address')
                                    ->required()
                                    ->label('Address'),
                            ]),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('No')->getStateUsing(
                    static function ($rowLoop, HasTable $livewire): string {
                        return (string) ($rowLoop->iteration +
                            ($livewire->tableRecordsPerPage * ($livewire->page - 1
                            ))
                        );
                    }
                ),
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->label('Name'),
                Tables\Columns\TextColumn::make('email')
                    ->searchable()
                    ->label('Email'),
                Tables\Columns\TextColumn::make('address_user.telp')
                    ->searchable()
                    ->label('Telephone'),
                Tables\Columns\TextColumn::make('address_user.address')
                    ->limit(20)
                    ->wrap()
                    ->label('Detail Address'),
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
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
            'index' => Pages\ManageCustomers::route('/'),
        ];
    }    
}
