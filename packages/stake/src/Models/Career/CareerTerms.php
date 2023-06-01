<?php

namespace Sayedsoft\StakeToken\Models\Career;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Sayedsoft\Dex\Base\Traits\UserBelongTrait;
use Sayedsoft\Dex\Token\Traits\TokenBelongsTrait;
use Sayedsoft\StakeToken\Helpers\StakeAccounting;
use Sayedsoft\StakeToken\Traits\StakeStatusTrait;

class CareerTerms extends Model
{
    use HasFactory;
    use UserBelongTrait;

    protected $table = 'dex_careers_terms';

    protected $fillable = [
        'id',
        'name',
        'term_key',
        'type'
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];


    public function career()
    {
        return $this->belongsTo(Career::class, 'career_id', 'id');
    }
}
