<?php

namespace Sayedsoft\StakeToken\Models\Career;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Sayedsoft\StakeToken\Models\Career\Career;
use Sayedsoft\StakeToken\Models\Career\CareerTerms;

class CareerTermsDetails extends Model
{
    use HasFactory;

    protected $table = 'dex_career_terms_details';

    protected $fillable = [
        'id',
        'term_id',
        'career_id',
        'value_num_1',
        'value_num_2',
        'term_details'
    ];


    protected $casts = [
       'term_details' => 'array'
    ];

    protected $hidden = [
        'id',
        'created_at',
        'updated_at',
        'term_id',
        'career_id'
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
