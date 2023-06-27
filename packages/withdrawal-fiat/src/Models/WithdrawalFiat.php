<?php
namespace Sayedsoft\DexwithdrawalFiat\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Sayedsoft\Dex\Base\Traits\UserBelongTrait;
use Sayedsoft\Dex\Fees\Models\Fees;
use Sayedsoft\Dex\Token\Traits\TokenBelongsTrait;
use Sayedsoft\DexwithdrawalFiat\Accounting\withdrawalFiatAccounting;
use Sayedsoft\DexwithdrawalFiat\Traits\withdrawalFiatStatusTrait;
use Sayedsoft\DexwithdrawalFiat\Traits\withdrawalFiatTokenSettingsTrait;

class withdrawalFiat extends Model
{   
    use HasFactory,TokenBelongsTrait,UserBelongTrait,withdrawalFiatTokenSettingsTrait,withdrawalFiatStatusTrait;

    protected $table = 'dex_withdrawal_fiats';

    protected $accounting_key = 'WITHDRAW';

    protected $appends = [
        'withdrawal_fiat_token_settings'
    ];

    protected $fillable = [
        'id',
        'user_id',
        'user_iban_id',
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
        $w =  new  withdrawalFiatAccounting($this->token_id,$this->user_id);
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