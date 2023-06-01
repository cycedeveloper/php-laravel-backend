<?php

namespace Sayedsoft\StakeToken\Models\Career;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Sayedsoft\Dex\Base\Traits\UserBelongTrait;
use Sayedsoft\StakeToken\Career\CareerAccounting;
use Sayedsoft\StakeToken\Models\Career\Career;

class UserCareerProfits extends Model
{
    use HasFactory;
    use UserBelongTrait;

    protected $table = 'dex_users_career_profits';

    protected $fillable = [
        'id',
        'user_id',
        'career_id',
        'amount',
         'staked'
    ];


    protected $hidden = [
    'created_at',
    'updated_at'
    ];



    public function career()
    {
        return $this->belongsTo(Career::class, 'career_id', 'id');
    }

    public function refreshTotal()
    {
        $w =  new  CareerAccounting(1, $this->user_id);
        $w->refreshTotals();
    }
}
