<?php

namespace App\Models;

use App\Models\Participant;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $primaryKey = 'user_id'; // Ensure consistency with migration
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'name',
        'coop_id',
        'email',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function participant()
    {
        return $this->hasOne(Participant::class, 'user_id'); // The foreign key is 'user_id' in the Participant table
    }

    public function cooperative()
    {
        return $this->belongsTo(Cooperative::class, 'coop_id', 'coop_id');
    }

}
