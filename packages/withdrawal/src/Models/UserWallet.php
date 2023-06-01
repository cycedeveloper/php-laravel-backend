<?php
namespace Sayedsoft\DexWithdrawal\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Sayedsoft\Dex\Base\Traits\UserBelongTrait;
use Sayedsoft\Dex\Token\Traits\TokenBelongsTrait;

class UserWallet extends Model
{   
    use HasFactory,TokenBelongsTrait,UserBelongTrait;

    protected $table = 'dex_user_wallets';

    protected $appends = [
        
    ];

    protected $fillable = [
        'id',
        'user_id',
        'token_id',
        'wallet',
        'label'
    ];

    

}
