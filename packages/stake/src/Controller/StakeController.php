<?php
namespace Sayedsoft\StakeToken\Controller;

use App\Models\User;
use Illuminate\Http\Request as HttpRequest;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Sayedsoft\Dex\Accounting\Accounting;
use Sayedsoft\Dex\Base\API\DexReponse;
use Sayedsoft\ExchangeToken\Exchange\Helpers\CurrencyConvert;
use Sayedsoft\ReferralIncome\Models\ReferralIncomeModel;
use Sayedsoft\ReferralUnilevel\Core\UserReferral\UnilevelUserReferral;
use Sayedsoft\ReferralUnilevel\Unilevel;
use Sayedsoft\StakeToken\Career\UserCareer;
use Sayedsoft\StakeToken\Career\UserCareerResponse;
use Sayedsoft\StakeToken\Models\Career\UserReferralCareerTemps;
use Sayedsoft\StakeToken\Models\Stake;
use Sayedsoft\StakeToken\Requests\StakeValidateRequest;
use Sayedsoft\StakeToken\StakeToken;
use Sayedsoft\StakeToken\Validations\UserBanalceValidate;
use Sayedsoft\StakeToken\Validations\UserCanStake;

class  StakeController {



    public function validate (StakeValidateRequest  $request) {
        
        
       $stake = [];
        
        try {

            $st = new StakeToken();
            $st->setUser(Auth::user()->id);
            $st->setPlan($request->plan_id);
            $st->setAmount($request->amount);

            $st->validate();

          $stake =  $st->preview();

        } catch (\Throwable $th) {
            return DexReponse::json($request,true,$th->getMessage(),[],402);
        }


        return DexReponse::json($request,true,'Stake is validated',$stake);
    }

    public function save (StakeValidateRequest $request) {
            $stake = [];
        
        try {

             $st = new StakeToken();

             $st->addValidate(UserBanalceValidate::class);

             $st->addValidate(UserCanStake::class);

            $st->setUser(Auth::user()->id);
            $st->setPlan($request->plan_id);
            $st->setAmount($request->amount);

            $st->validate();

           $st->save();

        } catch (\Throwable $th) {
            return DexReponse::json($request,true,$th->getMessage(),[],402);
        }


        return DexReponse::json($request,true,'stake is validated',$stake);
    }

    public function stakeHistory (HttpRequest $request) {

        $stakes = Stake::where('user_id',Auth::user()->id)->orderBy('id','desc')->limit(10)->with('plan')->with('stakeDetails')->get();

        return DexReponse::json($request,true,'stakes',$stakes);
    }


    public function referral (HttpRequest $request) {

        $user = Auth::user()->id;
        
        $career = new UserCareerResponse();

        return DexReponse::json($request,true,'referral',$career->get($user));
    }
}