<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mobile extends Model
{
    use HasFactory;
    /**
     * Get the user that owns the mobile.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
