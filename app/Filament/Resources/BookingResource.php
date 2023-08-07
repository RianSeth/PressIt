<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BookingResource\Pages;
use App\Filament\Resources\BookingResource\RelationManagers;
use App\Models\Batas;
use App\Models\Booking;
use App\Models\Paket;
use App\Models\Pemesanan;
use App\Models\User;
use Closure;
use Filament\Forms;
use Filament\Forms\Components\Actions\Modal\Actions\Action;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Field;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Actions\Action as ActionsAction;
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

    protected static ?string $slug = 'order/bookings';

    public static function form(Form $form): Form
    {
        $lastOrder = Pemesanan::orderByDesc('id')->first();
        $increment = $lastOrder ? intval(substr($lastOrder->nomor_pemesanan, -3)) + 1 : 1;
        $orderNumber = 'ORD-' . str_pad($increment, 3, '0', STR_PAD_LEFT);

        // Mengambil semua data batas dari tabel batas
        $allBookings = Batas::where('batas', 40)->get();
        // Array untuk menyimpan rentang tanggal dari pemesanan
        $bookingRanges = [];
        foreach ($allBookings as $booking) {
            $bookingRanges[] = $booking->tanggal_mulai; 
            $bookingRanges[] = $booking->tanggal_selesai; 
        }

        return $form
            ->schema([
                Section::make('Detail Booking')
                    ->schema([
                        Forms\Components\TextInput::make('nomor_pemesanan')
                            ->unique(ignorable: fn ($record) => $record)
                            ->default($orderNumber)
                            ->required()
                            ->disabled()
                            ->label('NP'),
                        Section::make('Detail Customer')
                            ->schema([
                                Grid::make()
                                    ->schema([
                                        Select::make('users_id')
                                            ->options(User::all()->pluck('name', 'id'))
                                            ->required()
                                            ->searchable()
                                            ->reactive()
                                            ->afterStateUpdated(function (Closure $set, $state) {
                                                $userId = $state;
                                                if ($userId) {
                                                    $user = User::find($userId);
                                                    if ($user) {
                                                        $set('telp', $user->address_user->telp);
                                                        $set('address', $user->address_user->address);
                                                    }
                                                }
                                            })
                                            ->label('Customer'),
                                        Forms\Components\TextInput::make('telp')
                                            ->label('Telephone'),
                                    ]),
                                ])->collapsed(false),
                        Section::make('Service')
                            ->schema([
                                Grid::make()
                                    ->schema([
                                        Select::make('paket_id')
                                            ->options(Paket::all()->pluck('jenis', 'id'))
                                            ->required()
                                            ->searchable()
                                            ->reactive()
                                            ->afterStateUpdated(function (Closure $set, $state) {
                                                $paketId = $state;

                                                if ($paketId) {
                                                    $paket = Paket::find($paketId);
                                                    if ($paket) {
                                                        $set('harga', $paket->harga);
                                                        $set('satuan_harga', $paket->satuan_harga);
                                                        $set('deskripsi', $paket->deskripsi);
                                                    }
                                                }
                                            })
                                            ->label('Service'),
                                        Forms\Components\TextInput::make('satuan_harga')
                                            ->label('Satuan'),
                                        Forms\Components\TextInput::make('harga')
                                            ->label('Harga/Satuan'),
                                    ]),
                                Textarea::make('deskripsi')
                                    ->label('About Service'),
                            ])->collapsed(false),
                        Textarea::make('address')
                            ->required()
                            ->label('Detail Address'),
                        Grid::make(2)
                            ->schema([
                                Grid::make(1)
                                    ->schema([
                                        Forms\Components\TextInput::make('jumlah')
                                            ->required()
                                            ->columnSpan(1)
                                            ->label('Quantity'),
                                        Fieldset::make('Booking Date')
                                            ->relationship('batas')
                                            ->schema([
                                                DatePicker::make('tanggal_mulai')
                                                    ->minDate(now()->addDay())
                                                    ->disabledDates($bookingRanges)
                                                    ->reactive()
                                                    ->afterStateUpdated(function (Closure $set, $get, $state) {
                                                        $startDate = \Illuminate\Support\Carbon::parse($state);
                                                        $endDate = $startDate->addDay();
                                                        $set('tanggal_selesai', $endDate);
                                                        $quantity = $get('../jumlah');

                                                        $bookingReady = Batas::whereRaw('batas < 40')
                                                                            ->orderBy('tanggal_mulai', 'desc')
                                                                            ->get();
                                                        $bookingReadyRanges = [];
                                                        foreach ($bookingReady as $bookingRead) {
                                                            $bookingReadyRanges[] = [
                                                                'from' => $bookingRead->tanggal_mulai,
                                                                'to' => $bookingRead->tanggal_selesai,
                                                                'batas' => $bookingRead->batas,
                                                            ];
                                                        }

                                                        foreach ($bookingReadyRanges as $range) {
                                                            $from = \Illuminate\Support\Carbon::parse($range['from']);
                                                            $to = \Illuminate\Support\Carbon::parse($range['to']);
                                                    
                                                            $batas = $range['batas'] ?? 0;
                                                            $newBatas = $batas + $quantity;

                                                            if (($startDate >= $from && $startDate <= $to) || ($endDate >= $from && $endDate < $to)) {
                                                                if ($newBatas <= 40) {
                                                                    $set('tanggal_mulai', $from->format('Y-m-d'));
                                                                    $set('tanggal_selesai', $to->format('Y-m-d'));
                                                                    $set('batas', $newBatas);
                                                                    $message = "*Tanggal yang Anda pilih berada di list booking dan jumlah Anda masih mencukupi dari total batas (kurang dari 40KG), silahkan lihat pada tombol 'See Available'";
                                                                    $set('message', $message);
                                                                } else {
                                                                    $set('tanggal_mulai', '');
                                                                    $set('tanggal_selesai', '');
                                                                    $set('batas', $newBatas);
                                                                    $message = "*Tanggal yang Anda pilih berada di list booking dan jumlah Anda melewati dari total batas (lebih dari 40KG), silahkan lihat pada tombol 'See Available'";
                                                                    $set('message', $message);
                                                                }
                                                                return;
                                                            }
                                                    
                                                            if (($startDate != $from && $endDate != $to) || ($endDate != $from && $startDate != $to)) {
                                                                $newBatas = $quantity;
                                                    
                                                                if ($newBatas <= 40) {
                                                                    $set('tanggal_mulai', $startDate->format('Y-m-d'));
                                                                    $tempEndDate = $startDate->copy()->addDay();
                                                                    $set('tanggal_selesai', $tempEndDate->format('Y-m-d'));
                                                                    $set('batas', $newBatas);
                                                                    $message = "*Anda memilih tanggal baru (tidak ada di list) dan jumlah yang Anda berikan mencukupi 'kurang dari 40KG'";
                                                                    $set('message', $message);
                                                                } elseif ($newBatas > 40) {
                                                                    $set('tanggal_mulai', '');
                                                                    $set('tanggal_selesai', '');
                                                                    $set('batas', $newBatas);
                                                                    $message = "*Anda memilih tanggal baru (tidak ada di list) dan jumlah yang Anda berikan melewati 'lebih dari 40KG'";
                                                                    $set('message', $message);
                                                                }
                                                            }
                                                        }
                                                    })
                                                    ->columnSpanFull()
                                                    ->required()
                                                    ->label('Start Date'),
                                                DatePicker::make('tanggal_selesai')
                                                    ->disabled()
                                                    ->columnSpanFull()
                                                    ->required()
                                                    ->label('End Date'),
                                                TextInput::make('batas')
                                                    ->required()
                                                    ->columnSpanFull()
                                                    ->label('Total Limit'),
                                            ])->columnSpan(1),
                                    ])->columnSpan(1),
                                Textarea::make('list')
                                    ->columnSpan(1)
                                    ->default(function ($state) {
                                        $bookingReady = Batas::whereRaw('batas < 40')
                                                                    ->orderBy('tanggal_mulai', 'desc')
                                                                    ->get();
                                        $bookingReadyRanges = [];
                                        foreach ($bookingReady as $bookingRead) {
                                            $bookingReadyRanges[] = [
                                                'from' => $bookingRead->tanggal_mulai,
                                                'to' => $bookingRead->tanggal_selesai,
                                                'batas' => $bookingRead->batas,
                                            ];
                                        }

                                        $displayText = '';

                                        foreach ($bookingReady as $booking) {
                                            $strtDate = date('Y-m-d', strtotime($booking->tanggal_mulai)); // Ubah format menjadi 'Y-m-d'
                                            $enDate = date('d F Y', strtotime($booking->tanggal_selesai)); // Format yang sama dengan sebelumnya
                                            $tomorrow1 = date('Y-m-d', strtotime('+1 day'));
                                        
                                            if ($strtDate >= $tomorrow1) {
                                                if ($booking->count() > 0) {
                                                    $strtDate = date('d F Y', strtotime($booking->tanggal_mulai));
                                                    $displayText .= "Terkumpul: " . $booking->batas . "/40kg\n";
                                                    $displayText .= "Durasi   : " . $strtDate . " - " . $enDate . "\n";
                                                    $displayText .= "-----------------\n";
                                                }
                                            }
                                        }

                                        return $displayText;
                                    })
                                    ->label('Available')
                                    ->disabled(),
                            ]),
                        Select::make('tipe_pickup')
                            ->options([
                                'kurir' => 'Sewa Kurir',
                                'mandiri' => 'Mandiri'
                            ])
                            ->reactive()
                            ->afterStateUpdated(function (Closure $set, $state) {
                                $paketId = $state;

                                if ($paketId) {
                                    $paket = Paket::find($paketId);
                                    if ($paket) {
                                        $set('harga', $paket->harga);
                                        $set('satuan_harga', $paket->satuan_harga);
                                        $set('deskripsi', $paket->deskripsi);
                                    }
                                }
                            })
                            ->label('Pickup Type'),
                        Grid::make(2)
                            ->schema([
                                Grid::make(1)
                                    ->schema([
                                        Forms\Components\TextInput::make('harga_kurir')
                                            ->hidden(
                                                function ($get) {
                                                    return $get('tipe_pickup') !== 'kurir';
                                                })
                                            ->required()
                                            ->label('Shipping Price')
                                            ->columnSpan(1),
                                        Forms\Components\TextInput::make('total_price')
                                            ->required()
                                            ->disabled()
                                            ->label('SubTotal')
                                            ->columnSpan(1),
                                    ])->columnSpan(1),
                                Fieldset::make('Pembayaran')
                                    ->relationship('pembayaran')
                                    ->schema([
                                        Forms\Components\TextInput::make('total')
                                            ->required()
                                            ->disabled()
                                            ->columnSpanFull(),
                                        FileUpload::make('bukti_pembayaran')
                                            ->columnSpanFull(),
                                    ])->columnSpan(1),
                            ]),
                    ])
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
                    ->label('Customer'),
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
                Tables\Actions\Action::make('Invoice')
                    ->disabled(fn($record) => $record->status != 'finished')
                    ->icon('heroicon-o-document-download')
                    ->url(fn (Pemesanan $record) => route('pemesanan.invoice', $record))
                    ->openUrlInNewTab(),
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
