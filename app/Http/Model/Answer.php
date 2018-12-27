<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    protected $table='answers';
    protected $primaryKey='aid';
    public $timestamps=false;
    protected $guarded=[];
    //
}
