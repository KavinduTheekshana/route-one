<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserNotes extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'review','admin_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function admin()
{
    return $this->belongsTo(User::class, 'admin_id');
}
}
