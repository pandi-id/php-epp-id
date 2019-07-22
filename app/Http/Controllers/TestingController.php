<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\EppConnection;

class TestingController extends Controller
{
    public function eppconn($target){
        $epp = new EppConnection;
        $epp_client = $epp->loginEpp($target,true);
        $epp->logoutEpp($epp_client);
        dd($epp_client);
    }
}
