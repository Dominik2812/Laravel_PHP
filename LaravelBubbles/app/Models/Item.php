<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable=['name', 'childOf', 'localEventId']; 

    public function children(){
        return $this->hasMany('App\Models\Item', 'childOf');
    }
    public function childrenRecursive(){
        return $this->children()->with('childrenRecursive');
    }
    public function events(){
        return $this->belongsTo('App\Models\LocalEvent');
    }
}
