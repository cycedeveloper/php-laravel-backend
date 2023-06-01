<?php
namespace Sayedsoft\Dex\Accounting\Traits;

use Sayedsoft\Dex\Accounting\Accounting;
use Sayedsoft\Dex\Accounting\Models\AccountingTotal;

trait UserAccountingTotalsTrait
{   
    public function initializeUserAccountingTotalsTrait()
    {
        $this->appends[] = 'accounting';
    }

    public function totals () {
        $totals = AccountingTotal::where('user_id',$this->id)->get();
        return $totals;
    }


    public function user_totals () {
        return $this->hasMany(AccountingTotal::class);
    }

    public function getAccountingAttribute()
    {   
        return Accounting::temp($this->id);
    }


}
