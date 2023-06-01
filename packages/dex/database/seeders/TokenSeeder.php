<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Sayedsoft\Dex\Models\Token;

class TokenSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Token::create([
            'token_code' => 'USDT',
            'token_name' => 'USDT',
            'contract_address' => 'TR7NHqjeKQxGTCi8q8ZY4pL8otSzgjLj6t',
            'contract_address_test' => 'TBgs5LC9haaHJChdd423sBHvdEVX82Mga5',
            'blockchain' => 'TRC20',
            'is_default' => '0',
            'payable' => '0',
            'withdrawable' => '0',
            'disabled' => '0',
        ]);
    }
}
