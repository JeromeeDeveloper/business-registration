<?php

namespace App\Models;

use App\Models\Cooperative;
use App\Models\Participant;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UploadedDocument extends Model
{
    use HasFactory;

    protected $primaryKey = 'document_id';
    protected $fillable = ['coop_id', 'document_type', 'file_name', 'file_path', 'status', 'remarks'];

    public function cooperative()
    {
        return $this->belongsTo(Cooperative::class, 'coop_id');
    }

}
