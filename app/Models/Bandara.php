<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bandara extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'kota_id'
    ];
}
