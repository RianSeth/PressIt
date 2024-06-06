<div 
    class="fixed flex justify-center items-center mx-auto z-40 top-0 left-0 w-full h-screen"
    role="dialog"
    tabindex="-1"
    x-show="registerOpen"
    x-on:click.away="registerOpen = false"
    x-cloak
    x-transition
    >
    <div x-on:click="registerOpen = false" class="fixed left-0 top-0 w-full h-screen bg-black/50"></div>
    <form action="{{ route('store') }}" method="post" class="max-w-max mx-auto z-50 flex flex-row gap-1 justify-center">
        @csrf
        <div class="w-96 bg-white shadow-md border border-gray-200 rounded-lg p-4 sm:p-6 lg:p-8 dark:bg-gray-800 dark:border-gray-700">
            <div class="space-y-6" >
                <h3 class="text-xl font-medium text-gray-900 dark:text-white">Register</h3>

                <div>
                    <label for="name" class="text-sm font-medium text-gray-900 block mb-2 dark:text-gray-300">Your Name</label>
                    <input type="text" name="name" id="name" class="@error('name') is-invalid @enderror bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="name here" required value="{{ old('name') }}">
                    @if ($errors->has('name'))
                        <span class="text-sm font-medium text-gray-900 block mb-2 dark:text-gray-300">{{ $errors->first('name') }}</span>
                    @endif
                </div>

                <div>
                    <label for="email" class="text-sm font-medium text-gray-900 block mb-2 dark:text-gray-300">Email Address</label>
                    <input type="email" name="email" id="email" class="@error('email') is-invalid @enderror bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="name@company.com" required value="{{ old('email') }}">
                    @if ($errors->has('email'))
                        <span class="text-sm font-medium text-gray-900 block mb-2 dark:text-gray-300">{{ $errors->first('email') }}</span>
                    @endif
                </div>

                <div>
                    <label for="password" class="text-sm font-medium text-gray-900 block mb-2 dark:text-gray-300">Password</label>
                    <input type="password" name="password" id="password" placeholder="••••••••" class="@error('password') is-invalid @enderror bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required>
                    @if ($errors->has('password'))
                        <span class="text-sm font-medium text-gray-900 block mb-2 dark:text-gray-300">{{ $errors->first('password') }}</span>
                    @endif
                </div>

                <div>
                    <label for="password_confirmation" class="text-sm font-medium text-gray-900 block mb-2 dark:text-gray-300">Confirm Password</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" placeholder="••••••••" class="@error('password') is-invalid @enderror bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required>
                </div>

                <button x-on:click="regisDetail = !regisDetail" class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    Next
                </button>
                <p class="text-sm font-light text-gray-500 dark:text-gray-400">
                    Have an account? <button x-on:click="loginOpen = true, registerOpen = false" class="font-medium text-primary-600 hover:underline dark:text-primary-500">Login</button>
                </p>
            </div>
        </div>
        
        <div x-show="regisDetail" class="w-96 bg-white shadow-md border border-gray-200 rounded-lg p-4 sm:p-6 lg:p-8 dark:bg-gray-800 dark:border-gray-700">
            <div class="space-y-6" >
                <h3 class="text-xl font-medium text-gray-900 dark:text-white">Your Detail Address</h3>

                <div>
                    <label for="telp" class="text-sm font-medium text-gray-900 block mb-2 dark:text-gray-300">Telephone</label>
                    <input type="number" name="telp" id="telp" class="@error('telp') is-invalid @enderror bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="08xxxxxxxxxx" required value="{{ old('telp') }}" maxlength="13" oninput="if(this.value.length > 13) this.value = this.value.slice(0, 13);"">
                    @if ($errors->has('telp'))
                        <span class="text-sm font-medium text-gray-900 block mb-2 dark:text-gray-300">{{ $errors->first('telp') }}</span>
                    @endif
                </div>

                <div>
                    <label for="address" class="text-sm font-medium text-gray-900 block mb-2 dark:text-gray-300">Detail Address</label>
                    <textarea name="address" id="address" class="@error('address') is-invalid @enderror bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required>{{ old('address') }}</textarea>
                    @if ($errors->has('address'))
                        <span class="text-sm font-medium text-gray-900 block mb-2 dark:text-gray-300">{{ $errors->first('address') }}</span>
                    @endif
                </div>

                <input type="submit" class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" value="Register">
            </div>
        </div>
    </form>
</div>