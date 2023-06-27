<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bank extends Model
{
    use HasFactory;

    protected $table = 'dex_banks';

    protected $fillable = [
        'bank_name',
        'bank_code',
        'default_iban',
        'default_iban_description',
        'payable',
        'withdrawable'
    ];

}