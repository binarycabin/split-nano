<?php

namespace App\Http\Controllers\Account\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller {

    public function edit(){
        return view('account.user.edit');
    }

    public function update(Request $request){
        $user = \Auth::user();
        $user->update($request->only([
            'name',
            'email',
        ]));
        if(!empty($request->password)){
            $user->password = \Hash::make($request->password);
            $user->save();
        }
        return redirect('/account/user')->withSuccess('Saved!');
    }

}