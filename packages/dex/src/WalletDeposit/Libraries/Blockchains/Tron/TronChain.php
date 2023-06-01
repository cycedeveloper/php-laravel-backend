<?php
namespace Sayedsoft\Dex\WalletDeposit\Libraries\Blockchains\Tron;



use IEXBase\TronAPI\Provider\HttpProvider;
use IEXBase\TronAPI\Tron;


class TronChain {


    public static function createWallet () {
        $fullNode = new HttpProvider('https://api.trongrid.io');
        $solidityNode = new HttpProvider('https://api.trongrid.io');
        $eventServer = new HttpProvider('https://api.trongrid.io');
        try {
            $tron = new Tron($fullNode, $solidityNode, $eventServer);
        } catch (\IEXBase\TronAPI\Exception\TronException $e) {
            abort(500);
        }
        $address = $tron->createAccount();
        return array("address" => $tron->fromHex($address->getAddress()) , "private_key" => $address->getPrivateKey(), "pubic_key" => $address->getPublicKey());
    }

    public static  function  isAddress($address) {
        $fullNode = new HttpProvider('https://api.trongrid.io');
        $solidityNode = new HttpProvider('https://api.trongrid.io');
        $eventServer = new HttpProvider('https://api.trongrid.io');
        try {
            $tron = new \IEXBase\TronAPI\Tron($fullNode, $solidityNode, $eventServer);
        } catch (\IEXBase\TronAPI\Exception\TronException $e) {
            abort(500);
        }
        return $tron->validateAddress($address)['result'];
      }


}