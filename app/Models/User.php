<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'user_type',
        'country',
        'phone',
        'status',
        'agent_id',
        'password',
        'profile_image', // Add this for default profile image
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // Get sent messages
    public function sentMessages()
    {
        return $this->hasMany(Message::class, 'sender_id');
    }

    // Get received messages
    public function receivedMessages()
    {
        return $this->hasMany(Message::class, 'receiver_id');
    }
    // public function applications()
    // {
    //     return $this->hasMany(Application::class);
    // }
    public function applications()
    {
        return $this->hasMany(Application::class, 'agent_id');
    }

    public function note()
    {
        return $this->hasOne(UserNotes::class);
    }
    public function vacancies()
    {
        return $this->belongsToMany(Vacancies::class, 'job_applications', 'user_id', 'vacancies_id');
    }

    public function documents()
    {
        return $this->hasMany(Document::class);
    }
}
