<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CuadroCollection;
use App\Models\Cuadro;
use App\Http\Resources\CuadroResource;
use App\Http\Requests\CuadroCreateRequest;
use App\Http\Requests\CuadroUpdateRequest;
use Exception;
use Illuminate\Http\Request;

class CuadroController extends Controller
{
    public function show(Cuadro $cuadro)
    {
        return CuadroResource::make($cuadro);
    }

    public function index(Request $request)
    {
        $input = $request->all();


        if (isset($input['fields'])) {
            $fields = explode(',', $input['fields']);
            $fields[] = 'id';

            $query = Cuadro::select($fields);
        } else {
            $query = Cuadro::query();
        }

            
        if (isset($input['filters'])) {
            foreach ($input['filters'] as $key => $value) {
                $query = $query->where($key, $value);
            }
        }

        $query->orderBy('id');


        return CuadroCollection::make($query->get());
    }

    public function create(Request $request)
    {
        $input = $request->all();

        // VALIDACION
		$validator_errors = CuadroCreateRequest::validator($input);

		if ($validator_errors) {
            return response($validator_errors->errors()->toArray(), 400);
		}

        $cuadro = Cuadro::create($input);

        return CuadroResource::make($cuadro);
    }

    public function update(Request $request, $id)
    {
        $input = $request->all();

        // VALIDACION
		$validator_errors = CuadroUpdateRequest::validator($input);

		if ($validator_errors) {
            return response($validator_errors->errors()->toArray(), 400);
		}
        
        $cuadro = Cuadro::find($id);

        $cuadro->update($input);

        return CuadroResource::make($cuadro);
    }

    public function delete(Cuadro $cuadro)
    {
        
        $cuadro->delete();

        return response('Registro eliminado', 200);
    }
}
