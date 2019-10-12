@extends('layouts.basic.app')

@section('content')

    <div class="text-white py-16">
        <div class="container mx-auto px-2">

            <div class="lg:flex">
                <div class="lg:w-3/5 mb-8 mr-4">
                    <h1 class="text-3xl md:text-5xl mb-8 font-thin">Create an account to start</h1>
                    <div class="text-purple-lightest">
                        <p class="mb-1"></p>
                        <p></p>
                    </div>
                </div>
                <div class="lg:w-2/5 mb-8">

                    <div class="text-black bg-white rounded shadow p-8">
                        <div>
                            <h1 class="text-2xl mb-8 font-bold">Create an Account</h1>
                            {!! Former::open_vertical(route('register'))->method('POST') !!}
                            {!! Former::text('name','Your Name')->required() !!}
                            {!! Former::email('email','Email Address')->required() !!}
                            {!! Former::password('password','Desired Password')->required() !!}
                            @component('components.buttons.submit-primary')
                                Register
                            @endcomponent
                            {!! Former::close() !!}
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>

@endsection
