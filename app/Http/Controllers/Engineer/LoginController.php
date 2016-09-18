<?php

namespace App\Http\Controllers\Engineer;

use Illuminate\Http\Request;

use App\Http\Requests;

class LoginController extends CommonController
{
    public function login()
    {
        return view('engineer.login');
    }
}
