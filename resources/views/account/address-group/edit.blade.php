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
                    Any balance sent to <code class="p-2 bg-gray-800 text-green-200 text-xs">{{ $addressGroup->address }}</code> will be distributed to the accounts below:
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

        <div class="mb-8 mt-8">
            <div class="bg-white p-4">
                <h2 class="text-lg mb-4 font-bold">History:</h2>
                @if($addressGroup->account->nodeTransactions->count() == 0)
                    <p>This account has not received any nano yet.</p>
                @endif
                @foreach($addressGroup->account->nodeTransactions as $nodeTransaction)
                    <div class="p-4 border mb-1">
                        <div class="md:flex justify-between">
                            <div class="w-1/4">
                                <div><strong>Amount:</strong></div>
                                {{ $nodeTransaction->amount }}
                            </div>
                            <div class="w-1/2">
                                <div><strong>Destination:</strong></div>
                                {{ $nodeTransaction->destination_address }}
                            </div>
                            <div>
                                <div><strong>Status:</strong></div>
                                @if(empty($nodeTransaction->hash))
                                Preparing Send...
                                    @else
                                    {{ $nodeTransaction->hash }}
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

    </div>

@endsection