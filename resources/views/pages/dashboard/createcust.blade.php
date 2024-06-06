@extends('pages.dashboard.navi')

@section('body1')
<head>
    {{-- style --}}
    {{-- <link rel="stylesheet" href="https://unpkg.com/tailwindcss@2.2.19/dist/tailwind.min.css"/> --}}
    <link href="https://unpkg.com/@tailwindcss/custom-forms/dist/custom-forms.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/choices.js/public/assets/styles/choices.min.css" rel="stylesheet" />
    <!-- Tambahkan link ke library jQuery dan jQuery UI -->
    {{-- <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script> --}}
</head>
<!-- component -->
    <!-- This is an example component -->
    <div class='flex items-center justify-center min-h-screen'>
        <div class='w-full max-w-lg px-10 py-8 mx-auto bg-white rounded-lg shadow-2xl'>
            <form action="{{ route('createpack')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class='max-w-md mx-auto space-y-6'>
                    <h2 class="text-2xl font-bold">Informasi Pengguna</h2>
                    <div class='relative mb-4 flex w-full flex-wrap items-stretch'>

                        <div class="md:flex mb-6">
                            <div class="md:w-1/3">
                                <label class="block text-gray-600 font-bold md:text-left mb-3 md:mb-0 pr-4" for="my-textfield">
                                    Nama Pelanggan
                                </label>
                            </div>
                            <div class="md:w-2/3">
                                <input id="my-textfield" class="nama-input form-input block w-full focus:bg-white" type="text" disabled>
                                <p class="py-2 text-sm text-gray-600">*nama pelanggan</p>
                            </div>
                        </div>
                        
                        <div class="md:flex mb-6">
                            <div class="md:w-1/3">
                                <label class="block text-gray-600 font-bold md:text-left mb-3 md:mb-0 pr-4" for="my-textfield">
                                    Email Pelanggan
                                </label>
                            </div>
                            <div class="md:w-2/3">
                                <select name="user_id" class="email-input form-input block focus:bg-white choices" id="my-textfield" onchange="updateInfo()">
                                    <option value="" hidden>--Pilih--</option>
                                    @foreach ($users as $user)
                                    <option value="{{ $user->id }}" >{{ $user->email }}</option>
                                    @endforeach
                                </select>
                                <p class="py-2 text-sm text-gray-600">*email pelanggan</p>
                            </div>
                            <div class="md:w-3/3">
                                <button type="submit" id="submitButton" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" disabled>
                                    Sent
                                </button>
                            </div>
                            {{-- Choices JS --}}
                            <script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script>

                            <script>
                                document.addEventListener('DOMContentLoaded', function () {
                                    const elements = document.querySelectorAll('.choices');
                                    elements.forEach(element => {
                                        const choices = new Choices(element, {
                                            searchEnabled: true,
                                            placeholderValue: '--Pilih--'
                                        });
                                    });
                                });
                            </script>
                        </div>
                        @php
                            $userJson = $users->map(function($user) {
                                return [
                                    'id' => $user->id,
                                    'name' => $user->name,
                                    'telp' => $user->address_user->telp ?? '', // Pastikan untuk menangani jika tidak ada alamat
                                    'address' => $user->address_user->address ?? '' // Pastikan untuk menangani jika tidak ada alamat
                                ];
                            });
                        @endphp
                        <script>
                            var users = @json($userJson);
                        
                            function updateInfo() {
                                var userSelect = document.querySelector('.email-input');
                                var selectedUserId = userSelect.value;
                                var selectedUser = users.find(user => user.id == selectedUserId);

                                if (selectedUser) {
                                    document.querySelector('.nama-input').value = selectedUser.name;
                                    document.querySelector('.telp-input').value = selectedUser.telp;
                                    document.querySelector('.address-input').value = selectedUser.address;
                                } else {
                                    document.querySelector('.nama-input').value = '';
                                    document.querySelector('.telp-input').value = '';
                                    document.querySelector('.address-input').value = '';
                                }

                                // Enable/disable submit button based on selected user
                                var submitButton = document.getElementById("submitButton");
                                submitButton.disabled = !selectedUser;
                            }
                        </script>
            
                        {{-- Telephone Pelanggan --}}
                        <div class="md:flex mb-6">
                            <div class="md:w-1/3">
                                <label class="block text-gray-600 font-bold md:text-left mb-3 md:mb-0 pr-4" for="my-textfield">
                                    Telephone Anda
                                </label>
                            </div>
                            <div class="md:w-2/3">
                                <input id="my-textfield" class="telp-input form-input block w-full focus:bg-white" type="text" disabled>
                                <p class="py-2 text-sm text-gray-600">*konfirmasi nomor pelanggan</p>
                            </div>
                        </div>
            
                        {{-- Alamat pelanggan --}}
                        <div class="md:flex mb-6">
                            <div class="md:w-1/3">
                                <label class="block text-gray-600 font-bold md:text-left mb-3 md:mb-0 pr-4" for="my-textarea">
                                    Alamat Pelanggan
                                </label>
                            </div>
                            <div class="md:w-2/3">
                                <textarea id="my-textarea" class="address-input address-input form-textarea block w-full focus:bg-white" value="" rows="8" disabled></textarea>
                                <p class="py-2 text-sm text-gray-600">*perhatikan alamat pelanggan</p>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection