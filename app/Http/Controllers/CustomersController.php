<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customers;
use Validator, DB;

class CustomersController extends Controller
{

    //Listado de clientes 
    public function index()
    {
        $customers = Customers::all();
    }


    // Validar datos
    public function validator(Request $request)
    {
        try {



            $id = $request->input('id');
            $name = $request->input('name');
            $document = $request->input('document');
            $email = $request->input('email');
            $telephone = $request->input('telephone');
            $observations = $request->input('observations');

            $validator = Validator::make(
                $request->all(),
                [
                    'name' => 'required|max:60',
                    'document' => 'required',
                    'email' => 'required',
                    'telephone' => 'required',
                    'observations' => 'required',
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
                    'name' => $name,
                    'document' => $document,
                    'email' => $email,
                    'telephone' => $telephone,
                    'observations' => $observations,
                ];

                if (($this->validateEmail($email) || $this->validateDocument($document)) && $id == "") {
                    $message = [
                        "type" => "error",
                        "message" => "El correo o el documento ya están registrados en el sistema ",
                    ];
                } else {
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

            }
        } catch (\Throwable $th) {
            $message = [
                "type" => "error",
                "message" => "Fallo de sistema ",
            ];
        }

        return response()->json($message);

    }





    // validar acción (crear o actualizar)
    public function createUpdate($data)
    {
        try {

            if (gettype($data) == 'array') {

                if ($data['id'] == '') {
                    echo $data['id'];
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

            } else {
                return true;
            }
        } catch (\Throwable $th) {
            return false;
        }

    }

    //Crear cliente  
    public function create($data)
    {
        try {

            Customers::create(
                [
                    'name' => $data['name'],
                    'document' => $data['document'],
                    'email' => $data['email'],
                    'telephone' => $data['telephone'],
                    'observations' => $data['observations'],
                ]
            );

            return true;

        } catch (\Throwable $th) {
            return false;

        }
    }
    //Actualizar cliente  
    public function update($data)
    {
        try {
            Customers::where('id', $data['id'])->update([
                'name' => $data['name'],
                'document' => $data['document'],
                'email' => $data['email'],
                'telephone' => $data['telephone'],
                'observations' => $data['observations'],
            ]);
            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }


    public function delecte($id)
    {

        try {

            $yegua = Customers::find($id);
            // $yegua->()->delete();
            $yegua->delete();

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


    //Validar correos repetidos 
    public function validateEmail($email)
    {
        try {
            return $customers = Customers::select('email')->where('email', $email)->first();

            if ($customers == null) {
                return false;
            } else {
                if ($email === $customers->email) {
                    return true;
                } else {
                    return false;
                }
            }
        } catch (\Throwable $th) {
            return $th;
        }
    }


    //Validar documentos repetidos
    public function validateDocument($document)
    {
        try {
            $customers = Customers::select('document')->where('document', $document)->first();

            if ($customers == null) {
                return false;
            } else {
                if ($document === $customers->document) {
                    return true;
                } else {
                    return false;
                }
            }
        } catch (\Throwable $th) {
            return $th;
        }
    }


}