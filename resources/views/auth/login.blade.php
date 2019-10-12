@extends('layouts.basic.app')

@section('content')

    <div class="text-white py-16">
        <div class="container mx-auto px-2">

            <div class="lg:flex">
                <div class="lg:w-3/5 mb-8 mr-4">
                    <h1 class="text-3xl md:text-5xl mb-8 font-thin">Welcome Back.</h1>
                    <div class="text-purple-lightest">
                        <p class="mb-1"></p>
                    </div>
                </div>
                <div class="lg:w-2/5 mb-8">

                    <div class="text-black bg-white rounded shadow p-8 mb-12">
                        <div>
                            <h1 class="text-2xl mb-8 font-bold">Login</h1>
                            {!! Former::open_vertical(route('login'))->method('POST') !!}
                            {!! Former::email('email','Email Address') !!}
                            {!! Former::password('password','Password') !!}
                            <div style="margin-bottom:10px;">
                                <label class="w-3/4 ml-auto">
                                    <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> <span class="text-sm text-grey-dark"> Keep me logged in</span>
                                </label>
                            </div>
                            @component('components.buttons.submit-primary')
                                Login
                            @endcomponent
                            {!! Former::close() !!}
                        </div>
                    </div>

                    <div class="text-sm text-purple-lighter">
                        <p class="text-right mb-4">Need an account? <a class="text-purple-lightest" href="{{ route('register') }}">Click here to sign up</a></p>
                        <p class="text-right mb-4">Trouble Logging In? <a class="text-purple-lightest" href="{{ route('password.request') }}">Reset your password</a></p>
                    </div>

                </div>
            </div>

        </div>
    </div>

@endsection