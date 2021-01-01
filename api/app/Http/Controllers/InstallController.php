<?php

namespace App\Http\Controllers;
use Dspurl\Install\Install;
use Illuminate\Http\Request;
class InstallController extends Controller
{
    public function test(Request $request){
        $a = (new Install())->test_rtn('Aex');
        print_r($a);
        exit;
    }
}
