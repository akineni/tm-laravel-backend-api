<?php

namespace App\Http\Controllers;

use App\Models\User;
use Firebase\JWT\JWT;
use Illuminate\Http\Request;
use Google_Client;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\PersonalAccessToken;

class UserController extends Controller
{
    public function authenticate(Request $request) {
        $guest_data = $this->validateIdToken($request->input('idToken'));
        $user = $this->searchAndAppend($guest_data);
        $user->tokens()->where('name', 'Auth_token')->delete();

        return response()->json(
            ['token' => $user->createToken('Auth_token')->plainTextToken]
        );
    }

    public function refreshToken(Request $request) {

        if(!Auth::guard('sanctum')->check()){
            // Get the user of this token
            $expiredToken = explode('|', $request->header('Authorization'))[1];

            // https://stackoverflow.com/questions/72092685/why-does-laravel-sanctum-append-token-key-to-the-plaintexttoken
            // $hashedExpiredToken = hash('sha256', $expiredToken);

            // https://laracasts.com/discuss/channels/laravel/get-user-by-token
            $user = PersonalAccessToken::findToken($expiredToken)->tokenable;
            $user->tokens()->where('name', 'Auth_token')->delete();

            return response()->json(
                ['token' => $user->createToken('Auth_token')->plainTextToken]
            );
        }
        
    }

    private function validateIdToken(string $id_token) {
        JWT::$leeway = 120;
        
        $client = new Google_Client(['client_id' => env('GOOGLE_PROVIDER_ID')]);
        $payload = $client->verifyIdToken($id_token);
        
        return $payload ? $payload : response('Invalid Id token', 401);        
    }

    private function searchAndAppend(array $guest_data) {

        $guest_data_collection = collect($guest_data);
        
        return User::firstOrCreate(
            $guest_data_collection->only('email')->toArray(),
            $guest_data_collection->only('name')->toArray()
        );

    }
}
