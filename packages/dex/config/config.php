<?php

/*
 * You can place your custom package configuration in here.
 */

use Sayedsoft\Dex\WalletDeposit\Accounting\WalletDepositAccounting;
use Sayedsoft\DexWithdrawal\Accounting\WithdrawalAccounting;
use Sayedsoft\ExchangeToken\Exchange\ExchangeAccounting;
use Sayedsoft\ReferralIncome\ReferralIncomeAccounting;
use Sayedsoft\StakeToken\Helpers\StakeAccounting;

return [
    'user_odel' => \App\Models\User::class,
    'mailnotify' => true,
    'accounting_types' => [
        'EXCHANGE_IN' => 'IN',
        'EXCHANGE_OUT' => 'OUT',
        'DEPOSIT' => 'IN',
        'STAKED' => 'OUT',
        'STAKEDPENDING'=>'OUT',
        'WITHDRAW' => 'OUT',
        'STAKEPROFIT' => 'IN', 
        'REFERRALINCOME' => 'IN',
        'EXTRABALANCEOUT' => 'OUT',
        'EXTRABALANCEIN' => 'IN',
        'CAREERPROFIT' => 'IN',
    ],
    'accoutings' => [
        WalletDepositAccounting::class,
        StakeAccounting::class,
        WithdrawalAccounting::class,
        ExchangeAccounting::class,
        ReferralIncomeAccounting::class,

    ]

];