<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Wallet;
use App\Models\User;
use App\Models\Compte;



class WalletController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function sendMoney(Request $request)
    {
        // $UserAccount = User::find(session(['email']));
        if(Auth::check()){
            $user= Auth::user();
            $Useraccount= Compte::where('user_id', $user->id)->first();

            $validateData= $request->validate([
                'montant' => 'required',
                'motif' => 'required',
                'receiver_id' => 'required',
            ]);

            if($Useraccount->solde < $validateData['montant']){
                return response()->json([
                    'message'=> 'welcome to youWallet',
                    'data' => 'you don\'t have enough money to send it',
                ]);
            }else{
                $recievercheck= User::where('id', $validateData['receiver_id'])->first();
                if($recievercheck == null){
                    return response()->json([
                        'message'=> 'the account number of user is not valid, we would advise you to check again',
                    ]);

                }else{
                    $Moneysend = new Wallet;
                    $Moneysend->montant = $request->montant;
                    $Moneysend->motif = $request->motif;
                    $Moneysend->sendoperation = 1;
                    $Moneysend->receiver_id = $request->receiver_id;
                    $Moneysend->sender_id =$user->id;
                    $Moneysend->save();
                  
                    $senderaccount= compte::where('user_id', $user->id)->first();                   
                     $Soldeupdated = $senderaccount->solde - $Moneysend->montant;
                    $senderaccount->solde = $Soldeupdated;
                    $senderaccount->save();


                    $recieveraccount = Compte::where('user_id', $Moneysend->receiver_id)->first();
                    $receiversoldeupdate = $recieveraccount->solde + $Moneysend->montant;
                    $recieveraccount->solde = $receiversoldeupdate;
                    $recieveraccount->save();

                    return response()->json([
                        'message'=> 'your transaction was made successfully',
                    ]);                    
                }
                
            }
            
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function Myhistory()
    {
        $user= Auth::user();
        $sendingtransaction = Wallet::where('sender_id', $user->id)->get();
        $receivingmoney = wallet::where('receiver_id', $user->id)->get();


        return response()->json([
            'message' => 'Dear User, You have send money to the following accounts:',
            'data' =>  $sendingtransaction,
            'messageRecieve' =>'Dear User, you recieve money from those accounts:',
            'dataReceiver' =>  $receivingmoney,

        ]);
        
    }

    public function allTransaction(){
        $wallets = wallet::get();
        return response()->json([
            'message' => 'here\'s all the transactions',
            'data' => $wallets,
        ]);
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
