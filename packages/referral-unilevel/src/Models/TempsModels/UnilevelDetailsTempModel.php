<?php

namespace Sayedsoft\ReferralUnilevel\Models\TempsModels;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Sayedsoft\Dex\Base\Traits\UserBelongTrait;

class UnilevelDetailsTempModel extends Model
{
    use HasFactory, UserBelongTrait;

    protected $table = 'dex_unilevel_details_temp';

    protected $fillable = [ 
        'user_id',
        'temp',
        'temp_key'
    ];

    protected $casts = [
        'temp' => 'array'
    ];

    
}
