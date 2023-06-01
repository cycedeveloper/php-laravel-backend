<?php

namespace Sayedsoft\ExchangeToken\Models;


use Illuminate\Database\Eloquent\Model;
use Sayedsoft\Dex\Token\Models\Token;
use Sayedsoft\ExchangeToken\Models\ExchangeFeeFace;
 
class ExchangePairs extends Model
{
    protected $table = 'dex_exchange_pairs';

    protected $appends = [
        
    ];

    protected $fillable = [
        'name',
        'base_asset',
        'quote_asset',
        'price',
        'min_tradable',
        'max_tradable',
        'fee_face_id'
    ];


    function feeFace() {
        return $this->belongsTo(ExchangeFeeFace::class,'fee_face_id','id');
    }

    function baseAsset() {
        return $this->belongsTo(Token::class,'base_asset','id');
    }


    function quoteAsset() {
        return $this->belongsTo(Token::class,'quote_asset','id');
    }

}
