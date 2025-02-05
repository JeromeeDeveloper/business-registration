<?php

namespace App\Models;

use App\Models\Event;

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Speaker extends Model
{
    use HasFactory;

    protected $primaryKey = 'speaker_id';
    protected $fillable = ['name', 'topic', 'event_id'];

    public function event()
    {
        return $this->belongsTo(Event::class, 'event_id');
    }
}
