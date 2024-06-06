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
                                            ->label('Harga/Satuan')
                                            ->type('number')
                                            ->reactive()
                                            ->afterStateUpdated(function ($set, $get) {
                                                $harga = (float)($get('harga') ?: 0); // Pastikan nilai numerik
                                                $jumlah = (float)($get('jumlah') ?: 0); // Pastikan nilai numerik
                                                $subtotal = $harga * $jumlah;
                                                $set('total_price', $subtotal);
                                        
                                                $tipe_pickup = $get('tipe_pickup');
                                                if ($tipe_pickup === 'kurir') {
                                                    $harga_kurir = (float)($get('harga_kurir') ?: 0); // Pastikan nilai numerik
                                                    $set('total_price', $subtotal);
                                                    $set('total', $subtotal + $harga_kurir);
                                                } else {
                                                    $set('total_price', $subtotal);
                                                    $set('total', $subtotal);
                                                }
                                            }),
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
                                            ->type('number')
                                            ->columnSpan(1)
                                            ->label('Quantity')
                                            ->reactive()
                                            ->afterStateUpdated(function ($set, $get) {
                                                $harga = (float)($get('harga') ?: 0); // Pastikan nilai numerik
                                                $jumlah = (float)($get('jumlah') ?: 0); // Pastikan nilai numerik
                                                $subtotal = $harga * $jumlah;
                                                $set('total_price', $subtotal);
                                        
                                                $tipe_pickup = $get('tipe_pickup');
                                                if ($tipe_pickup === 'kurir') {
                                                    $harga_kurir = (float)($get('harga_kurir') ?: 0); // Pastikan nilai numerik
                                                    $set('total_price', $subtotal);
                                                    $set('total', $subtotal + $harga_kurir);
                                                } else {
                                                    $set('total_price', $subtotal);
                                                    $set('total', $subtotal);
                                                }
                                            }),
                                        Fieldset::make('Booking Date')
                                            ->relationship('batas')
                                            ->schema([
                                                DatePicker::make('tanggal_mulai')
                                                    ->minDate(now()->addDay())
                                                    ->disabledDates($bookingRanges)
                                                    ->reactive()
                                                    ->afterStateUpdated(function (Closure $set, $get, $state) {
                                                        
                                                        $startDate = \Illuminate\Support\Carbon::parse($state);
                                                        $endDate = $startDate->copy()->addDay();
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
                                                                'id' => $bookingRead->id,
                                                            ];
                                                        }

                                                        $batasFound = false;
                                                        foreach ($bookingReadyRanges as $range) {
                                                            $from = \Illuminate\Support\Carbon::parse($range['from']);
                                                            $to = \Illuminate\Support\Carbon::parse($range['to']);
                                                    
                                                            $batas = $range['batas'] ?? 0;
                                                            $newBatas = $batas + $quantity;

                                                            if ($startDate >= $from && $startDate <= $to) {
                                                                if ($newBatas <= 40) {
                                                                    $set('tanggal_mulai', $from->format('Y-m-d'));
                                                                    $set('tanggal_selesai', $to->format('Y-m-d'));
                                                                    $set('batas', $newBatas);
                                                                    $set('../batas_id', $range['id']);
                                                                    $message = "*Tanggal yang Anda pilih berada di list booking dan jumlah Anda masih mencukupi dari total batas (kurang dari 40KG), silahkan lihat pada tombol 'See Available'";
                                                                    $batasFound = true;
                                                                } else {
                                                                    $set('tanggal_mulai', '');
                                                                    $set('tanggal_selesai', '');
                                                                    $set('batas', $newBatas);
                                                                    $message = "*Tanggal yang Anda pilih berada di list booking dan jumlah Anda melewati dari total batas (lebih dari 40KG), silahkan lihat pada tombol 'See Available'";
                                                                }
                                                                $set('message', $message);
                                                                break;
                                                            }

                                                            if ($endDate >= $from && $endDate <= $to) {
                                                                if ($newBatas <= 40) {
                                                                    $set('tanggal_mulai', $from->format('Y-m-d'));
                                                                    $set('tanggal_selesai', $to->format('Y-m-d'));
                                                                    $set('batas', $newBatas);
                                                                    $set('../batas_id', $range['id']);
                                                                    $message = "**Tanggal yang Anda pilih berada di list booking dan jumlah Anda masih mencukupi dari total batas (kurang dari 40KG), silahkan lihat pada tombol 'See Available'";
                                                                    $batasFound = true;
                                                                } else {
                                                                    $set('tanggal_mulai', '');
                                                                    $set('tanggal_selesai', '');
                                                                    $set('batas', $newBatas);
                                                                    $message = "**Tanggal yang Anda pilih berada di list booking dan jumlah Anda melewati dari total batas (lebih dari 40KG), silahkan lihat pada tombol 'See Available'";
                                                                }
                                                                $set('message', $message);
                                                                break;
                                                            }
                                                    
                                                            if ($startDate != $from && $endDate != $to) {
                                                                if ($endDate != $from && $startDate != $to) {
                                                                    $newBatas = $quantity;
                                                        
                                                                    if ($newBatas <= 40) {
                                                                        $set('tanggal_mulai', $startDate->format('Y-m-d'));
                                                                        $tempEndDate = $startDate->copy()->addDay();
                                                                        $set('tanggal_selesai', $tempEndDate->format('Y-m-d'));
                                                                        $set('batas', $newBatas);
                                                                        $message = "*Anda memilih tanggal baru (tidak ada di list) dan jumlah yang Anda berikan mencukupi 'kurang dari 40KG'";
                                                                    } elseif ($newBatas > 40) {
                                                                        $set('tanggal_mulai', '');
                                                                        $set('tanggal_selesai', '');
                                                                        $set('batas', $newBatas);
                                                                        $message = "*Anda memilih tanggal baru (tidak ada di list) dan jumlah yang Anda berikan melewati 'lebih dari 40KG'";
                                                                    }
                                                                }
                                                                $set('message', $message);
                                                                break;
                                                            }
                                                        }
                                                        if (!$batasFound) {
                                                            // Tanggal tidak ditemukan dalam daftar, buat objek Batas baru
                                                            $newBatas1 = new Batas();
                                                            $newBatas1->tanggal_mulai = $startDate;
                                                            $newBatas1->tanggal_selesai = $endDate;
                                                            $newBatas1->batas = $quantity;
                                                            $newBatas1->save();
                                                            $set('../batas_id', $newBatas1->id);

                                                            $set('tanggal_mulai', $startDate->format('Y-m-d'));
                                                            $set('tanggal_selesai', $endDate->format('Y-m-d'));
                                                            $set('batas', $quantity);
                                                            $message = "*Anda memilih tanggal baru (tidak ada di list) dan jumlah yang Anda berikan mencukupi 'kurang dari 40KG'";
                                                            $set('message', $message);
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
                                Hidden::make('batas_id'),
                                Textarea::make('list')
                                    ->columnSpan(1)
                                    ->default(function ($state) {
                                        $bookingReady = Batas::whereRaw('batas < 40')
                                                                    ->whereRaw('batas > 0')
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
                            ->afterStateUpdated(function ($set, $get) {
                                $subtotal = (float)($get('total_price') ?: 0); // Pastikan nilai numerik
                                $tipe_pickup = $get('tipe_pickup');
                                if ($tipe_pickup === 'kurir') {
                                    $harga_kurir = (float)($get('harga_kurir') ?: 0); // Pastikan nilai numerik
                                    $set('total_price', $subtotal);
                                    $set('total', $subtotal + $harga_kurir);
                                } else {
                                    $set('total_price', $subtotal);
                                    $set('total', $subtotal);
                                }
                            })
                            ->label('Pickup Type'),
                        Grid::make(2)
                            ->schema([
                                Grid::make(1)
                                    ->schema([
                                        Forms\Components\TextInput::make('harga_kurir')
                                            ->hidden(function ($get) {
                                                return $get('tipe_pickup') !== 'kurir';
                                            })
                                            ->required(function ($get) {
                                                return $get('tipe_pickup') === 'kurir';
                                            })
                                            ->type('number')
                                            ->reactive()
                                            ->afterStateUpdated(function ($set, $get) {
                                                $subtotal = (float)($get('total_price') ?: 0); // Pastikan nilai numerik
                                                $tipe_pickup = $get('tipe_pickup');
                                                if ($tipe_pickup === 'kurir') {
                                                    $harga_kurir = (float)($get('harga_kurir') ?: 0); // Pastikan nilai numerik
                                                    $set('total_price', $subtotal);
                                                    $set('total', $subtotal + $harga_kurir);
                                                } else {
                                                    $set('total_price', $subtotal);
                                                    $set('total', $subtotal);
                                                }
                                            })
                                            ->label('Shipping Price')
                                            ->columnSpan(1),
                                        Forms\Components\TextInput::make('total_price')
                                            ->required()
                                            ->type('number')
                                            ->disabled()
                                            ->label('SubTotal')
                                            ->columnSpan(1)
                                            ->reactive(),
                                    ])->columnSpan(1),
                                    Forms\Components\TextInput::make('total')
                                            ->required()
                                            ->type('number')
                                            ->disabled()
                                            ->columnSpan(1)
                                            ->reactive()
                                            ->afterStateUpdated(function ($set, $get) {
                                                $subtotal = (float)($get('total_price') ?: 0); // Pastikan nilai numerik
                                                $tipe_pickup = $get('tipe_pickup');
                                                if ($tipe_pickup === 'kurir') {
                                                    $harga_kurir = (float)($get('harga_kurir') ?: 0); // Pastikan nilai numerik
                                                    $set('total_price', $subtotal);
                                                    $set('total', $subtotal + $harga_kurir);
                                                } else {
                                                    $set('total_price', $subtotal);
                                                    $set('total', $subtotal);
                                                }
                                            }),
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
                TextInputColumn::make('jumlah')
                    ->disabled(fn($record) => $record->status != 'waiting')
                    ->label('Jumlah'),
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
                    ->disabled(function ($record) {
                        return $record->tipe_pickup == 'mandiri' || $record->status != 'waiting';
                    }),
                Tables\Columns\TextColumn::make('total')
                    ->searchable()
                    ->label('Total'),
                Tables\Columns\ImageColumn::make('pembayaran.bukti_pembayaran')
                    ->searchable()
                    // ->getStateUsing(function (Pemesanan $record): string {
                    //     if ($record->pembayaran) {
                    //         return $record->pembayaran->bukti_pembayaran;
                    //     } else {
                    //         // Jika tidak ada pembayaran terkait, kembalikan string kosong
                    //         return '';
                    //     }
                    // })
                    // ->extraImgAttributes([
                    //     'img' => 'src'
                    // ])
                    ->label('Payment Proof'),
                SelectColumn::make('status')
                    ->options([
                        'waiting' => 'Waiting',
                        'process' => 'Process',
                        'pending' => 'Pending',
                        'finished' => 'Finished',
                        'cancelled' => 'cancelled',
                    ]),
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                //Tables\Actions\ViewAction::make(),
                Tables\Actions\Action::make('Edit')
                    ->disabled(fn($record) => $record->status != 'waiting' || $record->pembayaran->bukti_pembayaran)
                    ->url(fn (Pemesanan $record) => route('edit', $record))
                    ->openUrlInNewTab(),
                Tables\Actions\Action::make('Invoice')
                    ->disabled(fn($record) => $record->status != 'finished')
                    ->icon('heroicon-o-document-download')
                    ->url(fn (Pemesanan $record) => route('pemesanan.invoice', $record))
                    ->openUrlInNewTab(),
                Tables\Actions\Action::make('Cancel')
                    ->disabled(fn($record) => $record->status != 'waiting')
                    ->url(fn (Pemesanan $record) => route('cancel', $record))
                    ->openUrlInNewTab(),
                Tables\Actions\Action::make('Refund')
                    ->disabled(fn($record) => $record->status != 'cancelled')
                    ->url(fn (Pemesanan $record) => route('refund', $record))
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
            ->leftJoin('pembayaran', 'pemesanan.id', '=', 'pembayaran.pemesanan_id') // Menyesuaikan nama tabel dan kolom
            ->leftJoin('pengembalian', 'pembayaran.id', '=', 'pengembalian.pembayaran_id')
            ->orderByRaw("CASE 
                            WHEN pemesanan.status = 'cancelled' AND pembayaran.bukti_pembayaran IS NOT NULL AND pengembalian.id IS NULL THEN 0
                            WHEN pemesanan.status = 'waiting' THEN 1 
                            WHEN pemesanan.status = 'process' THEN 2 
                            WHEN pemesanan.status = 'pending' THEN 3 
                            WHEN pemesanan.status = 'finished' THEN 4
                            ELSE 5 
                        END")
            ->orderBy('pemesanan.created_at', 'desc') // Menyesuaikan nama tabel
            ->select('pemesanan.*')
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
