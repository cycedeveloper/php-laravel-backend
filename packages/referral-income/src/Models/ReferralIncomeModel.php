<?php

namespace Sayedsoft\ReferralIncome\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Sayedsoft\Dex\Base\Traits\UserBelongTrait;
use Sayedsoft\Dex\Token\Traits\TokenBelongsTrait;
use Sayedsoft\ReferralIncome\ReferralIncomeAccounting;

class ReferralIncomeModel extends Model
{   
    use TokenBelongsTrait,UserBelongTrait,TokenBelongsTrait;

    protected $table = 'dex_referral_income';

    protected $appends = [

    ];

    protected $fillable = [
        'name',
        'user_id',
        'uchild_id',
        'token_id',
        'level',
        'amount',
        'org_amount',
        'percent',
        'type_ref',
        'related_id'
    ];


    public function refreshTotal() {
        
        $w =  new  ReferralIncomeAccounting($this->token_id,$this->user_id);
        $w->refreshTotals();
        
    }
    

    public function FromUser()
    {
        return $this->belongsTo(User::class,'uchild_id','id');
    }


}
