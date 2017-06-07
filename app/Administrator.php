<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Administrator extends Model
{
    protected $table        = 'administrator';
    protected $primaryKey   = 'username';
    public $incrementing    = false;
}
