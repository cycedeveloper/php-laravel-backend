<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Sayedsoft\Dex\Accounting\Accounting;
use Sayedsoft\Dex\Token\Models\Token;
use Sayedsoft\Dex\WalletDeposit\Models\PaymentWallet;
use Sayedsoft\ExchangeToken\Models\ExchangePairs;
use Sayedsoft\StakeToken\Models\StakesPlan;

class AppController extends Controller
{
    //

    public function all (Request $request) {
        $data = [];
        
        $data['tokens']                  = Token::with('withdrawalTokenSettings')->get();
        
        $data['stake_plans']             = StakesPlan::all();

        $data['exchange_pairs']          = ExchangePairs::with('feeFace')->get();
        
        return response()->json($data);
    }   

}
