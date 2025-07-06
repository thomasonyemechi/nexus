<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{
    use HasFactory;

    protected $guarded;

    function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }


    function credit()
    {
        if ($this->type == 2) {
            return $this->belongsTo(AdminCredit::class, 'ref_id');
        } else {

        }
    }


    // function user()
    // {
    //     return $this->belongsTo(User::class, 'user_id');
    // }

}
