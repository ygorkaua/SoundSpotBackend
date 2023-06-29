<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Symfony\Contracts\Service;

class UserController extends Controller
{
    public function __construct(
        public User $userModel
    ) {}

    public function register(Request $request)
    {
        $this->validate(
            $request,
            [
                'name' => 'required|string',
                'user_name' => 'required|string|min:4|max:20|unique:users',
                'email' => 'required|email|unique:users',
                'profile_image' => 'nullable|image',
                'birth_date' => 'required|date',
                'password' => 'required|regex:/^(?=.*[A-Z])(?=.*[^a-zA-Z0-9]).{8,}$/'
            ]
        );

        try {
            User::factory()->create([
                'name' => $request->name,
                'user_name' => $request->user_name,
                'email' => $request->email,
                'profile_image' => $request->profile_image,
                'birth_date' => $request->birth_date,
                'password' => bcrypt($request->password)
            ]);

            return response()->json("User created successfully", 201);
        } catch (Exception $exception) {
            return $exception->getMessage();
        }
    }

    public function login()
    {
        return response()->json("User login successfully", 200);
    }
}
