<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    protected $table = 'activity_log';
       protected $fillable = ['*'];   
       protected static $logName = 'Casino'; 
     
       public function getUser(){
           return $this->hasOne('App\User','id','causer_id');
       }
       
    
}
