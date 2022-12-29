<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory;

    public function owner()
    {
        return $this->belongsTo(Owner::class, 'owner_id');
    }

    public function driver()
    {
        return $this->belongsTo(Driver::class, 'driver_id');
    }

    public function type_vehicle()
    {
        return $this->belongsTo(TypeVehicle::class, 'type_vehicle_id');
    }
}
