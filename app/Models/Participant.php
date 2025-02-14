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
        'coop_id', 'user_id', 'first_name', 'middle_name', 'last_name', 'nickname', 'gender',
        'phone_number', 'designation', 'congress_type', 'religious_affiliation',
        'tshirt_size', 'is_msp_officer', 'msp_officer_position', 'delegate_type'
    ];

    public function cooperative()
    {
        return $this->belongsTo(Cooperative::class, 'coop_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id'); // A participant belongs to one user
    }

    public function uploadedDocuments()
    {
        return $this->hasMany(UploadedDocument::class, 'participant_id');
    }

    public function registration()
    {
        return $this->hasOne(GARegistration::class, 'participant_id');
    }

    public function documents()
    {
        return $this->hasMany(UploadedDocument::class, 'participant_id', 'participant_id');
    }

}

