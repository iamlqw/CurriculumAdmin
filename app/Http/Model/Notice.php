<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class Notice extends Model
{
    protected $table='notices';
    protected $primaryKey='nid';
    public $timestamps=false;
    protected $guarded=[];
    //
}
