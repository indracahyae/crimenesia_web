<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Polisi extends Model
{
    protected $table        = 'polisi';
    protected $primaryKey   = 'nrp';
    public $incrementing    = false;
}
