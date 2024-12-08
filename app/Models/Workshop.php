<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Workshop extends Model
{
    //
    use HasFactory;

    protected $casts = [
        'date' => 'datetime',
        'objectives' => 'array'
    ];

    protected $fillable = [
        'name',
        'description',
        'objectives',
        'date',
        'duration',
        'price',
        'vc_link',
        'instructor_id'
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_workshops', 'workshop_id', 'user_id')
            ->withTimestamps();
    }

    public function topics()
    {
        return $this->belongsToMany(Topic::class, 'workshop_topics', 'workshop_id', 'topic_id');
    }

    public function instructor()
    {
        return $this->belongsTo(User::class, 'instructor_id');
    }

    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function materials()
    {
        return $this->hasMany(Material::class);
    }

    public function averageRating()
    {
        return $this->ratings()->avg('rate');
    }

    public function ratingsCount()
    {
        return $this->ratings()->count() ?? 0;
    }

    public function reviewsCount()
    {
        return $this->reviews()->count() ?? 0;
    }

    public function usersCount()
    {
        return $this->users()->count() ?? 0;
    }
}
