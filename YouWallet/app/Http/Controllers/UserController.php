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
  * @OA\Tag(
 *     name="authentification",
 *     description="login and register"
 * )
 * @OA\Info(
 *     version="1.0",
 *     title="login or sign uo",
 *     description="the user can create an account and login from it",
 *     @OA\Contact(name="Swagger API Team")
 * )
 * @OA\Server(
 *     url="http://127.0.0.1:8000",
 *     description="API server"
 * )
 * 
 * 
 * 
 * @OA\Post(
 * path="/register",
 * summary="Register the account of the client",
 * description="Sign up by email, password, name",
 * operationId="auth",
 * tags={"User"},
 * @OA\RequestBody(
 *    required=true,
 *    description="Pass user credentials",
 *    @OA\JsonContent(
 *       required={"email","password", "name"},
 *       @OA\Property(property="email", type="string", format="email", example="user1@mail.com"),
 *       @OA\Property(property="password", type="string", format="password", example="qhsdhgqhgqsbvdhsvq"),
 *       @OA\Property(property="name", type="string", format="text", example="salima"),
 *    ),
 * ),
 * @OA\Response(
 *    response=422,
 *    description="error happend",
 *    @OA\JsonContent(
 *       @OA\Property(property="message", type="string", example="error happend")
 *     )
 * 
 *     )
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
                    ],404);
            }

    }






    public function logIn(Request $request){
        $user = User::where('email', $request->email)->first();

        if($user == null){
            return response()->json([
                'message'=> 'You don\'t have account please Register'
            ],404);

        }
        try{

            $validatedata = $request->validate([
                'email' => 'required',
                'password' =>'required',

            ]);

            $token = $user->createToken("API TOKEN")->plainTextToken;
        
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
