<?php

namespace Sayedsoft\ReferralUnilevel\Models\Referral;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Sayedsoft\Dex\Base\Traits\UserBelongTrait;

class UnilevelDetail extends Model
{
    use HasFactory,UserBelongTrait;

    protected $table = 'dex_unilevel_details';

    protected $fillable = [ 
        'user_id',
        'level',
        'detail_key',
        'detail_value',
        'detail_type',
    ];
    
    protected $hidden = [ 
        'id',
        'created_at',
        'updated_at'
    ];

}
