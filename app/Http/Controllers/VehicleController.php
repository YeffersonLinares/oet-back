<?php

namespace App\Http\Controllers;

use App\Models\Driver;
use App\Models\Owner;
use App\Models\TypeVehicle;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class VehicleController extends Controller
{

    public function index()
    {
        return $vehicles = Vehicle::with(['owner', 'driver', 'type_vehicle'])->get();
    }

    public function params()
    {
        $owners = Owner::get();
        $drivers = Driver::get();
        $type_vehicles = TypeVehicle::get();

        return response()->json([
            'owners' => $owners,
            'drivers' => $drivers,
            'type_vehicles' => $type_vehicles,
        ]);
    }

    public function report()
    {
        return Vehicle::select(['id', 'plate', 'brand', 'owner_id', 'driver_id'])
            ->with(['owner:id,first_name,second_name,last_name', 'driver:id,first_name,second_name,last_name'])
            ->get();
    }

    public function val_store($request)
    {
        $rules = [
            'plate' => 'required|max:60',
            'color' => 'required|max:30',
            'brand' => 'required|max:50',
            'owner_id' => 'required|numeric',
            'driver_id' => 'required|numeric',
            'type_vehicle_id' => 'required|numeric',
        ];

        $validator = Validator::make($request->all(), $rules);

        if (!empty($validator->fails())) {
            return [
                'code' => 422,
                'msg' => $validator->errors()->first(),
            ];
        }
        return [
            'code' => 200
        ];
    }

    public function store(Request $request)
    {
        $validator = $this->val_store($request);
        if ($validator['code'] == 422) return $validator;

        $vehicle = new Vehicle();
        $this->save($vehicle, $request);

        return response()->json([
            'code' => 200,
            'msg' => 'Datos guardados con éxito',
        ]);
    }

    public function update(Vehicle $vehicle, Request $request)
    {
        $validator = $this->val_store($request);
        if ($validator['code'] == 422) return $validator;

        $this->save($vehicle, $request);
        return response()->json([
            'code' => 200,
            'msg' => 'Datos guardados con éxito',
        ]);
    }

    public function save($vehicle, $request)
    {
        foreach ($request->all() as $key => $value) :
            $vehicle[$key] = $value;
        endforeach;
        $vehicle->save();
    }
}
