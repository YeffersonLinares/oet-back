<?php

namespace App\Http\Controllers;

use App\Models\Driver;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DriverController extends Controller
{

    public function index()
    {
        return $drivers = Driver::get();
    }

    public function val_store($request)
    {
        $rules = [
            'document' => 'required|max:30',
            'first_name' => 'required|max:40',
            'second_name' => 'required|max:40',
            'last_name' => 'required|max:65',
            'address' => 'required|max:100',
            'phone' => 'required|max:30',
            'city' => 'required|max:60',
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

        $driver = new Driver();
        $this->save($driver, $request);

        return response()->json([
            'code' => 200,
            'msg' => 'Datos guardados con éxito',
        ]);
    }

    public function update(Driver $driver, Request $request)
    {
        $validator = $this->val_store($request);
        if ($validator['code'] == 422) return $validator;

        $this->save($driver, $request);
        return response()->json([
            'code' => 200,
            'msg' => 'Datos guardados con éxito',
        ]);
    }

    public function save($driver, $request)
    {
        foreach ($request->all() as $key => $value) :
            $driver[$key] = $value;
        endforeach;
        $driver->save();
    }
}
