@extends('pages.dashboard.navi')

@section('body1')
<head>
    {{-- style --}}
    {{-- <link rel="stylesheet" href="https://unpkg.com/tailwindcss@2.2.19/dist/tailwind.min.css"/> --}}
    <link href="https://unpkg.com/@tailwindcss/custom-forms/dist/custom-forms.min.css" rel="stylesheet">
    <!-- Tambahkan link ke library jQuery dan jQuery UI -->
    {{-- <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script> --}}
</head>
    <div class='flex items-center justify-center'>
        <div class="service lg:col-span-8 col-span-12 bg-transparent sm:w-auto w-full flex lg:flex-row flex-col gap-4 items-center overflow-y-scroll scrollbar-hidden py-6 px-3">
            @if ($pakets->count() > 0)
                @foreach ($pakets as $paket)
                <form action="{{ route('create', ['id' => $paket->id]) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="w-full max-w-sm p-4 bg-white border border-gray-200 rounded-lg shadow sm:p-8 dark:bg-gray-800 dark:border-gray-700 drop-shadow-lg-shadow">
                        <h5 class="mb-4 text-xl font-medium text-gray-500 dark:text-gray-400">Paket {{ $paket->jenis }}</h5>
                        <div class="flex items-baseline text-gray-900 dark:text-white">
                            <span class="text-3xl font-semibold">Rp</span>
                            <span class="text-5xl font-extrabold tracking-tight">{{ $paket->harga }}</span>
                            <span class="ml-1 text-xl font-normal text-gray-500 dark:text-gray-400">/{{ $paket->satuan_harga }}</span>
                        </div>
                        <ul role="list" class="space-y-5 my-7">
                            <li class="flex space-x-3 items-center">
                                <svg class="flex-shrink-0 w-4 h-4 text-blue-600 dark:text-blue-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/>
                                </svg>
                                <textarea class="text-base font-normal text-gray-500 dark:text-gray-400 w-full h-40 overflow-y-auto scrollbar-hidden resize-none rounded-lg bg-transparent" disabled>{{ $paket->deskripsi }}
                                </textarea>
                            </li>
                        </ul>
                        <input name="user_id" type="hidden" value="{{ $users->id }}">
                        <button class="button-paket text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-200 dark:focus:ring-blue-900 font-medium rounded-lg text-sm px-5 py-2.5 inline-flex justify-center w-full text-center">Choose plan</button>
                    </div>
                </form>
                @endforeach
            @endif
        </div>
    </div>
</form>
@endsection