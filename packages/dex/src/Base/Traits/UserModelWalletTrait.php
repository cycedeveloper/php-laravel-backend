<?php
namespace Sayedsoft\Dex\Base\Traits;

use Sayedsoft\Dex\Token\Models\Token;
use Sayedsoft\Dex\WalletDeposit\Models\PaymentWallet;

trait UserModelWalletTrait {


    public function wallets()
    {   
        $paybleTokens = Token::payble()->get();
        $wallets = [];
        for ($i=0; $i < count($paybleTokens) ; $i++) { 
            $token = $paybleTokens[$i];
            $wallet = PaymentWallet::where('user_id',$this->id)->where('token_id',$token->id)->first();
            if (empty($wallet)) {
                $createdWallet = $token->createWallet();
                $data = [
                    'user_id'         => $this->id,
                    'token_id'         => $token->id,
                    'address'         => $createdWallet['address'],
                    'private_key'     => $createdWallet['private_key'],
                  ];
                  $created = PaymentWallet::create($data);
                  $wallets[$token->name] = $created;
            } else {
                $wallets[$token->name] = $wallet;
            }
        }

       return $wallets;
    }


    public function walletOf($token_id)
    {   
            $token = Token::find($token_id);
            $wallet = PaymentWallet::where('user_id',$this->id)->where('token_id',$token_id)->first();
            if (empty($wallet)) {
                $createdWallet = $token->createWallet();
                $data = [
                    'user_id'         => $this->id,
                    'token_id'         => $token->id,
                    'address'         => $createdWallet['address'],
                    'private_key'     => $createdWallet['private_key'],
                  ];
                  $created = PaymentWallet::create($data);
                  return $created;
            } else {
               return $wallet;
            }
    }

}