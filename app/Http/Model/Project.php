<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $table = 'project';
    protected $primaryKey = 'pid';
    public $timestamps = false;
}
