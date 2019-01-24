<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class Data extends Model
{
    protected $table='data';
    protected $primaryKey='did';
    public $timestamps=false;
    protected $guarded=[];
    //
    public function tree()
    {
        $data = $this->orderBy('did','asc')->get();
        return $this->getTree($data,'data_chapter','did','data_father_id',0);
    }
    public function getTree($data,$field_name,$field_id='id',$field_pid='pid',$pid=0)
    {
        $arr = array();
        foreach ($data as $k => $v) {
            if ($v->$field_pid == $pid) {
                $data[$k]["_" . $field_name] = $data[$k][$field_name];
                $arr[] = $data[$k];
                foreach ($data as $m => $n) {
                    if ($n->$field_pid == $v->$field_id) {
                        $data[$m]["_" . $field_name] = '---' . $data[$m][$field_name];
                        $arr[] = $data[$m];
                    }
                }
            }
        }
        return $arr;
    }
}
