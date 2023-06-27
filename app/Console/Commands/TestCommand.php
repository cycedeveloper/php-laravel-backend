<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Models\Admin;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Auth;
use stdClass;

class TestCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:test';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */


      public function referral($user)
      {
        
      }

    public function handle()
    {       

        $user = Admin::find(1);
        dd($user);
        //RefreshAllSponsors::dispatch(215)->onQueue('referral');



        /*
        $stakes = Stake::whereDate('created_at', '>', '2022-09-15')->confirmed()->get();
        $dates = [];
        foreach ($stakes as $stake) {
            ReferralIncome::dispatch($stake->id)->onQueue('wallet');
            $dates[] = (string) $stake->created_at;
            echo $stake->created_at.' - id ';
        }


        // SaveReferralIncome::save(Stake::find(30));


        return;



        $unilevel = new  UnilevelUserReferral(35);
        $childs   =  $unilevel->childsTree->setTemperKey('withLevelLimits')->rebuild()->set()->limitLevelsUsers()->get();


        return;
        // RefreshSponsorsDetailsJob::dispatch(199);
        // $Stake = Stake::find('78')->refreshTotal();



        return ;
     //

    //     $unilevel->childsTree->rebuild();
      //


        /*

    $us = User::find(119)->balanceToken(2)->refresh();
   //  dd(Accounting::all(35));

        */
    //




        // $user->referral->sposorsRefresh();


        // $event->markEmailAsVerified();
        //dd($u->wallets());


        // $f = FeeCalculator::calculate(1,100);

        //  AddFee::save(1,100,'WITHDRAW',1);
        // $ac = PaymentWalletsDeposit::find(22)->accounting();
        // dd($ac->getTotal()) ;



        //$save = new Withdraw(1,1,1,100);
        //$save->validate();
        //  dd($save->save());

        //$withdraw = ModelsWithdrawal::find(12);
        //dd($withdraw->getTotalPending($withdraw->user_id,$withdraw->token_id));

        //  $a = new WithdrawalAccounting(1,49);
        // $a->refreshTotals();
        /*
     $u = User::find(130);
     $f = $u->createToken('auth_token')->plainTextToken;
     dd($f);
     dd($u->wallets());
     */

        /*
        $withdraw = new Withdraw(1,1,1,100);
        $withdraw->validate();
         $withdraw->save();
         */

        //  $u = User::find(1)->balanceToken(1);


        /*
          $ex = new ExchangeHelper();
          $data = [
              'pair_name'      => 'USDTU2',
              'type'           => 'BUY',
              'amount_to_sell' => 200,
              'amount_to_buy'  => null,
              'user_id'        => 43
          ];
          $ex->set($data);
          $ex->exchange();


          */


        /*
        $st = new StakeToken();
        $st->setUser(1);
        $st->setPlan(2);
        $st->setAmount(100);

        $d = $st->init();

        $d = $st->save();
        */

       //

        // $s->stakeDetails->checkProfits();

        /*
       $create = new CreateReferralIncome();
       $create->setUser(11);
       $create->setToken(2);
       $create->setRelatedId(1);
       $create->setAmount(20);
       $create->setType('stake');
       $create->save();

        */


        // $s = Stake::find(26);
        // $s->stakeDetails->checkProfits();
    }
}
