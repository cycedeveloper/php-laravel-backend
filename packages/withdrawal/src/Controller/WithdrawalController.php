<?php

namespace Sayedsoft\DexWithdrawal\Controller;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Sayedsoft\Dex\Token\Models\Token;
use Sayedsoft\DexWithdrawal\Models\UserWallet;
use Sayedsoft\DexWithdrawal\Models\Withdrawal;
use Illuminate\Support\Facades\Response;
use Sayedsoft\Dex\Base\Traits\FlashMessages;
use Sayedsoft\Dex\WalletDeposit\Libraries\Blockchains\Tron\TronChain;
use Sayedsoft\Dex\WalletDeposit\Models\PaymentWalletsDeposit;
use Sayedsoft\DexWithdrawal\Base\Withdraw;
use Sayedsoft\DexWithdrawal\Models\WithdrawalTokenSettings;
use Sayedsoft\DexWithdrawal\Requests\WithdrawRequest;
use Illuminate\Support\Facades\Validator;
use Sayedsoft\Dex\WalletDeposit\Models\PaymentWallet;

class WithdrawalController extends Controller
{

    use FlashMessages;

    public $token;

    public $token_settings;

    private function setTokenSettings (){
        $this->token_settings = WithdrawalTokenSettings::whereTokenId($this->token->id)->first();
    }




    public function getUserWallets()
    {
        $user    = Auth::user();
        $user             = User::find($user->id);
        $wallets          =  UserWallet::where('user_id',$user->id)->get();
        $user_withdrawals = Withdrawal::where('user_id',$user->id)->get();
    
        return response()->json(['message'=>'User wallets!','user'=>$user,'wallets'=>$wallets,'user_withdrawals'=>$user_withdrawals]);
    }




    private function checkToken(Request $request) {
        if (!$request->token) {
            abort(404);
        } else {
            $this->token =  Token::where('token_code',(string)$request->token)->first();
          if (!$this->token || !$this->token->withdrawable) { abort(404);  }
          return $this->token;
        }
        
    }
 
    public function newRequest (Request $request) {
        $this->checkToken($request);

        $this->setTokenSettings();

        $user = auth()->user();
        $data = [
            'balance'    => User::find($user->id)->balanceToken($this->token->id),
            'token'      => $this->token,
            'withdrawd'  => 0,
            'min'         => $this->token_settings->min_amount,
            'userWallets' => UserWallet::whereTokenId($this->token->id)->whereUserId($user->id)->get(),
            'saveWalletUrl' => route('withdrawal.storeNewWallet')
        ];
        return view('dex-withdrawal::pages.withdraw',$data);
    }

    public function confirm(WithdrawRequest $request) {
        $user = auth()->user();
        $withdraw = new Withdraw($user->id,$request->user_wallet_id,$request->token_id,$request->amount);
        try {
            $withdraw->validate();
        } catch (\Throwable $th) {
            //throw $th;
            self::message('danger', $th->getMessage());
            return back()->with('status', false);
        }
        
        $data = [
            'balance'    => User::find($user->id)->balanceToken($request->token_id),
            'withdraw'   => $withdraw
        ];

        return view('dex-withdrawal::pages.confirm',$data);
    }





        public function history()
    {
        $user             = auth()->user();
        $user_withdrawals = Withdrawal::where('user_id',$user->id)->get();
        $data = [
            'withdrawals'    => $user_withdrawals,
        ];
        return view('dex-withdrawal::pages.withdrawals',$data);
    }


    // Api



    public function storeNewWallet (Request $request) {

        $validator = Validator::make($request->all(), [
            'wallet'    => 'required|string|unique:dex_user_wallets,wallet',
            'token_id'  => 'required|exists:dex_tokens,id',
            'label'    => 'required|string', 
        ]);

        if($validator->fails()) return response()->json($validator->errors(),401); 

  
        $user = auth()->user();
       


        $checkWallet = TronChain::isAddress($request->wallet);
        if (!$checkWallet) {
           return response()->json(['wallet'=>'Invalid wallet format'],401); 
        }
        try {
            DB::beginTransaction();
            $wallet = UserWallet::create([
                'user_id' => $user->id,
                'wallet' => $request->wallet,
                'token_id' => $request->token_id,
                'label'   => $request->label,
            ]);
            
            DB::commit();
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json(['wallet'=>'wallet can not be save try again'],401); 
        }


        return response()->json(['message'=>'Wallet has been saved'],200); 
    }


    public function store (Request $request) {  


        $validator = Validator::make($request->all(), [
            'amount'        => 'required|numeric',
            'user_wallet_id' => 'required|exists:dex_user_wallets,id',
            'token_id'       => 'required|exists:dex_tokens,id',
        ]);

        if($validator->fails()) return response()->json($validator->errors(),401); 

        $user = auth()->user();
        $withdraw = new Withdraw($user->id,$request->user_wallet_id,$request->token_id,$request->amount);
        try {

            $withdraw->validate();
            $withdraw->save();

                        
        } catch (\Throwable $th) {
          
            throw $th;
         //   self::message('danger', $th->getMessage());
           // return redirect()->route('withdrawal.new')->with('status', false);
           return $this->responseJosn($request,false,$th->getMessage(),[],420);
        }

        return response()->json(['message'=>'Withdrawal request has been sent!'],200); 

    }



    public function responseJosn (Request $request,$mode,$message,$data = [],$status = 200) {
        $data = [
            'mode'    => $mode,
            'message' => $message,
            'data'    => $data
        ];
       return   Response::json($data,$status);
    }
   
}
