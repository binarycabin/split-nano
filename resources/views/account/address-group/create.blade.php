@extends('layouts.dashboard.app')

@section('content')

    @component('components.layout.dashboard.title')
        Address Groups - Create
    @endcomponent

    <div class="container mx-auto px-4">

        <div class="mb-8 mt-8">

            <div class="bg-white p-4">
                {!! Former::open('/account/address-group')->method('POST') !!}
                {!! Former::text('name','Group Name')->help('Choose a name for your team or group. ie: "The Avengers" or "Coinbase"') !!}
                <button type="submit" class="btn btn-primary">
                    Create Group
                </button>
                {!! Former::close() !!}

            </div>
        </div>

    </div>

@endsection