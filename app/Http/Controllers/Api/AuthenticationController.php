<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use DB;

class AuthenticationController extends Controller
{
    public function userRegister(Request $request)
    {
        try {
           $values = Validator::make($request->all(), 
            [
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|unique:users,email',
                'password' => 'required|string|min:6',
                
                
            ]);


            if($values->fails()){
                return response()->json([
                    'status' => false,
                    'message' =>'Validation error!',
                    'errors' => $values->errors()
                ], Response::HTTP_BAD_REQUEST);
            }


            $user = new User();
            $user->fill($request->all());
        
            
            
            $user->save();
        
            $token=$user->createToken('myToken')->plainTextToken;
           

            return response()->json([
                'message' => 'User Registered Successfully!',
                'user' => $user,
                'token' => $token,
            
               

            ], Response::HTTP_OK);

        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'reg_message' => $th->getMessage()
            ], Response::HTTP_BAD_REQUEST);
        }
    }

    
    
    
    
    
    
    
    
    public function userSignin(Request $request)
    {
        
        $attr = $request->validate([
            'email' => 'required|string',
            'password' => 'required|string|min:6',
        ]);


        $user=User::where('email', $attr['email']) ->first();
      //dd($user);
        
        if (!empty($user) ) {
            return response()->json([
                    'status' => false,
                    'message' =>'Unauthorized',
                ], Response::HTTP_UNAUTHORIZED); //401
        }

 
        if (!$user||!Hash::check($attr['password'],$user->password)) {
            
            return response()->json([
                    'status' => false,
                    'message' => 'success',
                ], Response::HTTP_UNAUTHORIZED); //401

        }
        if(!empty($request->notification_token))
        {
            $user->notification_token = $request->notification_token;
            $user->save();
        }
        
        
        $token=$user->createToken('API Token')->plainTextToken;
        
      
        return response([
            'message'=>'Success!',
            'user'=>$user,
            'token'=>$token,
         
          
          ],Response::HTTP_OK);
    }


    public function userSignout()
    {
        auth()->user()->tokens()->delete();
        return response([
            'message'=>'Logged Out!'
        ],Response::HTTP_OK);
    }


   
    
}
