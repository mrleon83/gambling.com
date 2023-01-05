<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Affiliates extends Model
{
    use HasFactory;
    protected $fillable = [
        'affiliate_id',
        'name',
        'latitude',
        'longitude',
        'distance_hq'
    ];
}
