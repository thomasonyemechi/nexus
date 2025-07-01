<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MySlot extends Model
{
    use HasFactory;


    protected $guarded;


    public function user()
    {
        return $this->belongsTo(User::class);
    }


    function slot()
    {
        return $this->belongsTo(Zone::class, 'zone_id');
    }
}
