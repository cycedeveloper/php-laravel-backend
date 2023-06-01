<?php

namespace Sayedsoft\StakeToken\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Sayedsoft\Dex\Base\Traits\UserBelongTrait;
use Sayedsoft\Dex\Token\Traits\TokenBelongsTrait;
use Sayedsoft\StakeToken\Helpers\StakeAccounting;
use Sayedsoft\StakeToken\Models\StakeDetails;
use Sayedsoft\StakeToken\Traits\StakeStatusTrait;

class Stake extends Model
{
    use HasFactory;
    use UserBelongTrait;
    use TokenBelongsTrait;
    use StakeStatusTrait;

    protected $table = 'dex_stakes';


    protected $fillable = [
        'id',
        'stake_plan_id',
        'user_id',
        'amount',
        'start_date',
        'end_date',
        'admin_note',
        'status',
        'has_referral',
        'admin_note'
    ];

    public function plan()
    {
        return $this->belongsTo(StakesPlan::class, 'stake_plan_id', 'id');
    }

    public function stakeDetails()
    {
        return $this->hasOne(StakeDetails::class, 'stake_id', 'id');
    }


    public function refreshTotal()
    {
        $w =  new  StakeAccounting($this->plan->token_id, $this->user_id, $this->id);
        $w->refreshTotals();
    }



    protected static function boot()
    {
        parent::boot();

        // auto-sets values on creation
        static::creating(function ($query) {
            $query->start_date =  Carbon::now() ;

            $query->status     =  'pending';
        });
    }
}
