@extends('layouts.dashboard.app')

@section('content')

    @component('components.layout.dashboard.title')
        Admin - Generate Accounts
    @endcomponent

        <div class="container mx-auto px-2 py-16">
            <div class="bg-white p-8 shadow">
                <h2 class="text-xl font-bold mb-2">You currently have {{ $accountsCount }} Accounts already in your database</h2>
                {!! Former::open('/manage/account/generate')->method('POST') !!}
                <p class="mb-4">We are generating a list of 1,000 accounts for seed: ...{{ substr(config('split.nano.seed'),0,5) }}</p>
                {!! Former::textarea('accounts','Accounts Data')->id('accountsInput')->value('loading... this may take a few minutes...') !!}
                <button type="submit" class="btn btn-primary" disabled="disabled" id="createAccountsButton">Create Accounts</button>
                {!! Former::close() !!}

                <script>
                    window.nanoSeed = "{{ config('split.nano.seed') }}";
                    console.log('INIT FOR SEED: '+window.nanoSeed);
                    window.nanoWordList = [];
                    window.nanoAddresses = [];
                    window.nanoWorker = new Worker('/js/workers/nano-worker.js');
                    window.nanoWorker.onmessage = function(e) {
                        console.log('Message received from worker');
                        console.log(e.data);
                        if(e.data.hasOwnProperty('seed')){
                            window.nanoSeed = e.data.seed;
                        }
                        if(e.data.hasOwnProperty('wordList')){
                            window.nanoWordList = e.data.wordList;
                        }
                        if(e.data.hasOwnProperty('accounts')){
                            window.nanoAddresses = e.data.accounts;
                            console.log(window.nanoAddresses.length);
                            let accounts = e.data.accounts;
                            let postData = [];
                            for(var i=0;i<accounts.length;i++){
                                postData.push({
                                    'address': accounts[i].address,
                                    'seed_index': accounts[i].index,
                                    'public_key': accounts[i].publicKey,
                                    'secret_key': accounts[i].secretKey,
                                });
                            }
                            let addresses = JSON.stringify(postData);
                            document.getElementById('accountsInput').value = addresses;
                            document.getElementById('createAccountsButton').disabled = false;
                        }
                    };
                    console.log(window.nanoWorker);
                    //window.nanoWorker.postMessage('generateNanoSeed');
                    window.nanoWorker.postMessage({
                        action: 'generateNanoSecretKeys',
                        seed: window.nanoSeed
                    });
                </script>

            </div>
        </div>

@endsection