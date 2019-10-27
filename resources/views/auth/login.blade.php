@extends('layouts.single')

@section('content')
    <div class="p-10 bg-gray-200 w-full h-screen flex flex-wrap flex-col content-center m-auto justify-center">
        <div class="bg-white w-full lg:w-1/3 border border-gray-300 rounded-lg block w-1/2">
            <div class="flex justify-between">
                <a href="{{ route('login') }}" class="block w-1/2 text-center p-4 hover:text-blue-500 text-2xl">Login</a>
                <a href="{{ route('register') }}" class="block w-1/2 text-center p-4 hover:text-blue-500 text-2xl bg-gray-200">Register</a>
            </div>
            <form class="mb-4 py-8 px-8" method="POST" action="{{ route('login') }}">
                @csrf
                <div class="mb-4">
                    <label for="email" class="block mb-2 text-sm text-gray-800">{{ __('E-Mail Address') }}</label>
                    <input id="email"
                           name="email"
                           class="focus:border-blue-500 appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none"
                           type="email" placeholder="jane@example.com">
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="password" class="block mb-2 text-sm text-gray-800">{{ __('Password') }}</label>
                    <input id="password"
                           name="password"
                           class="focus:border-blue-500 appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none"
                           type="password" placeholder="">
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="block md:flex items-center justify-between">

                    @if (Route::has('password.request'))
                        <a class="text-gray-600 hover:text-gray-700 no-underline block mt-3"
                           href="{{ route('password.request') }}">
                            {{ __('Forgot Your Password?') }}
                        </a>
                    @endif

                    <button type="submit"
                            class="align-middle bg-blue-500 hover:bg-blue-600 text-center px-4 py-2 text-white text-sm font-semibold rounded-lg inline-block shadow-lg">
                        LOGIN
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
