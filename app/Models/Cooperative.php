<?php

namespace App\Models;

use App\Models\User;
use App\Models\Participant;
use App\Models\Notification;
use App\Models\UploadedDocument;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cooperative extends Model
{
    use HasFactory;

    protected $primaryKey = 'coop_id';
    protected $fillable = [
        'name', 'contact_person', 'type', 'address', 'region', 'phone_number',
        'email', 'tin', 'coop_identification_no', 'bod_chairperson',
        'general_manager_ceo', 'total_asset',
        'total_income', 'cetf_remittance', 'cetf_required', 'cetf_balance',
        'share_capital_balance', 'no_of_entitled_votes', 'services_availed'
    ];

    public function participants()
    {
        return $this->hasMany(Participant::class, 'coop_id');
    }

    public function uploadedDocuments()  // Keeping this one, remove `documents()`
    {
        return $this->hasMany(UploadedDocument::class, 'coop_id');
    }

    public function notifications()
    {
        return $this->hasMany(Notification::class, 'coop_id');
    }

    public function gaRegistration()
    {
        return $this->hasOne(GARegistration::class, 'coop_id', 'coop_id');
    }

    public function users()
    {
        return $this->hasMany(User::class, 'coop_id', 'coop_id');
    }
}

