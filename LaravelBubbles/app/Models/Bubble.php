<?php

namespace App\Models;
use Spatie\GoogleCalendar\Event;
use Illuminate\Database\Eloquent\Model;

class Bubble extends Model
{
    protected $fillable=['name', 'Kind', 'localEventId']; 

    public function children(){
        return $this->hasMany('App\Models\Bubble', 'Kind');
    }
    public function childrenRecursive(){
        return $this->children()->with('childrenRecursive');
    }
    public function events(){
        return $this->belongsTo('App\Models\LocalEvent');
    }
}



