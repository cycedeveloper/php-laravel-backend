<?php
namespace Sayedsoft\Dex\WalletDeposit\Models;



use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Sayedsoft\Dex\Base\Traits\UserBelongTrait;
use Sayedsoft\Dex\Token\Traits\TokenBelongsTrait;
use Sayedsoft\Dex\WalletDeposit\Accounting\ExtraBalanceAccounting;
use Sayedsoft\Dex\WalletDeposit\Accounting\WalletDepositAccounting;

class ExtraBalance extends Model
{   
    use HasFactory,TokenBelongsTrait,UserBelongTrait;

    protected $table = 'dex_extra_balance';


    protected $appends = [
        'tronscan'
    ];

    protected $fillable = [
        'id',
        'user_id',
        'token_id',
        'amount',
        'type'
    ];

    protected $hidden = [
        'id',
        'token_id',
        'user_id',
    ];


    public function refreshTotal() {
        $w =  new  ExtraBalanceAccounting($this->token_id,$this->user_id);
        $w->refreshTotals();
    }

    public function scopeUsr($query,$user_id) {
        return  $query->where('user_id',$user_id);
    }

    public function getTronscanAttribute() {
        return 'https://tronscan.io/#/transaction/'.$this->transaction_id;
    }

}
