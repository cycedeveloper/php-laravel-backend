<?php
namespace Sayedsoft\DexwithdrawalFiat\Traits;


use Sayedsoft\Dex\Accounting\Helpers\AccountingTotalStore;
use Sayedsoft\Dex\Base\Helpers\NF;


trait withdrawalFiatTotalsTrait {


    public function scopeSumTotal($query,$token_id,$user_id,$colum_name = 'amount',$group_by = 'user_id') {
        return $query->where('status',function() use($query) {
            $query->where('status','pending');
            $query->where('status','confirmed');
        })->$query->where('token_id',$token_id)->where('user_id',$user_id)->groupBy($group_by)->selectRaw('user_id,token_id, sum('.$colum_name.') as total');
    }

    public function scopeSumTotalConfirmed($query,$token_id,$user_id,$colum_name = 'amount',$group_by = 'user_id') {
        return $query->where('status','confirmed')->$query->where('token_id',$token_id)->where('user_id',$user_id)->groupBy($group_by)->selectRaw('user_id,token_id, sum('.$colum_name.') as total');
    }

    public function scopeSumTotalPending($query,$token_id,$user_id,$colum_name = 'amount',$group_by = 'user_id') {
        return $query->where('status','pending')->where('token_id',$token_id)->where('user_id',$user_id)->groupBy($group_by)->selectRaw('user_id,token_id, sum('.$colum_name.') as total');
    }

    public function getTotal ($token_id = null,$user_id = null) {
        $total  = $this->sumTotal($token_id,$user_id)->first();
        return (!empty($total)) ? $total->total : NF::set(0);
    }


    public function getTotalConfirmed ($token_id = null,$user_id = null) {
        $total  = $this->sumTotalConfirmed($token_id,$user_id)->first();
        return (!empty($total)) ? $total->total : NF::set(0);
    }

    public function getTotalPending ($token_id = null,$user_id = null) {
        $total  = $this->sumTotalPending($token_id,$user_id)->first();
        return (!empty($total)) ? $total->total : NF::set(0);
    }
    
  

}