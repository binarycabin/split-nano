@extends('layouts.basic.app')

@section('content')

    <div class="text-white py-16">
        <div class="container mx-auto px-2">

            <div class="lg:flex justify-center">
                <div class="lg:w-2/5 mb-8">

                    <div class="text-black bg-white rounded shadow p-8 mb-12">
                        <div>
                            <h1 class="text-2xl mb-8 font-bold">New Password</h1>
                            {!! Former::open_vertical(route('password.update'))->method('POST') !!}
                            <input type="hidden" name="token" value="{{ $token }}">
                            {!! Former::email('email','Email Address') !!}
                            {!! Former::password('password','Desired Password')->required() !!}
                            {!! Former::password('password_confirmation','Confirm Password')->required() !!}
                            @component('components.buttons.submit-primary')
                                Save New Password
                            @endcomponent
                            {!! Former::close() !!}
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>

@endsection