<?php

namespace Sayedsoft\StakeToken\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Sayedsoft\Dex\Base\Traits\UserBelongTrait;
use Sayedsoft\Dex\Token\Traits\TokenBelongsTrait;
use Sayedsoft\ReferralIncome\Income\CreateReferralIncome;
use Sayedsoft\StakeToken\Helpers\StakeDateHelper;
use Sayedsoft\StakeToken\StakeToken;

class StakeDetails extends Model
{
    use HasFactory;
    use TokenBelongsTrait;

    protected $table = 'dex_stake_details';

    protected $appends = [

    ];

    protected $fillable = [
        'id',
        'stake_id',
        'token_id',
        'period_type',
        'period_interval',
        'total_profits',
        'profit_period_type',
        'profit_period_count',
        'profit_period_amount',
        'deserved_profit_period',
        'percentile_profit',
        'deserved_profit'
    ];

    public function stake()
    {
        return $this->belongsTo(Stake::class, 'stake_id', 'id');
    }


    public function privew()
    {
        $plan = $this->stake->plan;
        return $plan->preview($this->stake->amount, $this->stake->start_date);
    }

    public function checkProfits()
    {
        if ($this->stake->status != 'confirmed') {
            return;
        }

        try {
            DB::beginTransaction();

            if ($this->stake->end_date < Carbon::now()) {
                $this->stake->end();
                return;
            }

            $deserved_periods_count = StakeDateHelper::getDiffByType($this->profit_period_type, $this->stake->start_date);

            $deserved_periods_amount = $deserved_periods_count * $this->profit_period_amount;

            $this->deserved_profit_period = $deserved_periods_count;

            $this->deserved_profit = $deserved_periods_amount;

            $this->save();

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            throw($th);
        }
    }
}
