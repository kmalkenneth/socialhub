<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SocialNetwork extends Model
{
    use HasFactory;


    /**
     * Get the user that owns the social network.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
