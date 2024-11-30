<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    //
    use HasFactory;

    public function workshops()
    {
        return $this->belongsToMany(Workshop::class, 'workshop_topics', 'topic_id', 'workshop_id')
                    ->withTimestamps();
    }
}
