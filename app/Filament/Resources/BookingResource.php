<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BookingResource\Pages;
use App\Filament\Resources\BookingResource\RelationManagers;
use App\Models\Booking;
use App\Models\Pemesanan;
use Filament\Forms;
use Filament\Forms\Components\Actions\Modal\Actions\Action;
use Filament\Forms\Components\Field;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\SelectColumn;
use Filament\Tables\Columns\TextInputColumn;
use Filament\Tables\Contracts\HasTable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class BookingResource extends Resource
{
    protected static ?string $model = Pemesanan::class;

    protected static ?string $navigationIcon = 'heroicon-o-book-open';

    protected static ?int $navigationSort = 1;

    protected static function getNavigationLabel(): string
    {
        return "Booking";
    }

    public static function getPluralLabel(): string
    {
        return "Booking";
    }

    protected static ?string $navigationGroup = 'Order Management';

    protected static ?string $slug = 'order/books';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
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
                Tables\Columns\TextColumn::make('nomor_pemesanan')
                    ->searchable()
                    ->label('NP'),
                Tables\Columns\TextColumn::make('user.name')
                    ->searchable()
                    ->label('Name'),
                Tables\Columns\TextColumn::make('paket.jenis')
                    ->searchable()
                    ->label('Package'),
                Tables\Columns\TextColumn::make('address')
                    ->searchable()
                    ->label('Address'),
                Tables\Columns\TextColumn::make('total_price')
                    ->searchable()
                    ->label('SubTotal'),
                Tables\Columns\TextColumn::make('batas.tanggal_mulai')
                    ->searchable()
                    ->label('Mulai'),
                Tables\Columns\TextColumn::make('batas.tanggal_selesai')
                    ->searchable()
                    ->label('Selesai'),
                Tables\Columns\TextColumn::make('tipe_pickup')
                    ->searchable()
                    ->label('Pickup Type'),
                TextInputColumn::make('harga_kurir')
                    ->label('Harga Kirim/Jemput')
                    ->disabled(fn($record) => $record->tipe_pickup == 'mandiri'),
                Tables\Columns\TextColumn::make('pembayaran.total')
                    ->searchable()
                    ->label('Total'),
                Tables\Columns\ImageColumn::make('pembayaran.bukti_pembayaran')
                    ->searchable()
                    ->label('Payment Proof'),
                SelectColumn::make('status')
                    ->options([
                        'waiting' => 'Waiting',
                        'process' => 'Process',
                        'pending' => 'Pending',
                        'finished' => 'Finished',
                        'cancelled' => 'Cancelled',
                    ]),
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                // Action::make('Invoice')
                //     ->icon('heroicon-o-doument-download')
                //     ->url(fn (Pemesanan $record) => \route('pemesanan.invoice', $record))
                //     ->openUrlInNewTab(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
                Tables\Actions\ForceDeleteBulkAction::make(),
                Tables\Actions\RestoreBulkAction::make(),
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
            'index' => Pages\ListBookings::route('/'),
            'create' => Pages\CreateBooking::route('/create'),
            'view' => Pages\ViewBooking::route('/{record}'),
            'edit' => Pages\EditBooking::route('/{record}/edit'),
        ];
    }    
    
    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->orderByRaw("CASE WHEN status = 'waiting' THEN 1 
                WHEN status = 'process' THEN 2 
                WHEN status = 'pending' THEN 3 
                WHEN status = 'finished' THEN 4
                ELSE 5 END")
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
