<?php
namespace Sayedsoft\DexwithdrawalFiat\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Sayedsoft\Dex\Base\Traits\UserBelongTrait;
use Sayedsoft\Dex\Token\Traits\TokenBelongsTrait;

class UserIban extends Model
{   
    use HasFactory,TokenBelongsTrait,UserBelongTrait;

    protected $table = 'dex_user_ibans';

    protected $appends = [
        
    ];

    protected $fillable = [
        'id',
        'user_id',
        'token_id',
        'iban',
        'label'
    ];

    

}