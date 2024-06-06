<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AdminResource\Pages;
use App\Filament\Resources\AdminResource\RelationManagers;
use App\Models\Admin;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\TextInput;
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

class AdminResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $slug = 'users/admins';

    protected static ?string $navigationIcon = 'heroicon-o-user';

    protected static ?string $navigationGroup = 'User Management';

    protected static ?int $navigationSort = 1;

    protected static function getNavigationLabel(): string
    {
        return "Admin";
    }

    public static function getPluralLabel(): string
    {
        return "Admins";
    }

    public static function getFormDefaults(): array
    {
        return [
            'usertype' => 'admin',
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->where('usertype', 'admin')
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->autofocus()
                    ->placeholder('Enter your name')
                    ->label('Name'),
                Forms\Components\TextInput::make('email')
                    ->email()
                    ->required()
                    ->unique()
                    ->placeholder('Enter your email')
                    ->label('Email'),
                Forms\Components\TextInput::make('password')
                    ->password()
                    ->confirmed()
                    ->rules(['required', 'min:8'])
                    ->required()
                    ->placeholder('Create a password')
                    ->label('Password'),
                Forms\Components\TextInput::make('password_confirmation')
                    ->password(),
                Forms\Components\TextInput::make('usertype')
                    ->label('User-type')
                    ->disabled()
                    ->default('admin')
                    ->required(),
                Fieldset::make('Address User')
                    ->relationship('address_user')
                    ->schema([
                        Forms\Components\TextInput::make('telp')
                            ->numeric()
                            ->required()
                            ->unique()
                            ->maxLength(13)
                            ->placeholder('Your phone number')
                            ->label('Telephone'),
                        Forms\Components\Textarea::make('address')
                            ->required()
                            ->placeholder('Tell your detail address')
                            ->label('Address'),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('No')->getStateUsing(
                    static function ($rowLoop, HasTable $livewire): string {
                        return (string) (
                            $rowLoop->iteration +
                            ($livewire->tableRecordsPerPage * (
                                $livewire->page - 1
                            ))
                        );
                    }
                ),
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable()
                    ->label('Name'),
                Tables\Columns\TextColumn::make('email')
                    ->searchable()
                    ->sortable()
                    ->label('Email'),
                Tables\Columns\TextColumn::make('address_user.telp')
                    ->searchable()
                    ->label('Telephone'),
            ])
            ->filters([
                TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }
    
    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageAdmins::route('/'),
        ];
    }
}
