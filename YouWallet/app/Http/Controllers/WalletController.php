<?php

namespace App\Http\Controllers;

use App\Models\Wallet;
use App\Models\User;
// use App\Http\Requests\StoreWalletRequest;
// use App\Http\Requests\UpdateWalletRequest;
use Illuminate\Http\Request;


class WalletController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function sendMoney()
    {
        // $UserAccount = User::find(session(['email']));
        
        // $UserAccount = User::where('email', session(['email']));

        return response()->json([
            'message'=> session('email'),
        ]);
        // $validateData = $request->validate([
        //     'montant' => 'required'
        // ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreWalletRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Wallet $wallet)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Wallet $wallet)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateWalletRequest $request, Wallet $wallet)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Wallet $wallet)
    {
        //
    }
}
