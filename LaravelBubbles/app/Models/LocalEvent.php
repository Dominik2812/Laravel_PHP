<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LocalEvent extends Model
{
    use HasFactory;
    protected $fillable=['name', 'startDateTime', 'endDateTime', 'itemId', 'eventId'];

    public function item(){
        return $this->belongsTo('App\Models\Item');
    }
}
