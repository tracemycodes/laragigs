<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Listing extends Model
{
    use HasFactory;

    // protected $fillable = ['title', 'description', 'company', 'location', 'website', 'tags', 'email'];

    public function scopeFilter($query, string $filters)
    {
        if ($filters ?? false) {
            $query->where('tags', 'like', '%' . request('tag') . '%');
        }

        if ($filters ?? false) {
            $query->where('title', 'like', '%' . request('search') . '%')->orwhere('description', 'like', '%' . request('search') . '%')->orwhere('tags', 'like', '%' . request('search') . '%');
        }
    }

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }
}
