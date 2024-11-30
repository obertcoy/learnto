<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    //
    public function workshop()
    {
        return $this->belongsTo(Workshop::class);
    }
}
