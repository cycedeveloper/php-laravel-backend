<?php
namespace Sayedsoft\DexWithdrawal\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Sayedsoft\Dex\Base\Traits\UserBelongTrait;
use Sayedsoft\Dex\Fees\Models\Fees;
use Sayedsoft\Dex\Token\Traits\TokenBelongsTrait;
use Sayedsoft\DexWithdrawal\Accounting\WithdrawalAccounting;
use Sayedsoft\DexWithdrawal\Traits\WithdrawalStatusTrait;
use Sayedsoft\DexWithdrawal\Traits\WithdrawalTokenSettingsTrait;

class Withdrawal extends Model
{   
    use HasFactory,TokenBelongsTrait,UserBelongTrait,WithdrawalTokenSettingsTrait,WithdrawalStatusTrait;

    protected $table = 'dex_withdrawals';

    protected $accounting_key = 'WITHDRAW';

    protected $appends = [
        'withdrawal_token_settings'
    ];

    protected $fillable = [
        'id',
        'user_id',
        'user_wallet_id',
        'token_id',
        'txt_id',
        'amount',
        'amount_fee',
        'total',
        'status',
        'admin_not',
    ];

    public function scopeFor($query,$user_id,$token_id) {
        return $query->where('user_id',$user_id)->where('token_id',$token_id);
    }


    public function wallet() {
        return  $this->belongsTo(UserWallet::class,'user_wallet_id','id');
    }


    public function getTotalAmountAttribute($query,$user_id,$token_id) {
        //if (Fees::whereRealtedId($this->id)->whereForType('WITHDRAW'))
    }

    public function refreshTotal() {
        $w =  new  WithdrawalAccounting($this->token_id,$this->user_id);
        $w->refreshTotals();
    }
    
    protected static function boot()
    {
        parent::boot();

        // auto-sets values on creation
        static::creating(function ($query) {
            $query->status =  'pending';
        });
    }



}
