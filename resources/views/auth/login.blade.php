<div 
    class="fixed flex justify-center items-center mx-auto z-40 top-0 left-0 w-full h-screen"
    role="dialog"
    tabindex="-1"
    x-show="loginOpen"
    x-cloak
    x-transition
    >
    <div x-on:click="loginOpen = false" class="fixed left-0 top-0 w-full h-screen bg-black/50"></div>
    <div class="w-96 max-w-2xl mx-auto z-50">
        
        <div class="bg-white shadow-md border border-gray-200 rounded-lg max-w-sm p-4 sm:p-6 lg:p-8 dark:bg-gray-800 dark:border-gray-700">
            <form class="space-y-6" action="{{ route('authenticate') }}" method="post">
                @csrf
                <h3 class="text-xl font-medium text-gray-900 dark:text-white">Login</h3>
                <div>
                    <label for="email" class="text-sm font-medium text-gray-900 block mb-2 dark:text-gray-300">Email Address</label>
                    <input type="email" name="email" id="email" class="@error('email') is-invalid @enderror bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="name@company.com" required="" value="{{ old('email') }}">
                    @if ($errors->has('email'))
                        <span class="text-sm font-medium text-gray-900 block mb-2 dark:text-gray-300">{{ $errors->first('email') }}</span>
                    @endif
                </div>
                <div>
                    <label for="password" class="text-sm font-medium text-gray-900 block mb-2 dark:text-gray-300">Password</label>
                    <input type="password" name="password" id="password" placeholder="••••••••" class="@error('password') is-invalid @enderror bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required="">
                    @if ($errors->has('password'))
                        <span class="text-sm font-medium text-gray-900 block mb-2 dark:text-gray-300">{{ $errors->first('password') }}</span>
                    @endif
                </div>
                <input type="submit" class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" value="Login">
            </form>
            <p class="text-sm font-light text-gray-500 dark:text-gray-400 mt-4">
                Don’t have an account yet? <button x-on:click="loginOpen = false, registerOpen = true" class="font-medium text-primary-600 hover:underline dark:text-primary-500">Register</button>
            </p>
        </div>
    </div>
</div>