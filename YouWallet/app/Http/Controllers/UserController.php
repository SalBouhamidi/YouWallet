<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Compte;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;



class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
    }

    /**
     * Show the form for creating a new resource.
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

            session([
                'user_id' => $user->id,
                'role_id' =>$user->role_id,
                'name' =>$user->name,

            ]);

            $accountUser = new Compte;
            $accountUser->Solde = 0;
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
        $validatedata = $request->validate([
            'email' => 'required',
            'password' =>'required'
        ]);
        try{

        $Userdata = [
            'email' => $validatedata['email'],
            'password' => $validatedata['password']
        ];
        // $user = User::where('email', $request->email)->first();
        // if($user !== hash::check($request->password, $user->password)){
        //     return response()->json([
        //         'message' => ' password is incorrect',
        //         'success' => false
        //     ],401);
        // }

        if(Auth::attempt($Userdata)){
            session([
                'user_id' => $user->id,
                'role_id' =>$user->role_id,
                'name' =>$user->name,

            ]);
            return response()->json([
                'message' => 'Welcome to your profil',
                'success' => true,
                'data' => $validatedata,
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
