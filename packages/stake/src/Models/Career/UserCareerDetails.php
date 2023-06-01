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

class UserCareerDetails extends Model
{
    use HasFactory;
    use UserBelongTrait;

    protected $table = 'dex_users_careers_details';

    protected $fillable = [
        'user_id',
        'career_id',
        'term_id',
        'term_details',
    ];

    protected $casts = [
        'term_details' => 'json'
    ];

    protected $hidden = [
    'created_at',
    'updated_at'
    ];



    public function career()
    {
        return $this->belongsTo(Career::class, 'career_id', 'id');
    }


    public function term()
    {
        return $this->belongsTo(CareerTerms::class, 'term_id', 'id');
    }
}
