<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;

class DashboardController extends Controller {

    public function show(){
        $addressGroups = \Auth::user()->addressGroups;
        return view('dashboard.show',['addressGroups'=>$addressGroups]);
    }

}