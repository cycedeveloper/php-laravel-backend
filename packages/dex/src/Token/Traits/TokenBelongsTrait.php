<?php
namespace Sayedsoft\Dex\Token\Traits;

use Sayedsoft\Dex\Token\Models\Token;

trait TokenBelongsTrait {

    
    public function token()
    {
        return $this->belongsTo(Token::class,'token_id','id');
    }


    public function scopeToken($query,$token_id) {
        return $query->where('token_id',$token_id);
    }

}