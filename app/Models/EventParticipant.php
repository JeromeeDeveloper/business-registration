<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventParticipant extends Model
{
    use HasFactory;

    protected $table = 'event_participant'; // important for pivot table
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = [
        'event_id',
        'participant_id',
        'attendance_datetime',
    ];

    // Relationships (optional)
    public function event()
    {
        return $this->belongsTo(Event::class, 'event_id');
    }

    public function participant()
    {
        return $this->belongsTo(Participant::class, 'participant_id');
    }
}
