<?php
namespace Sayedsoft\Dex\WalletDeposit\Models;



use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Sayedsoft\Dex\Base\Traits\UserBelongTrait;
use Sayedsoft\Dex\Token\Traits\TokenBelongsTrait;
use Sayedsoft\Dex\WalletDeposit\Accounting\WalletDepositAccounting;

class PaymentWalletsDeposit extends Model
{   
    use HasFactory,TokenBelongsTrait,UserBelongTrait;

    protected $table = 'dex_wallets_deposits';

    protected $accounting_key = 'DEPOSIT';

    protected $appends = [
        'tronscan'
    ];

    protected $fillable = [
        'id',
        'user_id',
        'wallet_id',
        'token_id',
        'transaction_id',
        'amount'
    ];

    protected $hidden = [
        'id',
        'wallet_id',
        'token_id',
        'user_id',
        'updated_at'
    ];


    public function wallet()
    {   
        return $this->belongsTo(PaymentWallet::class,'wallet_id','id');
    }

    public function refreshTotal() {
        $w =  new  WalletDepositAccounting($this->token_id,$this->user_id);
        $w->refreshTotals();
    }

    public function scopeUsr($query,$user_id) {
        return  $query->where('user_id',$user_id);
    }

    public function getTronscanAttribute() {
        return 'https://tronscan.io/#/transaction/'.$this->transaction_id;
    }

}
