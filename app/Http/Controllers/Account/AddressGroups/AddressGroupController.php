<?php

namespace App\Http\Controllers\Account\AddressGroups;

use App\Account;
use App\AddressGroup;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AddressGroupController extends Controller
{

    public function create()
    {
        return view('account.address-group.create', []);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);
        $account = Account::getUnused();
        $addressGroup = AddressGroup::create([
            'name' => $request->input('name'),
            'user_id' => Auth::user()->id,
            'address' => $account->address,
        ]);
        return redirect('/account/address-group/' . $addressGroup->uuid . '/edit')->withSuccess('Saved!');
    }

    public function edit($addressGroupKey)
    {
        $addressGroup = AddressGroup::findByUuid($addressGroupKey);
        return view('account.address-group.edit', ['addressGroup' => $addressGroup]);
    }

    public function update(Request $request, $addressGroupKey)
    {
        $this->validate($request, [
            'name' => 'required',
            'items' => 'required',
        ]);
        $items = json_decode($request->input('items'));
        //TODO - validation
        $items = json_encode($items);
        $addressGroup = AddressGroup::findByUuid($addressGroupKey);
        $addressGroup->update([
            'name' => $request->input('name'),
            'items' => $items,
        ]);
        return redirect('/account/address-group/' . $addressGroup->uuid . '/edit')->withSuccess('Saved!');
    }

}