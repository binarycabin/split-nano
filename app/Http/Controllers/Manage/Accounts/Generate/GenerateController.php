<?php

namespace App\Http\Controllers\Manage\Accounts\Generate;

use App\Account;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Uuid;

class GenerateController extends Controller
{

    public function index()
    {
        $accountsCount = Account::count();
        return view('manage.account.generate.index', ['accountsCount' => $accountsCount]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'accounts',
        ]);
        $seedKey = substr(config('split.nano.seed'), 0, 5);
        $accounts = json_decode($request->get('accounts'));
        $addressData = [];
        foreach ($accounts as $account) {
            $addressData[] = [
                'uuid' => Uuid::generate()->string,
                'address' => $account->address,
                'seed_index' => $account->seed_index,
                'seed_key' => $seedKey,
                'public_key' => $account->public_key,
                'secret_key' => $account->secret_key,
            ];
        }

        Account::insert($addressData);

        return redirect('/dashboard')->withSuccess('Saved!');
    }

}