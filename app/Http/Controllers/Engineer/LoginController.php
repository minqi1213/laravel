<?php

namespace App\Http\Controllers\Engineer;

use Illuminate\Http\Request;

use App\Http\Requests;

require_once 'resources/org/code/Code.class.php';

class LoginController extends CommonController
{
    public function login()
    {
        return view('engineer.login');
    }

    public function code()
    {
        $code = new \Code();
        $code->make();
    }

    public function getcode()
    {
        $code = new \Code();
        echo $code->get();
    }
}
