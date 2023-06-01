<?php

namespace Sayedsoft\ReferralUnilevel\Models\TempsModels;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Sayedsoft\Dex\Base\Traits\UserBelongTrait;
use Sayedsoft\ReferralUnilevel\Core\UserReferral\UnilevelUserReferral;

class UnilevelChildsTemp extends Model
{
    use HasFactory;
    use UserBelongTrait;

    protected $table = 'dex_unilevel_childs_temp';

    protected $fillable = [
        'user_id',
        'temp',
        'temp_key'
    ];

    protected $casts = [
        'temp' => 'array'
    ];

    protected static function boot()
    {
        parent::boot();

        // auto-sets values on creation
        static::created(function ($query) {
            $unilevel = new  UnilevelUserReferral($query->user_id);
            $unilevel->childsTree->setTemperKey('withLevelLimits')->rebuild()->set()->limitLevelsUsers()->get();
        });


        static::updated(function ($query) {
            $unilevel = new  UnilevelUserReferral($query->user_id);
            $unilevel->childsTree->setTemperKey('withLevelLimits')->rebuild()->set()->limitLevelsUsers()->get();
        });
    }
}
