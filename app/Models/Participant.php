<?php

namespace App\Models;

use App\Models\User;
use App\Models\Cooperative;
use App\Models\GARegistration;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Participant extends Model
{
    use HasFactory;

    protected $primaryKey = 'participant_id';
    protected $fillable = [
        'coop_id', 'user_id', 'first_name', 'middle_name', 'last_name', 'email', 'nickname', 'gender',
        'phone_number', 'designation', 'congress_type', 'religious_affiliation',
        'tshirt_size', 'is_msp_officer', 'msp_officer_position', 'delegate_type','reference_number','voting_status'
    ];

    public function cooperative()
    {
        return $this->belongsTo(Cooperative::class, 'coop_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id'); 
    }

    public function gaRegistrations()
{
    return $this->hasMany(GARegistration::class, 'coop_id', 'coop_id');
}


    public function registration()
    {
        return $this->hasOne(GARegistration::class, 'participant_id');
    }

    public function documents()
    {
        return $this->hasMany(UploadedDocument::class, 'participant_id', 'participant_id');
    }

    public function events()
    {
        return $this->belongsToMany(Event::class, 'event_participant', 'participant_id', 'event_id')
                    ->withPivot('attendance_datetime')
                    ->withTimestamps();
    }

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($participant) {
            if ($participant->user) {
                $participant->user->delete();
            }
        });
    }

}

