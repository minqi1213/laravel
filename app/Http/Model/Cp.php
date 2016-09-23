<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class Cp extends Model
{
    protected $table = 'cp';
    protected $primaryKey = 'cpid';
    public $timestamps = false;
}
