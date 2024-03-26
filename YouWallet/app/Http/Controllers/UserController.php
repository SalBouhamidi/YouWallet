<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Compte;

class UserController extends Controller
{
   
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
                'message' => 'somthing wrong' .$e->getMessage(),
                'data' => $user,
                'success' => false
            ],500);
        }
    }
       


        


    

        




    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
