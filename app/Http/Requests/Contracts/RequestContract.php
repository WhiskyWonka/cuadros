<?php
namespace App\Http\Requests\Contracts;

interface RequestContract {
  public static function validator(array $data);
}