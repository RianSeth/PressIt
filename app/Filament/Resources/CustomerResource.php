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
use Filament\Tables\Columns\Layout\Panel;
use Filament\Tables\Columns\TextInputColumn;
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
                                    ->unique()
                                    ->required()
                                    ->label('Email'),
                                Forms\Components\TextInput::make('password')
                                    ->password()
                                    ->confirmed()
                                    ->rules(['required', 'min:8'])
                                    ->required()
                                    ->label('Password'),
                                Forms\Components\TextInput::make('password_confirmation')
                                    ->password(),
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
                TextInputColumn::make('name')
                    ->searchable()
                    ->disabled(fn($record) => $record->status != 'approved')
                    ->label('Name'),
                Tables\Columns\TextColumn::make('email')
                    ->searchable()
                    ->formatStateUsing(function ($state) {
                        return self::maskEmail($state);
                    })
                    ->label('Email'),
                TextInputColumn::make('address_user.telp')
                    ->searchable()
                    ->rules(['numeric','digits_between:1,13'])
                    ->disabled(fn($record) => $record->status != 'approved')
                    ->label('Telephone'),
                TextInputColumn::make('address_user.address')
                    ->disabled(fn($record) => $record->status != 'approved')
                    ->label('Detail Address'),
                Tables\Columns\TextColumn::make('status')
                    ->searchable()
                    ->label('Status'),
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\Action::make('Edit')
                    ->disabled(fn($record) => $record->status == 'confirm' || $record->status == 'approved')
                    ->action(function (User $record) {
                        $record->update(['status' => 'confirm']);
                        return back();
                    })
                    ->requiresConfirmation()
                    ->hidden(fn($record) => $record->status == 'confirm' || $record->status == 'approved'),
                Tables\Actions\Action::make('Finish')
                    ->disabled(fn($record) => $record->status != 'approved')
                    ->action(function (User $record) {
                        $record->update(['status' => 'active']);
                        return back();
                    })
                    ->requiresConfirmation()
                    ->visible(fn($record) => $record->status == 'confirm' || $record->status == 'approved'),
                Tables\Actions\Action::make('Banned')
                    ->disabled(fn($record) => $record->status == 'banned')
                    // ->disabled(fn($record) => $record->status != 'waiting' || $record->pembayaran->bukti_pembayaran)
                    ->action(function (User $record) {
                        $record->update(['status' => 'banned']);
                        return back();
                    })
                    ->requiresConfirmation()
                    ->hidden(fn($record) => $record->status == 'banned'),
                Tables\Actions\Action::make('Pulih')
                    ->disabled(fn($record) => $record->status != 'banned')
                    ->action(function (User $record) {
                        $record->update(['status' => 'active']);
                        return back();
                    })
                    ->requiresConfirmation()
                    ->visible(fn($record) => $record->status == 'banned'),
                Tables\Actions\Action::make('Reset')
                    ->disabled(fn($record) => $record->status == 'banned')
                    ->action(function (User $record) {
                        $hashedPassword = Hash::make('12345678');
                        $record->update(['password' => $hashedPassword]);
                        return back();
                    })
                    ->requiresConfirmation(),
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

    protected static function maskEmail($email)
    {
        // Pisahkan bagian lokal dan domain dari email
        list($local, $domain) = explode('@', $email);

        // Buat bagian lokal dengan 3 karakter pertama diikuti oleh asterisks
        $maskedLocal = substr($local, 0, 3) . str_repeat('*', strlen($local) - 3);

        // Ambil top-level domain
        $domainParts = explode('.', $domain);
        $tld = end($domainParts); // Mengambil TLD terakhir

        // Masking domain name kecuali TLD
        $maskedDomain = str_repeat('*', strlen($domainParts[0]));

        return $maskedLocal . '@' . $maskedDomain . '.' . $tld;
    }
}
