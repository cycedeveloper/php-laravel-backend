<?php

namespace Sayedsoft\ReferralUnilevel\Helpers;

use App\Models\User;
use Sayedsoft\ReferralUnilevel\Models\Referral\Referral;
use Sayedsoft\ReferralUnilevel\Models\Referral\ReferralSponsor;

class SposorsRefresh
{
    // Build your next great package.

    static function  refresh(User $user) {
        
        $sponsors = $user->referral->sponsors;
        
        if (count($sponsors) == 0) {
            ReferralSponsor::firstOrCreate([
                'user_id'    => $user->id,
                'sponsor_id' => $user->referral->referral_id,
                'level' => 1
            ]);
            return;
        }   

        foreach($sponsors as $level => $sponsor) {
            $sponsor->team_count += 1;
            $sponsor->save();
            ReferralSponsor::create([
                'user_id'    => $user->id,
                'sponsor_id' => $sponsor->user->id,
                'level' => $level
            ]);
        }


    }

}
