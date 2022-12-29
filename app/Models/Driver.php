<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{
    use HasFactory;

    public function getFullNameAttribute()
    {
        return $this->first_name . ' ' . $this->second_name . ' ' . $this->last_name;
    }
}
