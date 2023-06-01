<?php

namespace Sayedsoft\ReferralTree\Controller;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Sayedsoft\Dex\Base\Traits\FlashMessages;
use Sayedsoft\ReferralUnilevel\Models\Referral\Referral;
use Sayedsoft\ReferralUnilevel\Models\Referral\ReferralSponsor;

class ReferralTreeController extends Controller
{
    use FlashMessages;


    public function tree(Request $request)
    {
        $user = auth()->user();
        $referral = $user->referral;
        $data = [
            'referral_link' => $referral->referral_link,
            'user' => $user
        ];
        return view('referral-tree::pages.tree', $data);
    }


    public function userReferral(Request $request)
    {
        $user = Referral::whereUserId($request->user()->id)->with('user')->first();
        return response()->json($user);
    }

    public function userChilds(Request $request)
    {
        if ($request->user_id == $request->user()->id) {
            $users = Referral::whereReferralId($request->user_id)->with('user')->get();
        } else {
            $users = Referral::whereReferralId($request->user_id)->with('user')->limit(1)->get();
        }

        return response()->json($users);
    }

    public function userAllChilds(Request $request)
    {
        $users = ReferralSponsor::whereSponsorId($request->user()->id)->with('user')->get();
        return response()->json($users);
    }


    public function getUserLevelsChilds(Request $request)
    {
        $users = ReferralSponsor::whereSponsorId($request->user()->id)->with('user')->get();
        return response()->json($users);
    }
}
