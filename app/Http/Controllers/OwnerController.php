<?php

namespace App\Http\Controllers;

use App\Models\Owner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OwnerController extends Controller
{

    public function index()
    {
        return $owners = Owner::get();
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

        $owner = new Owner();
        $this->save($owner, $request);

        return response()->json([
            'code' => 200,
            'msg' => 'Datos guardados con éxito',
        ]);
    }

    public function update(Owner $owner, Request $request)
    {
        $validator = $this->val_store($request);
        if ($validator['code'] == 422) return $validator;

        $this->save($owner, $request);
        return response()->json([
            'code' => 200,
            'msg' => 'Datos guardados con éxito',
        ]);
    }

    public function save($owner, $request)
    {
        foreach ($request->all() as $key => $value) :
            $owner[$key] = $value;
        endforeach;
        $owner->save();
    }
}
