<?php

namespace Modules\Auth\Http\Controllers;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    /**
     * Register a new user.
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'phone_number' => 'required|string|min:6|max:13',
            'address' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return ResponseFormatter::error('Validation Failed', 422, $validator->errors());
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'address' => $request->address,
            'password' => Hash::make($request->password),
        ]);

        return ResponseFormatter::success(null, 'User registered successfully', 201);
    }

    /**
     * Authenticate a user and return a JWT.
     */
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        if ($validator->fails()) {
            return ResponseFormatter::error('Validation Failed', 422, $validator->errors());
        }

        $credentials = $request->only('email', 'password');

        try {
            if (!$token = JWTAuth::attempt($credentials)) {
                return ResponseFormatter::error('Unauthorized', 401);
            }
        } catch (JWTException $e) {
            return ResponseFormatter::error('Could not create token', 500, $e->getMessage());
        }

        return ResponseFormatter::success(['token' => $token], 'Login successful');
    }

    /**
     * Logout the user (invalidate the token).
     */
    public function logout()
    {
        try {
            JWTAuth::invalidate(JWTAuth::getToken());
            return ResponseFormatter::success(null, 'Successfully logged out');
        } catch (JWTException $e) {
            return ResponseFormatter::error('Could not invalidate token', 500, $e->getMessage());
        }
    }

    /**
     * Refresh the token.
     */
    public function refresh()
    {
        try {
            $token = JWTAuth::refresh(JWTAuth::getToken());
            return ResponseFormatter::success(['token' => $token], 'Token refreshed successfully');
        } catch (JWTException $e) {
            return ResponseFormatter::error('Could not refresh token', 500, $e->getMessage());
        }
    }

    /**
     * Get the authenticated user.
     */
    public function userGet()
    {
        try {
            $user = JWTAuth::parseToken()->authenticate();
            $user->load('roles');

            return ResponseFormatter::success([
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'email_verified_at' => $user->email_verified_at,
                'created_at' => $user->created_at,
                'updated_at' => $user->updated_at,
                'roles' => $user->roles->pluck('name')
            ]);
        } catch (\Exception $e) {
            return ResponseFormatter::error('Could not fetch user information', 500, $e->getMessage());
        }
    }

    /**
     * Handle password reset request.
     */
    public function resetPassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email',
        ]);

        if ($validator->fails()) {
            return ResponseFormatter::error('Validation Failed', 422, $validator->errors());
        }

        $response = Password::sendResetLink($request->only('email'));

        return $response === Password::RESET_LINK_SENT
            ? ResponseFormatter::success(null, 'Password reset link sent')
            : ResponseFormatter::error('Unable to send password reset link', 500);
    }

    /**
     * Handle password update request.
     */
    public function updatePassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'token' => 'required|string',
            'email' => 'required|string|email',
            'password' => 'required|string|min:6|confirmed',
        ]);

        if ($validator->fails()) {
            return ResponseFormatter::error('Validation Failed', 422, $validator->errors());
        }

        $response = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->password = Hash::make($password);
                $user->save();
            }
        );

        return $response === Password::PASSWORD_RESET
            ? ResponseFormatter::success(null, 'Password updated successfully')
            : ResponseFormatter::error('Unable to update password', 500);
    }
}
