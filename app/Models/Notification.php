<?php

namespace App\Models;

use App\Models\Cooperative;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Notification extends Model
{
    use HasFactory;

    protected $primaryKey = 'notification_id';
    protected $fillable = ['coop_id', 'message', 'notification_type', 'status'];

    public function cooperative()
    {
        return $this->belongsTo(Cooperative::class, 'coop_id');
    }
}

