<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
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
        'role',
        'wing',
        'floor',
    ];

    public function isResident() { return $this->role === 'resident'; }
    public function isSecretary() { return $this->role === 'secretary'; }
    public function isStaff() { return $this->role === 'staff'; }

    public function complaints()
    {
        return $this->hasMany(Complaint::class, 'resident_id');
    }

    public function assignments()
    {
        return $this->hasMany(Assignment::class, 'staff_id');
    }

    public function secretaryAssignments()
    {
        return $this->hasMany(Assignment::class, 'assigned_by');
    }

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
}
