<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PressIt</title>

    {{-- Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter&display=swap" rel="stylesheet">
    <style>
        .scrollbar-hidden::-webkit-scrollbar{
            display: none;
        }

        @media print {
            @page { 
                size: 60mm 145mm;
                position: absolute;
                top: 0;
                left: 0;
                margin: 0;
                padding: 0;
            }
            .m-0 {
                margin: 0;
            }
            .mx-auto {
                margin-left: auto;
                margin-right: auto;
            }
            .w-60 {
                width: 15rem/* 240px */;
            }
            .rounded-lg {
                border-radius: 0.5rem/* 8px */;
            }
            .shadow-lg {
                --tw-shadow: 0 10px 15px -3px rgb(0 0 0 / 0.1), 0 4px 6px -4px rgb(0 0 0 / 0.1);
                --tw-shadow-colored: 0 10px 15px -3px var(--tw-shadow-color), 0 4px 6px -4px var(--tw-shadow-color);
                box-shadow: var(--tw-ring-offset-shadow, 0 0 #0000), var(--tw-ring-shadow, 0 0 #0000), var(--tw-shadow);
            }
            .p-5 {
                padding: 1.25rem/* 20px */;
            }
            .text-xs {
                font-size: 0.75rem/* 12px */;
                line-height: 1rem/* 16px */;
            }
            .mt-8 {
                margin-top: 2rem/* 32px */;
            }
            .mx-4 {
                margin-left: 1rem/* 16px */;
                margin-right: 1rem/* 16px */;
            }
            .flex {
                display: flex;
            }
            .flex-col {
                flex-direction: column;
            }
            .text-gray-800 {
                --tw-text-opacity: 1;
                color: rgb(31 41 55 / var(--tw-text-opacity));
            }
            .text-xl {
                font-size: 1.25rem/* 20px */;
                line-height: 1.75rem/* 28px */;
            }
            .font-medium {
                font-weight: 500;
            }
            .mb-2 {
                margin-bottom: 0.5rem/* 8px */;
            }
            .text-gray-600 {
                --tw-text-opacity: 1;
                color: rgb(75 85 99 / var(--tw-text-opacity));
            }
            .text-xs {
                font-size: 0.75rem/* 12px */;
                line-height: 1rem/* 16px */;
            }
            .my-4 {
                margin-top: 1rem/* 16px */;
                margin-bottom: 1rem/* 16px */;
            }
            .text-base {
                font-size: 1rem/* 16px */;
                line-height: 1.5rem/* 24px */;
            }
            .flex-row {
                flex-direction: row;
            }
            .flex-wrap {
                flex-wrap: wrap;
            }
            .justify-between {
                justify-content: space-between;
            }
            .mb-1 {
                margin-bottom: 0.25rem/* 4px */;
            }
            .text-lg {
                font-size: 1.125rem/* 18px */;
                line-height: 1.75rem/* 28px */;
            }

            body * {
                visibility: hidden;
            }

            .print-container, .print-container * {
                visibility: visible;
            }
        }
        @page { 
            size: 80mm 150mm;
            position: absolute;
            top: 0;
            left: 0;
            margin-left: auto;
            margin-right: auto;
            padding: 0;
        }
        /* body * {
            visibility: hidden;
        }
        .print-container, .print-container * {
            visibility: visible;
        } */
        body {
            width: 200px;
        }
        .m-0 {
            margin: 0;
        }
        .mx-auto {
            margin-left: auto;
            margin-right: auto;
        }
        .w-60 {
            width: 15rem/* 240px */;
        }
        .rounded-lg {
            border-radius: 0.5rem/* 8px */;
        }
        .shadow-lg {
            --tw-shadow: 0 10px 15px -3px rgb(0 0 0 / 0.1), 0 4px 6px -4px rgb(0 0 0 / 0.1);
            --tw-shadow-colored: 0 10px 15px -3px var(--tw-shadow-color), 0 4px 6px -4px var(--tw-shadow-color);
            box-shadow: var(--tw-ring-offset-shadow, 0 0 #0000), var(--tw-ring-shadow, 0 0 #0000), var(--tw-shadow);
        }
        .p-5 {
            padding: 1.25rem/* 20px */;
        }
        .text-xs {
            font-size: 0.75rem/* 12px */;
            line-height: 1rem/* 16px */;
        }
        .mt-8 {
            margin-top: 2rem/* 32px */;
        }
        .mx-4 {
            margin-left: 1rem/* 16px */;
            margin-right: 1rem/* 16px */;
        }
        .flex {
            display: flex;
        }
        .flex-col {
            flex-direction: column;
        }
        .text-gray-800 {
            --tw-text-opacity: 1;
            color: rgb(31 41 55 / var(--tw-text-opacity));
        }
        .text-xl {
            font-size: 1.25rem/* 20px */;
            line-height: 1.75rem/* 28px */;
        }
        .font-medium {
            font-weight: 500;
        }
        .mb-2 {
            margin-bottom: 0.5rem/* 8px */;
        }
        .text-gray-600 {
            --tw-text-opacity: 1;
            color: rgb(75 85 99 / var(--tw-text-opacity));
        }
        .text-xs {
            font-size: 0.75rem/* 12px */;
            line-height: 1rem/* 16px */;
        }
        .my-4 {
            margin-top: 1rem/* 16px */;
            margin-bottom: 1rem/* 16px */;
        }
        .text-base {
            font-size: 1rem/* 16px */;
            line-height: 1.5rem/* 24px */;
        }
        .flex-row {
            flex-direction: row;
        }
        .flex-wrap {
            flex-wrap: wrap;
        }
        .justify-between {
            justify-content: space-between;
        }
        .mb-1 {
            margin-bottom: 0.25rem/* 4px */;
        }
        .text-lg {
            font-size: 1.125rem/* 18px */;
            line-height: 1.75rem/* 28px */;
        }

        .blank {
            position: absolute;
            top: 0;
            width: 100%;
            height: 100vh;
            background-color: white;
            z-index: 999;
        }
    </style>

    {{-- apline js --}}
    <script src="//unpkg.com/alpinejs" defer></script>
</head>

<body x-data="{'loginOpen': false, 'registerOpen': false, 'regisDetail':false}" x-on:keydown.escape="loginOpen=false, registerOpen=false">
    <button class="p-1 mt-4 bg-blue-500 rounded" onclick="window.print()">Print Invoice</button>
    <div class="m-0 print-container" id="order-receipt">
        <div class="p-5 text-xs bg-white">
            <div>
                <div class="flex flex-col">
                    <h1 class="m-0 text-gray-800 text-xl font-medium">Press It</h1>
                    @php
                        $currentDate = date('d-m-Y');
                    @endphp
                    <p class="m-0 text-gray-600 text-xs">Date: {{ $currentDate }}</p>
                    <p class="m-0 text-gray-600 text-xs">Order Number: {{ $pemesanans->nomor_pemesanan }}</p>
                </div>
                <hr class="my-4 ">
                <div>
                <div class="flex flex-row flex-wrap justify-between mb-1">
                    <span class="font-medium text-base">Payable to :</span>
                    <span class="font-medium text-base">{{ $pemesanans->user->name }}</span>
                </div>
                <span>---</span>
                <div class="flex flex-row flex-wrap justify-between mb-1">
                    <span>Detail Address :</span>
                    <span>{{ $pemesanans->address }}</span>
                </div>
                <hr class="my-4 ">
                <div class="flex flex-row flex-wrap justify-between mb-1">
                    <span class="font-medium text-base">Service :</span>
                    <span class="font-medium text-base">{{ $pemesanans->paket->jenis }}</span>
                </div>
                <span>---</span>
                <div class="flex flex-row flex-wrap justify-between mb-1">
                    <span>Price :</span>
                    <span>Rp {{ number_format($pemesanans->paket->harga, 0, ',', '.') }}/{{ $pemesanans->paket->satuan_harga }}</span>
                </div>
                <div class="flex flex-row flex-wrap justify-between mb-1">
                    <span>Tanggal Mulai :</span>
                    <span>{{ $pemesanans->batas->tanggal_mulai }}</span>
                </div>
                <div class="flex flex-row flex-wrap justify-between mb-1">
                    <span>Tanggal Selesai :</span>
                    <span>{{ $pemesanans->batas->tanggal_selesai }}</span>
                </div>
                <hr class="my-4 ">
                <div class="flex flex-row flex-wrap justify-between mb-1">
                    <span class="font-medium text-base">Your Order :</span>
                </div>
                <span>---</span>
                <div class="flex flex-row flex-wrap justify-between mb-1">
                    <span>Quantity :</span>
                    <span>{{ $pemesanans->jumlah }} {{ $pemesanans->paket->satuan_harga == 'pakaian' ? 'Pakaian' : 'KG' }}</span>
                </div>
                <div class="flex flex-row flex-wrap justify-between mb-1">
                    <span>Pickup ({{ $pemesanans->tipe_pickup }}) :</span>
                    <span>Rp {{ number_format($pemesanans->harga_kurir, 0, ',', '.') }}</span>
                </div>
                <div class="flex flex-row flex-wrap justify-between mb-2 print:mb-2">
                    <span>Sub Total : </span>
                    <span>Rp {{ number_format($pemesanans->total_price, 0, ',', '.') }}</span>
                </div>
                <div class="flex flex-row flex-wrap justify-between">
                    <span class="font-medium text-lg print:text-lg">Total</span><span class="text-lg font-medium">Rp {{ number_format($pemesanans->total, 0, ',', '.') }}</span>
                </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.4/jspdf.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.js"></script>
    <script type="text/javascript">
        window.onload = function() {
            // Create a new instance of html2pdf
            const element = document.getElementById('order-receipt'); // ID of the container element
            // console.log(element);
            // console.log(window);
            var opt = {
                margin: 1,
                filename: 'PressIt1.pdf',
                image: { type: 'jpeg', quality: 0.98 },
                html2canvas: { scale: 2 },
                jsPDF: { unit: 'mm', format: [80, 160] }
            };

            html2pdf().from(element).set(opt).save();

            window.print();
        };
    </script>
    <div class="blank"></div>
</body>


</html>