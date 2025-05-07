<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Option extends Model
{

    public function poll() {
        $this->belongsTo(Vote::class);
    }
    public function votes() {
        return $this->hasMany(Vote::class);
    }


}
