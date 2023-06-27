<?php
namespace Sayedsoft\DexwithdrawalFiat\Base;


use Sayedsoft\DexwithdrawalFiat\Base\BaseWithdrawFiat;
use Sayedsoft\DexwithdrawalFiat\validations\WithdrawAmountValidate;
use Sayedsoft\DexwithdrawalFiat\validations\UserBanalceValidate;
use Sayedsoft\DexwithdrawalFiat\validations\UserCanWithdraw;

class WithdrawFiat extends BaseWithdrawFiat
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