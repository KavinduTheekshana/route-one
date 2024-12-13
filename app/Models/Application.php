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
        'application_number'
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


    public function certificate()
    {
        return $this->hasOne(Certificate::class);
    }
    public function vacancies()
    {
        return $this->hasManyThrough(
            Vacancies::class,              // The final model you want to access
            JobApplication::class,       // The intermediate model (pivot table)
            'user_id',                   // Foreign key on `job_applications` table
            'id',                        // Foreign key on `vacancies` table
            'user_id',                   // Local key on `applications` table
            'vacancies_id'               // Local key on `job_applications` table
        );
    }
}
