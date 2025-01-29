<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payslips extends Model
{
    protected $fillable = [
        'user_id',
        'date',
        'file_size',
        'file_type',
        'file_path',
        'file_original_name',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
