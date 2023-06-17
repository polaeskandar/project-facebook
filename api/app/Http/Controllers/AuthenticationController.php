<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthenticationController extends Controller
{
  /**
   * Login user.
   *
   * @param Request $request
   * @return JsonResponse
   * @author Pola Eskandar
   * @version 1.0.0
   * @since 1.0.0
   */
  public function login(Request $request): JsonResponse
  {
    $validated = $request->validate([
      'email' => ['required', 'email', 'exists:users,email'],
      'password' => ['required'],
    ]);

    $user = User::where('email', $validated['email'])->first();

    if (!Hash::check($validated['password'], $user->password)) {
      return response()->json(['password' => 'The entered password is wrong!'], 400);
    }

    $user->tokens()->delete();
    $token = $user->createToken('authentication-token')->plainTextToken;
    return response()->json(['user' => $user, 'token' => $token], 201);
  }

  /**
   * Register a new user.
   *
   * @param Request $request
   * @return JsonResponse
   * @author Pola Eskandar
   * @version 1.0.0
   * @since 1.0.0
   */
  public function register(Request $request): JsonResponse
  {
    $validated = $request->validate([
      'name' => ['required', 'min:3', 'max:20'],
      'email' => ['required', 'email', 'unique:users,email'],
      'password' => ['required', 'confirmed', 'min:8', 'max:120'],
    ]);

    $user = User::create([
      'name' => $validated['name'],
      'email' => $validated['email'],
      'password' => Hash::make($validated['password']),
    ]);

    $role = Role::whereRole('user')->first();
    $user->roles()->attach($role);
    event(new Registered($user));

    $token = $user->createToken('authentication-token')->plainTextToken;
    return response()->json(['user' => $user, 'token' => $token], 201);
  }

  /**
   * Logout user.
   *
   * @param Request $request
   * @return JsonResponse
   * @author Pola Eskandar
   * @version 1.0.0
   * @since 1.0.0
   */
  public function logout(Request $request) : JsonResponse {
    $request->user()->tokens()->delete();
    return response()->json([], 204);
  }
}
