<?php

namespace Sayedsoft\StakeToken\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Sayedsoft\Dex\Base\Helpers\NF;
use Sayedsoft\Dex\Token\Models\Token;
use Sayedsoft\StakeToken\Helpers\StakeDateHelper;
use Sayedsoft\StakeToken\Helpers\StakePeriods;
use stdClass;

class StakesPlan extends Model
{
    use HasFactory;

    protected $table = 'dex_stakes_plans';

    protected $fillable = [
        'id',
        'name',
        'token_id', 
        'period_type',
        'period_interval',
        'profit_period_type',
        'percentile_profit',
        'min_amount',
        'max_amount',
        'active'
    ];

    public function token()
    {
        return $this->belongsTo(Token::class,'token_id','id');
    }

    public function startDate() {
        return Carbon::now();
    }

    public function endDate ($startDate = null) {
       $startDate =   ($startDate == null) ? Carbon::now() : $startDate;
       return StakeDateHelper::addPeriodsToDate($startDate,$this->period_type,$this->period_interval);
    }

    public function profitsPeriodsCount ($startDate = null) {
        $endDate = $this->endDate($startDate);
        return StakeDateHelper::getDiffByType($this->profit_period_type,$endDate);
    }


    public function periodProfit ($total = 0) {
         return  ($total * $this->percentile_profit) / 100;
    }

    public function totalPeriodsProfit ($total = null) {
        return $this->periodProfit($total) * $this->period_interval;
    }   

    public function perPeriodProfit ($total = null,$startDate = null) {
        $total = $this->totalPeriodsProfit($total);
        $count = $this->profitsPeriodsCount($startDate);
        return NF::set(($total / $count )); 
    }   

    public function preview ($total = null,$startDate = null) {
        $stake = new stdClass();

        $stake->endDate             = $this->endDate($startDate);
        $stake->profitsPeriodsCount = $this->profitsPeriodsCount($startDate);
        $stake->periodProfit        = $this->periodProfit((float)$total);
        $stake->totalPeriodsProfit  = $this->totalPeriodsProfit((float)$total,$startDate);
        $stake->perPeriodProfit     = $this->perPeriodProfit((float)$total,$startDate);
        $stake->profitPeriod        = StakePeriods::getPeriods($this->profit_period_type);
        $stake->stakePeriod         = StakePeriods::getPeriods($this->period_type);
        return $stake;
    }

}
