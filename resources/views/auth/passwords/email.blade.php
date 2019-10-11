@extends('layouts.basic.app')

@section('content')

    <div class="text-white py-16">
        <div class="container mx-auto px-2">

            <div class="lg:flex">
                <div class="lg:w-3/5 mb-8 mr-4">
                    <h1 class="text-5xl mb-8 font-thin">Feeling Lost?</h1>
                    <div class="text-purple-lightest">
                        <p class="mb-1">We'll send you a password reset link.</p>
                    </div>
                </div>
                <div class="lg:w-2/5 mb-8">

                    <div class="text-black bg-white rounded shadow p-8 mb-12">
                        <div>
                            <h1 class="text-2xl mb-8 font-bold">Password Reset</h1>
                            {!! Former::open_vertical(route('password.email'))->method('POST') !!}
                            {!! Former::email('email','Email Address') !!}
                            @component('components.buttons.submit-primary')
                                Submit
                            @endcomponent
                            {!! Former::close() !!}
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>

@endsection

