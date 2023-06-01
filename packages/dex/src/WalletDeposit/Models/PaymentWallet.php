<?php
namespace Sayedsoft\Dex\WalletDeposit\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Sayedsoft\Dex\Base\Traits\UserBelongTrait;
use Sayedsoft\Dex\Token\Traits\TokenBelongsTrait;


class PaymentWallet extends Model
{
    use HasFactory, TokenBelongsTrait,UserBelongTrait;

    protected $table = 'dex_payment_wallets';

    protected $fillable = [
        'id',
        'user_id',
        'token_id',
        'address',
        'private_key'
    ];
    
    protected $hidden = [
        'private_key',
        'created_at',
        'updated_at',
    ];

    
}
