<?php
namespace Sayedsoft\DexWithdrawal\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Sayedsoft\Dex\Fees\Models\FeeFace;
use Sayedsoft\Dex\Token\Traits\TokenBelongsTrait;

class WithdrawalTokenSettings extends Model
{   
    use HasFactory,TokenBelongsTrait;

    protected $table = 'dex_tokens_withdrawal_settings';

    protected $fillable = [
        'id',
        'user_id',
        'fee_face_id',
        'min_amount',
        'max_amount'
    ];

    function feeFace() {
        return $this->belongsTo(FeeFace::class,'fee_face_id','id');
    }


}
