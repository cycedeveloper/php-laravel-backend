<?php
namespace Sayedsoft\ExchangeToken\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class ExchangeFeeFace extends Model
{
    use HasFactory;

    protected $table = 'dex_exchange_fee_faces';

    protected $fillable = [
        'id',
        'name',
        'base_type',
        'base_fixed_amount',
        'base_percent_amount',

        'quote_type',
        'quote_fixed_amount',
        'quote_percent_amount',
    ];
    
    
}
