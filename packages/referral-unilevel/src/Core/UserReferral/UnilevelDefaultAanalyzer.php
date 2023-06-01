<?php
namespace Sayedsoft\ReferralUnilevel\Core\UserReferral;

use Sayedsoft\Dex\Accounting\Accounting;


class UnilevelDefaultAanalyzer extends UnilevelTreeAnalyzer {
    
    protected function boot () {

        $this->defineCounter('count');

        $this->defineCounter('staked');

        $this->defineCounter('stakers');

        $stakes = 0;
        
        $this->defineAnalyzer('counters',function ($user) use ($stakes) {
           
            if (!empty($user->user_data)) {

                $this->subCounter('count',$user->level,1);

                $staked = Accounting::of('STAKED',2,$user->user_data->id)->get();

                $stakes += $staked;
                 
                $this->subCounter('staked',$user->level,$staked);

                if ($staked > 0) {
                    $this->subCounter('stakers',$user->level,1);
                }
            }
            
            return 1;
        });      
        
        
    }

    
}