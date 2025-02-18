<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    use HasFactory;

    protected $table = 'staff';

    protected $fillable = ['name', 'position', 'manager_id'];


    public function manager()
    {
        return $this->belongsTo(Staff::class, 'manager_id');
    }

    public function subordinates()
    {
        return $this->hasMany(Staff::class, 'manager_id');
    }
}
