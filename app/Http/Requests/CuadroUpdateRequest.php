<?php
namespace App\Http\Requests;

use App\Http\Requests\Contracts\RequestContract;
use Illuminate\Support\Facades\Validator;

class CuadroUpdateRequest implements RequestContract {
  /**
   * Valida el request
   */
  public static function validator(array $data)
  {

    $validator = Validator::make(
      $data,
        array(
          'name' => 'sometimes|required|string',
          'painter' => 'sometimes|required|string',
          'country' => 'sometimes|required|string',
        )
    );
    // Error al validar request
    if ($validator->fails()) {
      return $validator;
    }

    return null;
  }
}