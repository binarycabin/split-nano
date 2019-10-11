import * as nanocurrency from 'nanocurrency';
import * as bip39 from 'bip39';

console.log('Nano Worker loaded');

let nanoAccountsToCreate = 1000;
let nanoSeed = null;
let nanoWordList = [];
let nanoAddresses = [];

self.addEventListener("message", function(e) {
    let action = e.data;
    console.log(typeof e.data);
    if(typeof e.data === 'object'){
        action = e.data.action;
    }
    console.log('Worker Received:');
    console.log(action);
    if(action === 'generateNanoSeed'){
        generateNanoSeed();
    }else if(action === 'generateNanoSecretKeys'){
        let seed = e.data.seed;
        generateNanoSecretKeys(seed);
    }else{
        console.log('Action not found:');
        console.log(action);
    }
}, false);

function generateNanoSeed(){
    nanocurrency.generateSeed().then(function(value){
        nanoSeed = value;
        console.log('Seed: '+nanoSeed);
        let mnemonic = bip39.entropyToMnemonic(nanoSeed);
        console.log('Mnemonic: '+nanoSeed);
        nanoWordList = mnemonic.split(" ");
        let postMessageData = {
            'seed': nanoSeed,
            'wordList': nanoWordList,
        };
        postMessage(postMessageData);
        generateNanoSecretKeys(nanoSeed);
    });
}

function generateNanoSecretKeys(nanoSeed){
    let nanoAccounts = [];
    console.log('Generated Secret Keys for: '+nanoSeed);
    var t0 = performance.now();
    for(let secretKeyIndex=0;secretKeyIndex<nanoAccountsToCreate;secretKeyIndex++){
        let secretKey = nanocurrency.deriveSecretKey(nanoSeed,secretKeyIndex);
        let publicKey = nanocurrency.derivePublicKey(secretKey);
        let address = nanocurrency.deriveAddress(publicKey);
        nanoAccounts.push({
            'index': secretKeyIndex,
            'secretKey': secretKey,
            'publicKey': publicKey,
            'address': address,
        });
        nanoAddresses.push(address);
        console.log('Generated Secret Key: '+secretKey+' at index: '+secretKeyIndex);
        //console.log('Generated Public Key: '+publicKey);
        console.log('Generated Address: '+address);
    }
    var t1 = performance.now();
    console.log('Done Generating');
    console.log("Generating "+nanoAccountsToCreate+" addresses took " + (t1 - t0) + " milliseconds.");
    postMessage({'accounts':nanoAccounts});
    //postMessage({'addresses':nanoAddresses});
    //this.nanoAddressesGenerated = true;
}
