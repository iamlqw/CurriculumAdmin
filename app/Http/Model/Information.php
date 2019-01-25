<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class Information extends Model
{
    protected $table='information';
    protected $primaryKey='iid';
    public $timestamps=false;
    protected $guarded=[];
    //
}
