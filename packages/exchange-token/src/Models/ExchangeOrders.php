<?php

namespace Sayedsoft\ExchangeToken\Models;

use Illuminate\Database\Eloquent\Model;
use Sayedsoft\Dex\Base\Traits\UserBelongTrait;
use Sayedsoft\ExchangeToken\Exchange\ExchangeAccounting;
use Sayedsoft\ExchangeToken\Models\ExchangePairs;

class ExchangeOrders extends Model
{   
    use UserBelongTrait;

    protected $table = 'dex_exchange_orders';

    protected $appends = [
        
    ];

    protected $fillable = [
        'name',
        'user_id',
        'pair_id',
        'price',
        'base_amount',
        'quote_amount',
        'base_fee_amount',
        'quote_fee_amount',
        'type'
    ];

    public function pair() {
        return $this->belongsTo(ExchangePairs::class,'pair_id','id');
    }

    public function refreshTotal() {
        $w =  new  ExchangeAccounting($this->user_id);
        $w->setUser_id($this->user_id);
        $w->setToken_id($this->token_id);
        $w->setPair($this->pair);
        $w->refreshTotal();
    }
    


}
