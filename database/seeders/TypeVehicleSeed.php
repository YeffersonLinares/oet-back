<?php

namespace Database\Seeders;

use App\Models\TypeVehicle;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TypeVehicleSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = ['Particular', 'Público'];

        foreach ($data as $key => $value) {
            $type = new TypeVehicle();
            $type->name = $value;
            $type->save();
        }
    }
}
