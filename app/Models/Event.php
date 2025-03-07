<?php

namespace App\Models;

use App\Models\Speaker;
use App\Models\Participant;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Event extends Model
{
    use HasFactory;

    protected $primaryKey = 'event_id';
    protected $fillable = ['title', 'description', 'start_date', 'end_date', 'location'];

    public function speakers()
    {
        return $this->hasMany(Speaker::class, 'event_id');
    }

    public function participants()
    {
        return $this->belongsToMany(Participant::class, 'event_participant', 'event_id', 'participant_id')
                    ->withPivot('attendance_datetime')
                    ->withTimestamps();
    }
}

