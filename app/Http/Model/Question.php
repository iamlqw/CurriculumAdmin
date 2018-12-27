<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $table='questiones';
    protected $primaryKey='qid';
    public $timestamps=false;
    protected $guarded=[];
    //
}
