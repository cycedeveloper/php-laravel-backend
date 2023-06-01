<?php
namespace Sayedsoft\DexWithdrawal\Base;


use Sayedsoft\DexWithdrawal\Base\BaseWithdraw;
use Sayedsoft\DexWithdrawal\validations\WithdrawAmountValidate;
use Sayedsoft\DexWithdrawal\validations\UserBanalceValidate;
use Sayedsoft\DexWithdrawal\validations\UserCanWithdraw;

class Withdraw extends BaseWithdraw
{
    
    public $withdraw;

    public $has_fee = false;

    public $fee_face = 1;

    protected $validations = [
        WithdrawAmountValidate::class,
        UserBanalceValidate::class,
        UserCanWithdraw::class,
    ];
    
    
}
