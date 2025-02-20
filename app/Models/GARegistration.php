<?php

namespace App\Models;

use App\Models\Cooperative;
use App\Models\Participant;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class GARegistration extends Model
{
    use HasFactory;

    protected $table = 'ga_registrations'; // Explicitly set the correct table name
    protected $primaryKey = 'registration_id';
    public $timestamps = true; // Ensures Laravel manages created_at and updated_at timestamps

    protected $fillable = [
        'coop_id',
        'participant_id',
        'date_submitted',
        'delegate_type',
        'registration_status',
        'membership_status',
    ];


    public function cooperative()
    {
        return $this->belongsTo(Cooperative::class, 'coop_id', 'coop_id');
    }

    public function participant()
    {
        return $this->belongsTo(Participant::class, 'participant_id', 'participant_id');
    }
}
