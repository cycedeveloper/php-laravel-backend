<?php
namespace Sayedsoft\Dex\Fees\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Sayedsoft\Dex\Accounting\Traits\TotalsTrait;
use Sayedsoft\Dex\Base\Traits\UserBelongTrait;
use Sayedsoft\Dex\Token\Traits\TokenBelongsTrait;

class FeeFace extends Model
{
    use HasFactory, TokenBelongsTrait,UserBelongTrait;

    protected $table = 'dex_fee_faces';

    protected $fillable = [
        'id',
        'user_id',
        'type',
        'fixed_amount',
        'percent_amount'
    ];
    
    

}
