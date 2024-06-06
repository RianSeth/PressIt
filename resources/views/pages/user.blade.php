@extends('layouts.app')

@section('body')
    <!-- component -->
    <!-- This is an example component -->
    <div class='flex items-center justify-center min-h-screen'>
        <div class='w-full max-w-lg px-10 py-8 mx-auto bg-white rounded-lg shadow-2xl'>
            <div class='max-w-md mx-auto space-y-6'>
        
                <h2 class="text-2xl font-bold">Informasi Pengguna</h2>
                @php
                    $message1 = '';
                    $teks1 = '';
                    if ($users->status == 'confirm') {
                        $message1 = 'Izinkan admin merubah nama, telepon dan alamat?';
                    } elseif ($users->status == 'approved') {
                        $message1 = 'Anda mengizinkan admin merubah nama, telepon dan alamat. Hapus Approval?';
                    }

                    if ($users->status == 'confirm') {
                        $teks1 = 'Terima';
                    } elseif ($users->status == 'approved') {
                        $teks1 = 'Stop';
                    }
                @endphp
                <form action="{{ route('changeinfo') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class='relative mb-4 flex w-full flex-wrap items-stretch'>
                        <span 
                        class="text-sm font-medium text-gray-900 block mb-2 dark:text-gray-300"
                        aria-describedby="button-addon2">{{ $users->status != 'confirm' ? '' : $users->status.' |' }} {{ $users->status != 'approved' ? '' : $users->status.' |' }} {{ $message1 }}</span>
                        <input
                            type="hidden"
                            name="status"
                            value="approved" {{ $users->status == 'confirm' ? '' : 'disabled' }}/>
                        <input
                            type="hidden"
                            name="status"
                            value="active" {{ $users->status == 'approved' ? '' : 'disabled' }}/>
                        <button
                            class="z-[2] inline-block  {{ $users->status == 'active' ? 'hidden' : '' }} rounded-e border-2 border-primary-100 px-6 pb-[6px] pt-2 text-xs font-medium uppercase leading-normal text-primary-700 text-black transition duration-150 ease-in-out hover:border-primary-accent-200 hover:bg-secondary-50/50 focus:border-primary-accent-200 focus:bg-secondary-50/50 focus:outline-none focus:ring-0 active:border-primary-accent-200 dark:border-primary-400 dark:text-primary-300 dark:hover:bg-blue-950 dark:focus:bg-blue-950 dark:text-black"
                            data-twe-ripple-init
                            type="submit"
                            id="button-addon2">{{ $teks1 }}
                        </button>
                    </div>
                
                <form action="{{ route('changeinfo') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class='relative mb-4 flex w-full flex-wrap items-stretch'>
                        <input
                            type="text"
                            name="name"
                            class="@error('name') is-invalid @enderror relative m-0 -me-px block flex-auto rounded-s border border-solid border-neutral-200 bg-transparent bg-clip-padding px-3 py-[0.25rem] text-base font-normal leading-[1.6] text-black outline-none transition duration-200 ease-in-out placeholder:text-neutral-500 focus:z-[3] focus:border-primary focus:shadow-inset focus:outline-none motion-reduce:transition-none dark:border-white/10 dark:placeholder:text-neutral-200 dark:autofill:shadow-autofill dark:focus:border-primary"
                            placeholder="Your Name"
                            aria-label="Your-Name"
                            aria-describedby="button-addon2"
                            value="{{ $users->name }}" />
                        <button
                            class="z-[2] inline-block rounded-e border-2 border-primary-100 px-6 pb-[6px] pt-2 text-xs font-medium uppercase leading-normal text-primary-700 text-black transition duration-150 ease-in-out hover:border-primary-accent-200 hover:bg-secondary-50/50 focus:border-primary-accent-200 focus:bg-secondary-50/50 focus:outline-none focus:ring-0 active:border-primary-accent-200 dark:border-primary-400 dark:text-primary-300 dark:hover:bg-blue-950 dark:focus:bg-blue-950 dark:text-black"
                            data-twe-ripple-init
                            type="submit"
                            id="button-addon2">change</button>
                    </div>
                    @if ($errors->has('name'))
                        <span class="text-sm font-medium text-gray-900 block mb-2 dark:text-gray-300">{{ $errors->first('name') }}</span>
                    @endif
                </form>

                <form x-data="{passConfirm : false}" action="{{ route('changeinfo') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class='relative mb-4 flex w-full flex-wrap items-stretch'>
                        <input
                            type="email"
                            id="emailInput"
                            name="email"
                            class="@error('email') is-invalid @enderror relative m-0 -me-px block flex-auto rounded-s border border-solid border-neutral-200 bg-transparent bg-clip-padding px-3 py-[0.25rem] text-base font-normal leading-[1.6] text-black outline-none transition duration-200 ease-in-out placeholder:text-neutral-500 focus:z-[3] focus:border-primary focus:shadow-inset focus:outline-none motion-reduce:transition-none dark:border-white/10 dark:placeholder:text-neutral-200 dark:autofill:shadow-autofill dark:focus:border-primary"
                            placeholder="Email User"
                            aria-label="Email User"
                            aria-describedby="button-addon2"
                            value="{{ substr($users->email, 0, 3) . str_repeat('*', strlen($users->email) - 7) . substr($users->email, -4) }}" 
                            disabled/>
                        <button
                            class="resetButton z-[2] inline-block rounded-e border-2 border-primary-100 px-6 pb-[6px] pt-2 text-xs font-medium uppercase leading-normal text-primary-700 text-black transition duration-150 ease-in-out hover:border-primary-accent-200 hover:bg-secondary-50/50 focus:border-primary-accent-200 focus:bg-secondary-50/50 focus:outline-none focus:ring-0 active:border-primary-accent-200 dark:border-primary-400 dark:text-primary-300 dark:hover:bg-blue-950 dark:focus:bg-blue-950 dark:text-black"
                            data-twe-ripple-init
                            type="button"
                            id="button-addon2"
                            onclick="resetInput()">reset
                        </button>
                        <button
                            class="changeButton z-[2] inline-block hidden rounded-e border-2 border-primary-100 px-6 pb-[6px] pt-2 text-xs font-medium uppercase leading-normal text-primary-700 text-black transition duration-150 ease-in-out hover:border-primary-accent-200 hover:bg-secondary-50/50 focus:border-primary-accent-200 focus:bg-secondary-50/50 focus:outline-none focus:ring-0 active:border-primary-accent-200 dark:border-primary-400 dark:text-primary-300 dark:hover:bg-blue-950 dark:focus:bg-blue-950 dark:text-black"
                            data-twe-ripple-init
                            type="button"
                            x-on:click="passConfirm = true"
                            id="button-addon2">change
                        </button>
                    </div>
                    <script>
                        function resetInput() {
                            // Mengaktifkan input
                            document.getElementById("emailInput").disabled = false;
                            // Menghapus nilai input
                            document.getElementById("emailInput").value = "";
                            // Menampilkan tombol Change
                            document.querySelectorAll(".changeButton")[0].classList.remove("hidden");
                            // Menyembunyikan tombol Reset
                            document.querySelectorAll(".resetButton")[0].classList.add("hidden");
                        }
                    </script>
                    @if ($errors->has('passwordConfirm'))
                        <span class="text-sm font-medium text-gray-900 block mb-2 dark:text-gray-300">{{ $errors->first('passwordConfirm') }}</span>
                    @endif
                    @if ($errors->has('email'))
                        <span class="text-sm font-medium text-gray-900 block mb-2 dark:text-gray-300">{{ $errors->first('email') }}</span>
                    @endif
                    <div 
                        class="fixed flex justify-center items-center mx-auto z-40 top-0 left-0 w-full h-screen"
                        x-show="passConfirm"
                        x-cloak
                        x-transition>
                        <div x-on:click="passConfirm = false" class="fixed left-0 top-0 w-full h-screen bg-black/50"></div>
                        <div class="w-96 max-w-2xl mx-auto z-50">
                            <div class='w-full max-w-lg px-10 py-8 mx-auto bg-white rounded-lg shadow-2xl'>
                                <div class='max-w-md mx-auto space-y-6'>
                                    <input
                                    name="passwordConfirm"
                                    type="password"
                                    class="@error('passwordConfirm') is-invalid @enderror relative w-full h-full m-0 -me-px block flex-auto rounded-s border border-solid border-neutral-200 bg-transparent bg-clip-padding px-3 py-[0.25rem] text-base font-normal leading-[1.6] text-black outline-none transition duration-200 ease-in-out placeholder:text-neutral-500 focus:z-[3] focus:border-primary focus:shadow-inset focus:outline-none motion-reduce:transition-none dark:border-white/10 dark:placeholder:text-neutral-200 dark:autofill:shadow-autofill dark:focus:border-primary"
                                    placeholder="Password"
                                    aria-label="Password" />
                                    <button
                                        class="z-[2] inline-block rounded-e border-2 border-primary-100 px-6 pb-[6px] pt-2 text-xs font-medium uppercase leading-normal text-primary-700 text-black transition duration-150 ease-in-out hover:border-primary-accent-200 hover:bg-secondary-50/50 focus:border-primary-accent-200 focus:bg-secondary-50/50 focus:outline-none focus:ring-0 active:border-primary-accent-200 dark:border-primary-400 dark:text-primary-300 dark:hover:bg-blue-950 dark:focus:bg-blue-950 dark:text-black"
                                        data-twe-ripple-init
                                        type="submit">change
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>

                <form x-data="{emailConfirm : false}" action="{{ route('changeinfo') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class='relative mb-4 flex w-full flex-wrap items-stretch'>
                        <input
                            type="password"
                            name="password"
                            class="@error('password') is-invalid @enderror relative m-0 -me-px block flex-auto rounded-s border border-solid border-neutral-200 bg-transparent bg-clip-padding px-3 py-[0.25rem] text-base font-normal leading-[1.6] text-black outline-none transition duration-200 ease-in-out placeholder:text-neutral-500 focus:z-[3] focus:border-primary focus:shadow-inset focus:outline-none motion-reduce:transition-none dark:border-white/10 dark:placeholder:text-neutral-200 dark:autofill:shadow-autofill dark:focus:border-primary"
                            placeholder="Password"
                            aria-label="password"
                            aria-describedby="button-addon2"
                            value="" />
                        <button
                            class="z-[2] inline-block rounded-e border-2 border-primary-100 px-6 pb-[6px] pt-2 text-xs font-medium uppercase leading-normal text-primary-700 text-black transition duration-150 ease-in-out hover:border-primary-accent-200 hover:bg-secondary-50/50 focus:border-primary-accent-200 focus:bg-secondary-50/50 focus:outline-none focus:ring-0 active:border-primary-accent-200 dark:border-primary-400 dark:text-primary-300 dark:hover:bg-blue-950 dark:focus:bg-blue-950 dark:text-black"
                            data-twe-ripple-init
                            type="button"
                            x-on:click="emailConfirm = true"
                            id="button-addon2">change
                        </button>
                    </div>
                    @if ($errors->has('password'))
                        <span class="text-sm font-medium text-gray-900 block mb-2 dark:text-gray-300">{{ $errors->first('password') }}</span>
                    @endif
                    @if ($errors->has('emailConfirm'))
                        <span class="text-sm font-medium text-gray-900 block mb-2 dark:text-gray-300">{{ $errors->first('emailConfirm') }}</span>
                    @endif
                    <div 
                        class="fixed flex justify-center items-center mx-auto z-40 top-0 left-0 w-full h-screen"
                        x-show="emailConfirm"
                        x-cloak
                        x-transition>
                        <div x-on:click="emailConfirm = false" class="fixed left-0 top-0 w-full h-screen bg-black/50"></div>
                        <div class="w-96 max-w-2xl mx-auto z-50">
                            <div class='w-full max-w-lg px-10 py-8 mx-auto bg-white rounded-lg shadow-2xl'>
                                <div class='relative mb-4 flex w-full flex-wrap items-stretch'>
                                    <input
                                        type="password"
                                        name="password_confirmation"
                                        class="@error('password') is-invalid @enderror relative m-0 -me-px block flex-auto rounded-s border border-solid border-neutral-200 bg-transparent bg-clip-padding px-3 py-[0.25rem] text-base font-normal leading-[1.6] text-black outline-none transition duration-200 ease-in-out placeholder:text-neutral-500 focus:z-[3] focus:border-primary focus:shadow-inset focus:outline-none motion-reduce:transition-none dark:border-white/10 dark:placeholder:text-neutral-200 dark:autofill:shadow-autofill dark:focus:border-primary"
                                        placeholder="Password Confirm"
                                        aria-label="password"
                                        aria-describedby="button-addon2"
                                        value="" />
                                </div>
                                <div class='max-w-md mx-auto space-y-6'>
                                    <input
                                    name="emailConfirm"
                                    type="email"
                                    class="@error('emailConfirm') is-invalid @enderror relative w-full h-full m-0 -me-px block flex-auto rounded-s border border-solid border-neutral-200 bg-transparent bg-clip-padding px-3 py-[0.25rem] text-base font-normal leading-[1.6] text-black outline-none transition duration-200 ease-in-out placeholder:text-neutral-500 focus:z-[3] focus:border-primary focus:shadow-inset focus:outline-none motion-reduce:transition-none dark:border-white/10 dark:placeholder:text-neutral-200 dark:autofill:shadow-autofill dark:focus:border-primary"
                                    placeholder="Your Email"
                                    aria-label="email" />
                                    <button
                                        class="z-[2] inline-block rounded-e border-2 border-primary-100 px-6 pb-[6px] pt-2 text-xs font-medium uppercase leading-normal text-primary-700 text-black transition duration-150 ease-in-out hover:border-primary-accent-200 hover:bg-secondary-50/50 focus:border-primary-accent-200 focus:bg-secondary-50/50 focus:outline-none focus:ring-0 active:border-primary-accent-200 dark:border-primary-400 dark:text-primary-300 dark:hover:bg-blue-950 dark:focus:bg-blue-950 dark:text-black"
                                        data-twe-ripple-init
                                        type="submit">change
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>

                <form action="{{ route('changeinfo') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class='relative mb-4 flex w-full flex-wrap items-stretch'>
                        <input
                            type="text"
                            name="telp"
                            class="@error('telp') is-invalid @enderror relative m-0 -me-px block flex-auto rounded-s border border-solid border-neutral-200 bg-transparent bg-clip-padding px-3 py-[0.25rem] text-base font-normal leading-[1.6] text-black outline-none transition duration-200 ease-in-out placeholder:text-neutral-500 focus:z-[3] focus:border-primary focus:shadow-inset focus:outline-none motion-reduce:transition-none dark:border-white/10 dark:placeholder:text-neutral-200 dark:autofill:shadow-autofill dark:focus:border-primary"
                            placeholder="Telephone"
                            aria-label="Telephone"
                            aria-describedby="button-addon2"
                            value="{{ substr($users->address_user->telp, 0, 2) . str_repeat('*', strlen($users->address_user->telp) - 2) }}" maxlength="13" oninput="this.value = this.value.replace(/[^0-9*]/g, '').slice(0, 13);"/>
                        <button
                            class="z-[2] inline-block rounded-e border-2 border-primary-100 px-6 pb-[6px] pt-2 text-xs font-medium uppercase leading-normal text-primary-700 text-black transition duration-150 ease-in-out hover:border-primary-accent-200 hover:bg-secondary-50/50 focus:border-primary-accent-200 focus:bg-secondary-50/50 focus:outline-none focus:ring-0 active:border-primary-accent-200 dark:border-primary-400 dark:text-primary-300 dark:hover:bg-blue-950 dark:focus:bg-blue-950 dark:text-black"
                            data-twe-ripple-init
                            type="submit"
                            id="button-addon2">change
                        </button>
                    </div>
                    @if ($errors->has('telp'))
                        <span class="text-sm font-medium text-gray-900 block mb-2 dark:text-gray-300">{{ $errors->first('telp') }}</span>
                    @endif
                </form>

                <form action="{{ route('changeinfo') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class='relative mb-4 flex w-full flex-wrap items-stretch'>
                        <textarea
                            name="address"
                            class="@error('address') is-invalid @enderror relative m-0 -me-px block flex-auto rounded-s border border-solid border-neutral-200 bg-transparent bg-clip-padding px-3 py-[0.25rem] text-base font-normal leading-[1.6] text-black outline-none transition duration-200 ease-in-out placeholder:text-neutral-500 focus:z-[3] focus:border-primary focus:shadow-inset focus:outline-none motion-reduce:transition-none dark:border-white/10 dark:placeholder:text-neutral-200 dark:autofill:shadow-autofill dark:focus:border-primary"
                            placeholder="Alamat"
                            aria-label="Alamat"
                            aria-describedby="button-addon2">{{ $users->address_user->address }}</textarea>
                        <button
                            class="z-[2] inline-block rounded-e border-2 border-primary-100 px-6 pb-[6px] pt-2 text-xs font-medium uppercase leading-normal text-primary-700 text-black transition duration-150 ease-in-out hover:border-primary-accent-200 hover:bg-secondary-50/50 focus:border-primary-accent-200 focus:bg-secondary-50/50 focus:outline-none focus:ring-0 active:border-primary-accent-200 dark:border-primary-400 dark:text-primary-300 dark:hover:bg-blue-950 dark:focus:bg-blue-950 dark:text-black"
                            data-twe-ripple-init
                            type="submit"
                            id="button-addon2">change</button>
                    </div>
                    @if ($errors->has('address'))
                        <span class="text-sm font-medium text-gray-900 block mb-2 dark:text-gray-300">{{ $errors->first('address') }}</span>
                    @endif
                </form>
            </div>
        </div>
    </div>
@endsection