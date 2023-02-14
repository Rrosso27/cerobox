<?php

namespace App\Http\Controllers;

use App\Models\Services;
use Illuminate\Http\Request;
use Validator;

class ServicesController extends Controller
{
    // Validar datos
    public function validator(Request $request)
    {
        try {
            $id = $request->input('id');
            $img = $request->input('img');
            $typeService = $request->input('typeService');
            $startDate = $request->input('startDate');
            $endDate = $request->input('endDate');
            $observations = $request->input('observations');
            $customerId = $request->input('customerId');

            $validator = Validator::make(
                $request->all(),
                [
                    'img' => 'required|max:60',
                    'typeService' => 'required',
                    'startDate' => 'required',
                    'endDate' => 'required',
                    'observations' => 'required',
                    'customerId' => 'required'
                ]
            );

            if ($validator->fails()) {
                $message = [
                    "type" => "error",
                    "message" => "Todos los campos son necesarios",
                ];
            } else {
                $data = [
                    'id' => $id,
                    'img' => $img,
                    'typeService' => $typeService,
                    'startDate' => $startDate,
                    'endDate' => $endDate,
                    'observations' => $observations,
                    'customerId' => $customerId,
                ];


                if ($this->createUpdate($data)) {
                    $message = [
                        "type" => "succes",
                        "message" => "La operación se realizó con éxito ",
                    ];
                } else {
                    $message = [
                        "type" => "error",
                        "message" => "Fallo de sistema ",
                    ];
                }


            }
        } catch (\Throwable $th) {
            $message = [
                "type" => "error",
                "message" => $th,
            ];
        }

        return response()->json($message);
    }



    // validar acción (crear o actualizar)
    public function createUpdate($data)
    {
        try {
            if ($data['id'] == null) {
                if ($this->create($data)) {
                    return true;
                } else {
                    return false;
                }
            } else {
                if ($this->update($data)) {
                    return true;
                } else {
                    return false;
                }
            }
        } catch (\Throwable $th) {
            return false;
        }
    }


    //Crear servicio 
    public function create($data)
    {
        try {

            Services::create(
                [
                    'img' => $data['img'],
                    'type_service' => $data['typeService'],
                    'start_date' => $data['startDate'],
                    'end_date' => $data['endDate'],
                    'observations' => $data['observations'],
                    'customer_id' => $data['customerId'],
                ]
            );

            return true;

        } catch (\Throwable $th) {
            return false;
        }
    }


    // Actualizar servicio 
    public function update($data)
    {
        try {
            Services::where('id', $data['id'])->update([
                'img' => $data['img'],
                'type_service' => $data['typeService'],
                'start_date' => $data['startDate'],
                'end_date' => $data['endDate'],
                'observations' => $data['observations'],
                'customer_id' => $data['customerId'],
            ]);
            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }

    // Eliminar servicio 
    public function delete($id)
    {
        try {
            $services = Services::find($id);
            $services->delete();

            $message = [
                "type" => "succes",
                "message" => "La operación se realizó con éxito ",
            ];
        } catch (\Throwable $th) {
            $message = [
                "type" => "error",
                "message" => "Fallo de sistema ",
            ];
        }


        return response()->json($message);

    }

}