<?php
namespace Sayedsoft\DexWithdrawal\Base;

use App\Models\User;
use Exception;
use Illuminate\Support\Facades\DB;
use Sayedsoft\Dex\Fees\FeeCalculator;
use Sayedsoft\Dex\Token\Models\Token; 
use Sayedsoft\DexWithdrawal\Models\UserWallet;
use Sayedsoft\DexWithdrawal\Models\Withdrawal;
use Sayedsoft\DexWithdrawal\Models\WithdrawalTokenSettings;

class BaseWithdraw
{   
    
    public $user;

    public $wallet;

    public $token;

    public $settings;

    public $amount;

    public $amount_fee = 0;

    public $total = 0;

    public $validated = false;


    private $fee_face = null;


    protected $validations = [
        // WithdrawAmountValidate::class,
        //UserBanalceValidate::class,
    ];


    public function __construct($user_id,$wallet_id,$token_id,$amount)
    {
        $this->user_id = $user_id;

        $this->wallet_id = $wallet_id;

        $this->token_id = $token_id;

        $this->amount = $amount;

        $this->setUser();

        $this->setWallet();

        $this->setToken();

        $this->setAmount();

        $this->setFee();
         
    }

    private function setFee() {
        if ($this->settings == null)  { return; }
        if ($this->settings->fee_face_id != null) {
            $this->has_fee  = true;
            $this->fee_face = $this->settings->fee_face_id;
            $fee  = new FeeCalculator($this->fee_face,$this->amount);
            $fees = $fee->calculate();
            $this->amount_fee =  $fees['amount_fee'];
            $this->total      =  $fees['total'];
         }
    }


    private function setUser () {
        $this->user = User::find($this->user_id);
        if (empty($this->user)) {
            return $this->returnError('User not found');
        }
    }

    private function setWallet () {
        $this->wallet = UserWallet::find($this->wallet_id);
        if (empty($this->wallet)) {
            return $this->returnError('Wallet not found');
        }

        if ($this->wallet->user_id != $this->user_id) {
            return $this->returnError('Wallet is wrong');
        }
    }

    private function setToken () {
        $this->token = Token::find($this->token_id);
        if (empty($this->token)) {
            return $this->returnError('token not found');
        }

        if (!$this->token->withdrawable) {
            return $this->returnError('Token is not withdrawable');
        }

        $settings = WithdrawalTokenSettings::whereTokenId($this->token->id)->first();
        $this->settings = ($settings) ? $settings : null;
    }
    
    private function setAmount () {
        if ($this->amount == 0) {
            return $this->returnError('amount is zero');
        }
        $this->total  =  $this->amount; 
        return $this;
    }


    public function validate() {
       if ($this->validated) { return $this;  }
       foreach ($this->validations as $i => $class) { $class::validate($this);  }
       $this->validated = true;
       return $this;
    }


    public function preview () {
         return $this;
    }

    public function save () {
        $this->validate();
        try {
            DB::beginTransaction();


            Withdrawal::create([
                'user_id' => $this->user_id,
                'user_wallet_id' => $this->wallet_id,
                'token_id'=> $this->token_id,
                'amount' => $this->amount,
                'amount_fee' => $this->amount_fee,
                'total' => $this->total,
            ]);

            DB::commit();

       } catch (\Throwable $th) {
            DB::rollBack();
            throw($th);
       }

       return ;
    }


    public function returnError ($message) {
        throw new Exception($message, 1);
     }
}
