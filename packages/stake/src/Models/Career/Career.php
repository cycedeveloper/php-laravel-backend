<?php

namespace Sayedsoft\StakeToken\Models\Career;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Sayedsoft\Dex\Base\Traits\UserBelongTrait;
use Sayedsoft\Dex\Token\Traits\TokenBelongsTrait;
use Sayedsoft\StakeToken\Helpers\StakeAccounting;
use Sayedsoft\StakeToken\Models\Career\CareerTermsDetails;
use Sayedsoft\StakeToken\Traits\StakeStatusTrait;

class Career extends Model
{
    use HasFactory;
    use UserBelongTrait;

    protected $table = 'dex_careers';

    protected $fillable = [
        'id',
        'name',
        'default',
        'amount_profit',

    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'default'
    ];

    public function terms()
    {
        return $this->hasMany(CareerTermsDetails::class, 'career_id', 'id');
    }
}
