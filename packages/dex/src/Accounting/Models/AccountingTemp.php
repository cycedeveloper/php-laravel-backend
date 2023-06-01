<?php
namespace Sayedsoft\Dex\Accounting\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Sayedsoft\Dex\Base\Helpers\NF;
use Sayedsoft\Dex\Base\Traits\UserBelongTrait;
use Sayedsoft\Dex\Token\Traits\TokenBelongsTrait;
use Sayedsoft\ExchangeToken\Exchange\Helpers\CurrencyConvert;

class AccountingTemp extends Model
{
    use UserBelongTrait;

    protected $table = 'dex_accounting_totals_temp';

    protected $fillable = [
        'id',
        'user_id',
        'accounting'
    ];

    protected $hidden = [ 
        'created_at',
        'updated_at'
    ];

    


}
