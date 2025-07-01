<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CoinInfo extends Model
{
    use HasFactory;

    protected $guarded;
    protected $table = 'coin_info';
}
