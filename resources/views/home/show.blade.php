@extends('layouts.basic.app')

@section('content')

    <div class=" text-white py-16">
        <div class="container mx-auto px-2">
            <div class="flex flex-col md:flex-row">
                <div class="md:w-3/5 md:pr-8 pb-8">
                    <img src="{{ url('/img/undraw_good_team_m7uu.svg') }}"/>
                </div>
                <div class="md:w-2/5 pb-8 md:pb-0 text-center md:text-left">
                    <h1 class="mb-8 font-black text-3xl md:text-5xl">Work Together.<br/>Get Paid Together.</h1>
                    <h2 class="mb-8 font-thin">
                        <div>Have nano payments sent to a single address, then automatically split between your team</div>
                    </h2>
                    <div class="md:flex justify-between">
                        <a href="{{ url('/register') }}" class="no-underline btn bg-blue-700 shadow inline-block px-8 py-3 text-white rounded-full text-2xl font-bold hover:text-blue-600 hover:bg-white">Give it a try</a>
                        <a href="https://www.youtube.com/watch?v=qFLOTjrL7tU&feature=youtu.be" target="_blank" class="no-underline btn shadow inline-block px-8 py-3 text-white rounded-full text-2xl font-bold hover:text-blue-600 hover:bg-white">Watch a preview</a>
                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection