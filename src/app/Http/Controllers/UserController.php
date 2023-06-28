<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class UserController extends BaseController
{
  public function register(Request $request)
  {
    $this->validate($request, [
      'name' => 'required',
      'email' => 'required|email',
      'password' => 'required|regex:/^(?=.*[A-Z])(?=.*[^a-zA-Z0-9]).{8,}$/',
    ]);
  }

  public function login()
  {
    
  }
}