<?php

namespace App\Http\Controllers\Engineer;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

class ManagementController extends CommonController
{
    public function index()
    {
        return view('engineer.management.index');
    }

}
