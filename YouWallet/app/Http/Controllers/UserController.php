<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Compte;
use OpenApi\Annotations as OA;

class UserController extends Controller
{
        /**
 * @SWG\Get(
 *     path="/register",
 *     summary="create an account",
 *     tags={"Compte"},
 *     @SWG\Response(response=200, description="you have register successfully"),
 *     @SWG\Response(response=400, description="error happend")
 * )
 */
   
    public function register(Request $request){
            $request->validate([
                'name' => 'required', 'max:50',
                'email' => 'required', 'unique:User',
                'password' =>'required',
            ]);
            try{
            $user = new User;
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->role_id = 1;
            $user->save();

            $accountUser = new Compte;
            $accountUser->Solde = 100;
            $accountUser->user_id= $user->id;
            $accountUser->save();


            return response()->json(
                [
                    'success' => true,
                    'message'=> 'you have register successfully',
                    'data' => $user,
                ],200);

            }catch(\Exception $e)
            {
                return response()->json(
                    [
                        'success' => false,
                        'message'=> 'error happend'.$e->getMessage(),
                    ],400);
            }

    }


        /**
 * @SWG\Get(
 *     path="/login",
 *     summary="log in to my account",
 *     tags={"User"},
 *     @SWG\Response(response=200, description="Welcome to your profil"),
 *     @SWG\Response(response=500, description="somthing went wrong")
 * )
 */


    public function logIn(Request $request){
        $user = User::where('email', $request->email)->first();
        try{

            $validatedata = $request->validate([
                'email' => 'required',
                'password' =>'required',

            ]);

            $token = $user->createToken("API TOKEN")->plainTextToken;

        // return response()->json([
        //     'user' => $token
        // ]);

        // if(Auth::attempt($validatedata)){
        //     return response()->json([
        //         "user" => $token,

        //     ]);
        // }
        
        if(Auth::attempt($validatedata)){
            return response()->json([
                'message' => 'Welcome to your profil',
                'success' => true,
                'data' => $user,
                'token' => $token,
                'token_type' => 'Bearer'
            ],200);


        }else{
            return response()->json([
                'message' => 'Email or password are incorrect',
                'success' => false
            ],401);
        }
        }catch(\Exception $e){
            return response()->json([
                'message' => 'somthing went wrong' .$e->getMessage(),
                'data' => $user,
                'success' => false
            ],500);
        }
    }
       


        


    

        





}
