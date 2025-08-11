<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('username', 'password');

        if (! $token = JWTAuth::attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

         $user = auth()->user();

        return response()->json([
            'status' => true,
            'user' => $user,
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => JWTAuth::factory()->getTTL() * 60
        ]);
    }

    public function me()
    {
        try {
            $user = auth()->user();
    
            if ($user) {
                // Cast para o tipo correto
                $user = $user instanceof \App\Models\User ? $user : \App\Models\User::find($user->id);
    
                return ['status' => true, 'data' => $user];
            }
    
            return ['status' => false, 'error' => 'Usuário não autenticado', 'statusCode' => 401];
        } catch (\Throwable $error) {
            return ['status' => false, 'error' => $error->getMessage(), 'statusCode' => 400];
        }
    }

    public function logout()
    {
        JWTAuth::invalidate(JWTAuth::getToken());
        $user = auth()->user();
        return response()->json(['status' => true, 'user' => $user, 'message' => 'Logout realizado com sucesso']);
    }

    public function validateToken(Request $request)
    {
        try {
            $token = JWTAuth::parseToken()->authenticate();
            return response()->json(['status' => true, 'message' => 'Token válido']);
        } catch (\Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {
            return response()->json(['error' => 'Token expirado'], 401);
        } catch (\Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
            return response()->json(['error' => 'Token inválido'], 401);
        } catch (\Tymon\JWTAuth\Exceptions\JWTException $e) {
            return response()->json(['error' => 'Token de autorização não encontrado'], 401);
        }
    }    
}
