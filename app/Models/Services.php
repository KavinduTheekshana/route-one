<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Services extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'service_name',
        'price',
        'currency',
        'description',
    ];
}
