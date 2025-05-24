<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'image',
        'role'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
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

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [
            'exp' => now()->addMinutes(60)->timestamp,
            'role' => $this->role,
        ];
    }

    public function teachingClasses()
    {
        return $this->hasMany(ClassModel::class, 'teacher_id');
    }

    public function classes()
    {
        return $this->belongsToMany(ClassModel::class, 'class_user', 'student_id', 'class_id')
                    ->withTimestamps();
    }

    public function classUsers()
    {
        return $this->hasMany(ClassUser::class, 'student_id');
    }

    
    use Notifiable;

    // ... các thuộc tính khác, fillable, hidden ...

    // Kiểm tra role
    public function isStudent()
    {
        return $this->role === 'student';
    }

    public function isTeacher()
    {
        return $this->role === 'teacher';
    }

    // Quan hệ đã gửi thông báo
    public function sentNotifications()
    {
        return $this->hasMany(Notification::class, 'sender_id');
    }

    // Quan hệ đã nhận thông báo
    public function receivedNotifications()
    {
        return $this->hasMany(Notification::class, 'receiver_id');
    }

}