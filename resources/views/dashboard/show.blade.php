@extends('layouts.dashboard.app')

@section('content')

    @component('components.layout.dashboard.title')
        Dashboard
    @endcomponent

    @if($addressGroups->count() == 0)

        <div class="container mx-auto px-2 py-16">
            <div class="bg-white p-8 shadow text-center">
                <h2 class="mb-6 text-2xl font-black">You haven't created any address groups yet!</h2>
                <h3 class="mb-6">Address Groups represent your team or list of multiple accounts that payments will split between</h3>
                <p>
                    @component('components.buttons.link-primary',['url'=>url('/account/address-group/create')])
                        Create a new group
                    @endcomponent
                </p>
            </div>
        </div>

    @else
        <div class="container mx-auto px-2 py-16">

            <div class="mb-8">
                @component('components.buttons.link-primary',['url'=>url('/account/address-group/create')])
                    Create a new address group
                @endcomponent
            </div>

            <h2 class="text-2xl font-bold mb-2">My Groups:</h2>

            @foreach($addressGroups as $addressGroup)
                <div class="shadow p-4 border mb-1 bg-white rounded">
                    <div class="mb-2">
                        <a href="{{ url('/account/address-group/'.$addressGroup->uuid.'/edit') }}" class="font-bold">{{ $addressGroup->name }}</a>
                    </div>
                    <div class="mb-2">
                        <div class="bg-gray-800 text-green-200 text-left p-2 shadow rounded font-bold">
                            <span class="text-xs break-all">{{ $addressGroup->address }}</span>
                        </div>
                    </div>
                    <div class="mb-2">
                        Forwarding to {{ count($addressGroup->items_object) }} addresses
                    </div>
                    <div>
                        <a href="{{ url('/account/address-group/'.$addressGroup->uuid) }}" class="btn btn-primary">View and Edit</a>
                    </div>
                </div>
            @endforeach

        </div>

    @endif

@endsection