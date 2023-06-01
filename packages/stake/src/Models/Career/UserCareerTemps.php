<?php

namespace Sayedsoft\StakeToken\Models\Career;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Sayedsoft\Dex\Base\Helpers\NF;
use Sayedsoft\Dex\Base\Traits\UserBelongTrait;
use Sayedsoft\StakeToken\Models\Career\CareerTerms;
use stdClass;
use Syriancoders\DexCareer\Models\Career;

class UserCareerTemps extends Model
{
    use HasFactory;
    use UserBelongTrait;

    protected $table = 'dex_users_career_temps';

    protected $fillable = [
        'id',
        'user_id',
        'temp'
    ];


    protected $casts = [
    'temp' => 'array'
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];
}
