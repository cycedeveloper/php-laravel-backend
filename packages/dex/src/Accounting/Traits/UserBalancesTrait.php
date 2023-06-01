<?php
namespace Sayedsoft\Dex\Accounting\Traits;

use Sayedsoft\Dex\Accounting\Models\AccountingBalance;
use Sayedsoft\Dex\Token\Models\Token;

trait UserBalancesTrait
{
    
    public function balances()
    {   
        $balances = [];
        foreach (Token::all() as $token) {
            $defalt = [
                'user_id'  => $this->id,
                'token_id' => $token->id,
            ];
            $getBalance = AccountingBalance::whereUserId($this->id)->whereTokenId($token->id)->first();
            if (!$getBalance) $balances[] = AccountingBalance::create($defalt)->whereUserId($this->id)->whereTokenId($token->id)->first();
            else $balances[] = $getBalance;
        } 
        return $balances;
    }

    public function balanceToken($token_id) 
    {   
        $defalt = [
            'user_id'  => $this->id,
            'token_id' => $token_id,
        ];
        $getBalance = AccountingBalance::whereUserId($this->id)->whereTokenId($token_id)->with('token')->first();
        if (!$getBalance) $getBalance = AccountingBalance::create($defalt)->whereUserId($this->id)->whereTokenId($token_id)->first();
        return $getBalance;
    } 


    public function user_balances(){
        return $this->hasMany(AccountingBalance::class);
    }
    
    

    
}
