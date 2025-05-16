<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Stmt\TryCatch;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only(['email', 'password']);
    
        try {
            if (!$token = auth('api')->attempt($credentials)) {
                return response()->json([
                    'error' => 'Email hoặc mật khẩu không đúng'
                ], 401);
            }
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Không thể tạo token',
                'details' => $e->getMessage()
            ], 500);
        }
    
        return $this->respondWithToken($token);
    }

    protected function respondWithToken($token)
    {
        $user = auth('api')->user();

        return response()->json([
            'user_id' => $user->id,
            'username' => $user->name,
            'role' => $user->role,
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => config('jwt.ttl') * 60
        ]);
    }

    public function logout() {
        try {
            JWTAuth::invalidate(JWTAuth::getToken());
            return response()->json(['success' => true, 'message' => 'Đăng xuất thành công']);
        } catch (\Tymon\JWTAuth\Exceptions\JWTException $e) {
             return response()->json(['success' => false,'error' => 'Không thể đăng xuất, token không hợp lệ'], 500);
        }
    }
}