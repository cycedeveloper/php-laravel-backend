<?php

namespace Sayedsoft\Dex;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Verified;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Sayedsoft\Dex\Accounting\Accounting;
use Sayedsoft\DexAuthReferral\Controller\Auth\RegisterController;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use Sayedsoft\Dex\WalletDeposit\Models\PaymentWalletsDeposit;

class DexController extends Controller
{   

    public function deposit(Request $request)
    {   
        $valitor = Validator::make($request->all(), [
            'token_id' => ['required','exists:dex_tokens,id'],
        ]);

        $valitor->validate();


        $user = Auth::user();
        
        return response()->json([
            'wallet'  => $user->walletOf($request->token_id)->address,
            'deposits' => PaymentWalletsDeposit::where('user_id',$user->id)->where('token_id',$request->token_id)->get()
         ]);
    }



}
