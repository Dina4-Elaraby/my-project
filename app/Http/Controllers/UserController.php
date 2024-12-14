
<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Support\Facades\Log; 








class UserController extends Controller
{

    public function register() {
        $validator = Validator::make(request()->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed|min:8',
            'status'=> 'required|string|in:admin,user'
           
        ]);
  
        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }
  
        $user = new User;
        $user->username = request()->username;
        $user->email = request()->email;
        $user->password = bcrypt(request()->password);
        $user-> status=request()->status;
        $user->save();
  
        return response()->json($user, 201);
    }
    
// User Login
    public function login(Request $request)
    {
        // Validate the incoming request
       
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required'
        ]);
    
        // Check if validation fails
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }
    
        // Continue with JWT authentication
        $credentials = $request->only('email', 'password');
        try 
        {
            // If authentication fails
            if (!$token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'Invalid credentials'], 401);
            }
        }

         catch (JWTException $e) 
        {
            return response()->json(['error' => 'Could not create token'], 500);
        }

        // Return token on success
        return response()->json([
            'message' => 'Login successful',
            'token' => $token
        ]);
    }

    public function me()
{
    $user = Auth::user();

    if (!$user) {
        return response()->json(['error' => 'User not authenticated'], 401);
    }

    return response()->json(['username' => $user->username]);
}


    // User Logout
    public function logout()
    {
        try {
            // Invalidate the token
            JWTAuth::invalidate(JWTAuth::getToken());

            return response()->json([
                'message' => 'Logout successful. Token invalidated.'
            ]);
             } 

        catch (JWTException $e) 
        {
            return response()->json(['error' => 'Failed to logout, please try again'], 500);
        }
    }


    public function refresh()
    {
        try 
        {
            // Generate a new token by refreshing the existing one
            $newToken = JWTAuth::parseToken()->refresh();
            return $this->respondWithToken($newToken);
        }
         catch (\Tymon\JWTAuth\Exceptions\TokenInvalidException $e)
        {
            return response()->json(['error' => 'Token is invalid'], 401);
        } 
        catch (\Exception $e) 
        {
            return response()->json(['error' => 'Could not refresh token'], 500);
        }
    }
    

    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => JWTAuth::factory()->getTTL() * 60
        ]);
    }

    public function getUserByToken(Request $request)
{
    try {
        $user = JWTAuth::parseToken()->authenticate();
        
        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }

        return response()->json(['user' => $user], 200);
    } catch (JWTException $e) {
        return response()->json(['error' => 'Token is invalid'], 400);
    }
  
}

}
