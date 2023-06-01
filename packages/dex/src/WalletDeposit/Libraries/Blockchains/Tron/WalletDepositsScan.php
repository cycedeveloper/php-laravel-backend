<?php
namespace Sayedsoft\Dex\WalletDeposit\Libraries\Blockchains\Tron;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Sayedsoft\Dex\Token\Models\Token;
use Sayedsoft\Dex\WalletDeposit\Libraries\Blockchains\Tron\Tron;
use Sayedsoft\Dex\WalletDeposit\Libraries\SaveWalletDeposits;
use Sayedsoft\Dex\WalletDeposit\Models\PaymentWalletsDeposit;

class WalletDepositsScan {
     
    public static function scan ($wallet) {
        if (empty($wallet)) { Log::error('wallet is empty'); die(); } 
       
        $_tron = new Tron();
        $tron  = $_tron->setWallet($wallet->address,$wallet->private_key)->init();
        $transactions = $tron->getTransactionsAddress();
        foreach($transactions as $transaction) {
           // Check if this transaction save in DB
           if (PaymentWalletsDeposit::whereTransactionId($transaction->transaction_id)->exists()) continue;
           // Check if transaction is token transaction
           if (!isset($transaction->token_info->address)) continue;
           // Check if transaction is deposit and not withdraw 
           if (!isset($transaction->to) || $transaction->to != $wallet->address) continue;
           // Check if token of transaction is avaible 
           $contract = $transaction->token_info->address;

          

           $token = Token::where('contract_address',$contract)->orWhere('contract_address_test',$contract)->first();
           if (empty($token)) continue;
            
           DB::beginTransaction();    
           try {
   
                $deposit = new SaveWalletDeposits();
                $deposit->user($wallet->user->id);
                $deposit->token($token->id);
                $deposit->amount($tron->fromSun($transaction->value));
                $deposit->wallet($wallet->id);
                $deposit->transaction($transaction->transaction_id);
                $deposit->save();
                

            } catch (\Throwable $th) {
                //throw $th;
                DB::rollBack();

                dd($th);
            } 
            DB::commit();
        }
    }

}