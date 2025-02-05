<?php

namespace App\Models;

use App\Models\Cooperative;
use App\Models\Participant;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class GARegistration extends Model
{
    use HasFactory;

    protected $primaryKey = 'registration_id';
    protected $fillable = ['coop_id', 'participant_id', 'status', 'payment_status'];

    public function cooperative()
    {
        return $this->belongsTo(Cooperative::class, 'coop_id');
    }

    public function participant()
    {
        return $this->belongsTo(Participant::class, 'participant_id');
    }
}

