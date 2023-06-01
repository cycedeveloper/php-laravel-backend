<?php

namespace Sayedsoft\ReferralUnilevel\Helpers;

use Sayedsoft\Dex\Base\Jobs\TelegramJob;
use Sayedsoft\ReferralUnilevel\Models\Referral\ReferralSponsor;

class NewChild
{
    public static function new($newUser)
    {
        $sponsors = $newUser->referral->sponsors;

        foreach ($sponsors as $level => $sponsor) {
            $sponsor->team_count += 1;
            $sponsor->save();

            if (ReferralSponsor::where('user_id', $newUser->id)->where('sponsor_id', $sponsor->user->id)->exists()) {
                continue;
            }

            ReferralSponsor::create([
                'user_id'    => $newUser->id,
                'sponsor_id' => $sponsor->user->id,
                'level' => $level
            ]);
        }



        TelegramJob::dispatch('Yeni üye var '.$newUser->first_name.' '.$newUser->email);
    }
}
