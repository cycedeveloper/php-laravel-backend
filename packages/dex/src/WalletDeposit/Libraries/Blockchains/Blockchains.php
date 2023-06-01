<?php
namespace Sayedsoft\Dex\WalletDeposit\Libraries\Blockchains;


use Exception;
use Sayedsoft\Dex\WalletDeposit\Libraries\Blockchains\Tron\TronChain;

class Blockchains {

    public static $supported = [
        'TRON' => TronChain::class
    ];
    
    public static function chain ($blockchain) {
        return self::$supported[$blockchain];
    }

    public static function createWallet ($blockchain) {
       $block = self::chain($blockchain);
       return $block->createWallet();
    }
}