<?php
namespace Sayedsoft\StakeToken\Helpers;

use Sayedsoft\Dex\Accounting\Accounting;
use Sayedsoft\Dex\Accounting\BaseAccounting;
use Sayedsoft\StakeToken\Models\Stake;
use Sayedsoft\StakeToken\Models\StakeDetails;

class StakeAccounting  {

    use BaseAccounting;

    private function calculateTotalPending () {
        return Stake::where('user_id',$this->_user)
        ->whereIn('status',['pending'])
        ->groupBy('user_id')
        ->selectRaw('user_id,status, sum(amount) as total')->first();
    }

    private function calculateTotalConfirmed () {
        return Stake::where('user_id',$this->_user)
    
        ->whereIn('status',['confirmed'])
        ->groupBy('user_id')
        ->selectRaw('user_id,status, sum(amount) as total')->first();
    }


    private function calculateProfits () {
        $stakes = Stake::where('user_id', $this->_user)->get();
        $ids = [];
        foreach ($stakes as $stakes) { $ids[] = $stakes->id; }

        
        return StakeDetails::whereIn('stake_id',$ids)
        ->groupBy('token_id')
        ->selectRaw('token_id, sum(deserved_profit) as total')->first();
        
    }

    public function refreshTotals()
    {   
        $staked = $this->calculateTotalConfirmed();
        $stakedTotal = (!$staked)  ? 0 : $staked->total;
        Accounting::of('STAKED',$this->_token,$this->_user)->set($stakedTotal);

        $pending = $this->calculateTotalPending();
        $totalPending = (!$pending)  ? 0 :  $pending->total;
        Accounting::of('STAKEDPENDING',$this->_token,$this->_user)->set($totalPending);

        $profits =  $this->calculateProfits();
        $totalprofits = (!$profits)  ? 0 :  $profits->total;
        Accounting::of('STAKEPROFIT',$this->_token,$this->_user)->set($totalprofits);

        return [
            'totalprofits'=>$totalprofits,
            'totalPending' => $totalPending,
            'stakedTotal' => $stakedTotal,
        ];
    }
    
   

}