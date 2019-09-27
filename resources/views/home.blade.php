@extends('layouts.single')

@section('content')
    <div class="p-10 bg-gray-200 w-full h-screen flex flex-wrap flex-col content-center m-auto justify-center">
        <div class="bg-white w-full lg:w-1/3 px-6 py-16 border border-gray-300 rounded-lg py-2 px-4 block w-1/2">
            You are logged in!

            <div class="" aria-labelledby="navbarDropdown">
                <a class="" href="{{ route('logout') }}"
                   onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                    {{ __('Logout') }}
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST">
                    @csrf
                </form>
            </div>
        </div>
    </div>
@endsection
