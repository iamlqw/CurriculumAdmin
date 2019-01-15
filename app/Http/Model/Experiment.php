<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class Experiment extends Model
{
    protected $table='experiments';
    protected $primaryKey='eid';
    public $timestamps=false;
    protected $guarded=[];
    //
}
