<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobApplication extends Model
{
    use HasFactory;

    protected $fillable = ['vacancies_id', 'user_id'];

    public function job()
    {
        return $this->belongsTo(Vacancies::class, 'vacancies_id');
    }
}
