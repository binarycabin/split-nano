@extends('layouts.dashboard.app')

@section('content')

    @component('components.layout.dashboard.title')
        Address Groups - {{ $addressGroup->name }} - Edit
    @endcomponent

    <div class="container mx-auto px-4">

        <div class="mb-8 mt-8">
            <div class="bg-white p-4">
                {!! Former::open('/account/address-group/'.$addressGroup->uuid)->method('PATCH') !!}
                {!! Former::populate($addressGroup) !!}
                {!! Former::text('name','Group Name')->help('Choose a name for your team or group. ie: "The Avengers" or "Coinbase"') !!}
                <div class="mb-4">
                    Any balance sent to

                    <div class="mb-1">
                        <code class="p-2 bg-gray-800 text-green-200 text-xs break-all">{{ $addressGroup->address }}</code>
                    </div>

                    will be distributed to the accounts below:
                </div>
                <div class="mb-4">
                    <address-group-items initial-items="{{ $addressGroup->items }}"></address-group-items>
                </div>
                <button type="submit" class="btn btn-primary">
                    Save
                </button>
                {!! Former::close() !!}

            </div>
        </div>

    </div>

@endsection