<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    use HasFactory;


    // Add user_id to the fillable property
    protected $fillable = [
        'user_id',      // Allow mass assignment for user_id
        'name',
        'country',
        'phone',
        'email',
        'address',
        'dob',
        'passport',
        'agent_id',
        'status',
        'english',
    ];

    // Add relationships if necessary
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function invoices()
    {
        return $this->hasMany(Invoice::class, 'customer_id', 'user_id');
    }

    public function agent()
    {
        return $this->belongsTo(User::class, 'agent_id', 'id');
    }
}
