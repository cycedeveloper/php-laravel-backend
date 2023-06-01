<?php
namespace Sayedsoft\Dex\Base\Traits;


use App\Models\User;


trait UserBelongTrait {
    
    public function user()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }


}