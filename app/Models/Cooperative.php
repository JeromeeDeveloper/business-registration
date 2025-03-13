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
        'name',
        'contact_person',
        'type',
        'address',
        'region',
        'phone_number',
        'email',
        'tin',
        'coop_identification_no',
        'bod_chairperson',
        'general_manager_ceo',
        'total_asset',
        'loan_balance',
        'total_overdue',
        'time_deposit',
        'accounts_receivable',
        'savings',
        'net_surplus',
        'cetf_due_to_apex',
        'additional_cetf',
        'cetf_undertaking',
        'full_cetf_remitted',
        'registration_date_paid',
        'registration_fee',
        'total_income',
        'cetf_remittance',
        'cetf_required',
        'cetf_balance',
        'share_capital_balance',
        'no_of_entitled_votes',
        'services_availed',
        'total_remittance',
        'ga_remark',
        'reg_fee_payable',
        'net_required_reg_fee',
        'total_reg_fee',
        'less_cetf_balance',
        'less_prereg_payment'
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

