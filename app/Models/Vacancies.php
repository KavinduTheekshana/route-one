<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vacancies extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'company',
        'title',
        'location',
        'job_type',
        'meta_description',
        'description',
        'salary',
        'tags',
        'experience',
        'file_path',
        'featured',
        'urgent',
    ];


}
