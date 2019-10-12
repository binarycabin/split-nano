@extends('layouts.dashboard.app')

@section('content')

    @component('components.layout.dashboard.title')
        Address Groups - {{ $addressGroup->name }}
    @endcomponent

    <div class="container mx-auto px-4">

        <div class="mb-8 mt-8">
            <div class="bg-white p-4">
                <div class="md:flex justify-between">
                    <div class="mb-4">
                        <h2 class="text-2xl font-bold">{{ $addressGroup->name }}</h2>
                    </div>
                    <div class="text-right mb-4">
                        <a href="{{ url('/account/address-group/'.$addressGroup->uuid.'/edit') }}" class="btn btn-primary">Edit Group</a>
                    </div>
                </div>

                <h3 class="text-lg font-bold mb-4">Your group address is:</h3>

                <div class="bg-gray-800 text-green-200 text-center p-4 shadow rounded text-lg font-bold mb-4 break-all">
                    {{ $addressGroup->address }}
                </div>

                <p>Any balance sent to the address above will be split and redirected to:</p>

                <div>
                    @foreach($addressGroup->items_object as $item)
                        <div class="p-4 border shadow">
                            <div class="md:flex justify-between">
                                <div class="font-bold mb-2">{{ $item->label }}</div>
                                <div class="text-right mb-2"><span class="inline-block rounded bg-blue-200 rounded p-1 text-sm">{{ $item->percentage }}%</span></div>
                            </div>
                            <div class="text-xs text-gray-600 break-all">{{ $item->address }}</div>
                        </div>
                    @endforeach
                </div>

            </div>
        </div>

        <div class="mb-8 mt-8">
            <div class="bg-white p-4">
                <div class="md:flex justify-between">
                    <div class="mb-4">
                        <h2 class="text-2xl font-bold">Ready to test?</h2>
                    </div>
                </div>

                <p class="mb-2">Paste your address above into one of these Nano faucets to get some nano and test your forwarding:</p>
                <p>
                    <a href="https://nanofaucet.org/" target="_blank" class="underline font-bold">nanofaucet.org</a> |
                    <a href="https://nano-faucet.org/" target="_blank" class="underline font-bold">nano-faucet.org</a> |
                    <a href="https://www.freenanofaucet.com" target="_blank" class="underline font-bold">freenanofaucet.com</a> |
                    <a href="https://www.alilnano.com" target="_blank" class="underline font-bold">alilnano.com</a>
                </p>
            </div>
        </div>

        <div class="mb-8 mt-8">
            <div class="bg-white p-4">
                <h2 class="text-lg mb-4 font-bold">History: <small><a href="{{ url('/account/address-group/'.$addressGroup->uuid) }}" class="text-sm underline text-gray-600">(Refresh)</a></small></h2>
                @if($addressGroup->account->nodeTransactions->count() == 0)
                    <p>This account has not received any nano yet.</p>
                @endif
                @foreach($addressGroup->account->nodeTransactions as $nodeTransaction)
                    <div class="p-4 border mb-1">
                        <div class="md:flex justify-between">
                            <div class="md:w-1/4">
                                <div><strong>Amount:</strong></div>
                                {{ number_format(\BinaryCabin\NanoUnits\NanoUnits::convert('raw','ticker', $nodeTransaction->amount),6,'.','') }}
                            </div>
                            <div class="md:w-1/2">
                                <div><strong>Destination:</strong></div>
                                <span class="text-xs break-all">{{ $nodeTransaction->destination_address }}</span>
                            </div>
                            <div class="md:w-1/4">
                                <div><strong>Status:</strong></div>
                                @if(empty($nodeTransaction->hash))
                                    <span class="text-yellow-800">Preparing Send...</span>
                                @else
                                    <a href="https://nanocrawler.cc/explorer/block/{{ $nodeTransaction->hash }}" target="_blank" class="text-green-600 underline font-bold">Sent!</a>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

    </div>

@endsection