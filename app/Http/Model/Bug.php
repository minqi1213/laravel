<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class Bug extends Model
{
    protected $table = 'bug';
    protected $primaryKey = 'bid';
    public $timestamps = false;
}
