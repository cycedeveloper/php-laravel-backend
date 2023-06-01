<?php
namespace Sayedsoft\Dex\Fees\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Sayedsoft\Dex\Base\Traits\UserBelongTrait;
use Sayedsoft\Dex\Token\Traits\TokenBelongsTrait;

class Fees extends Model
{
    use HasFactory,TokenBelongsTrait;

    protected $table = 'dex_fees';

    protected $fillable = [
        'id',
        'name',
        'token_id',
        'related_id',
        'fee_face_id',
        'amount',
        'for_type'
    ];
    
    public function scopeFor($query,$user_id,$token_id,$for_type) {
        return $query->where('user_id',$user_id)->where('token_id',$token_id)->where('for_type',$for_type);
    }
    
    
}
