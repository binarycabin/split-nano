<?php

namespace App\Http\Controllers\Manage\Accounts\Generate;

use App\Account;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Uuid;

class GenerateController extends Controller
{

    public function index(){
        return view('manage.account.generate.index');
    }



}