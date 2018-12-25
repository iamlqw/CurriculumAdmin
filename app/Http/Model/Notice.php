<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class Notice extends Model
{
    protected $table='notices';
    protected $primaryKey='notice_id';
    public $timestamps=false;
    protected $guarded=[];
    //
}
