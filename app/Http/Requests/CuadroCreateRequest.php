<?php
namespace App\Http\Requests;

use App\Http\Requests\Contracts\RequestContract;
use Illuminate\Support\Facades\Validator;

class CuadroCreateRequest implements RequestContract {
  /**
   * Valida el request
   */
  public static function validator(array $data)
  {

    $validator = Validator::make(
      $data,
        array(
          'name' => 'required|string',
          'painter' => 'required|string',
          'country' => 'required|string',
        )
    );
    // Error al validar request
    if ($validator->fails()) {
      return $validator;
    }

    return null;
  }
}