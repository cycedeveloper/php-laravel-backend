<?php
namespace Sayedsoft\Dex\WalletDeposit\Libraries\Blockchains\Tron;


use Illuminate\Support\Facades\Log;

class Tron {
     

    private $network = 'https://api.trongrid.io';
    private $address    = 'TQcJuXzkzPWWdM3wUU9Y7qKXUL2mHe81UT';
    private $privateKey = '902fcef8dcdaa9741db3b7a82dc2d097894046cf7c549ed9a1855312c36cbc8e';
    private $tron;

    public function __construct()
    {
     // $this->isTest();
    }

    public function isTest() {
        $this->network            = 'https://api.shasta.trongrid.io';
        return $this;
    }


    public function setWallet ($address,$privateKey) {
        $this->address = $address; 
        $this->privateKey = $privateKey; 
        return $this;
    }

    public function init () {
        $this->tron   = $this->tron ();
        $this->tron->setAddress($this->address);
        $this->tron->setPrivateKey($this->privateKey);
        return $this;
    }
     
    public function tron () {
        $link         = $this->network;
        $fullNode     = new \IEXBase\TronAPI\Provider\HttpProvider($link);
        $solidityNode = new \IEXBase\TronAPI\Provider\HttpProvider($link);
        $eventServer  = new \IEXBase\TronAPI\Provider\HttpProvider($link);
        try {
            $tron = new \IEXBase\TronAPI\Tron($fullNode, $solidityNode, $eventServer);
        } catch (\IEXBase\TronAPI\Exception\TronException $e) {
            Log::error($e->getMessage());
            die($e);
        }
        return $tron;
    }

    public function toSun ($amount) {
        return number_format($amount*pow(10,6),0,'','') ;
    }
  
    public function fromSun ($amount) {
        return number_format((float)$amount/pow(10,6),2,'.','') ;
    }

    private function getAbiJson () {
        return json_decode(file_get_contents(storage_path('TRC20.json')),true) ;
      }

    public function getAddressBalanceFromContract($address,$contract_address) {
        $result   = $this->tron->getTransactionBuilder()->triggerSmartContract(
              $this->getAbiJson(), // abi for smart contact
              $this->tron->toHex($contract_address), // smart contract address
              'balanceOf',
              array("0"=>$this->tron->toHex($address)),
              1000000000,
              $this->tron->toHex($this->address),
              0,
              0
        );
        $balance_hex = $result["0"];
        $balance     = $this->fromSun($balance_hex->value);
        return $balance;
    }

    public function getTRXBalance($address) {
        $balance = $this->tron->getBalance($address);
        $balance = number_format((float)$balance/pow(10,6),0) ;
        return $balance;
    }

    public function getBalance($address = null,$contract_address =  null) {
        $from_address = $this->address; if ($address !== null) $from_address = $address;
        if ($contract_address !== null) return $this->getAddressBalanceFromContract($from_address,$contract_address);
        return $this->getTRXBalance($from_address);
    }

    public function sendTrx ($ToAddress,$amount) {
        try { $transfer = $this->tron->send($this->tron->toHex($ToAddress),$amount); } 
        catch (\IEXBase\TronAPI\Exception\TronException $e) { die($e->getMessage()); }
        if (isset($transfer['result']) and $transfer['result'] === true) return true;
        return false;
    }


    public function getTransactionsAddress ($address = null) {
        $from_address = $this->address; if ($address !== null) $from_address = $address;
        try {
          $client = new \GuzzleHttp\Client();
          $res    = $client->get($this->network.'/v1/accounts/'.$from_address.'/transactions/trc20?only_confirmed=true&only_to=true');
          $data   = json_decode($res->getBody()->getContents()) ;
          if (isset($data->data) && !empty($data->data))  return $data->data;
          return [];
        } catch (\IEXBase\TronAPI\Exception\TronException $e) { Log::error($e->getMessage()); die($e); }
    }

    public function sendToken ($to_address,$contract_address,$amount) {
        $result   = $this->tron->getTransactionBuilder()->triggerSmartContract(
            $this->getAbiJson(),
            $this->tron->toHex($contract_address), // smart contract address
            'transfer',
            array(
                "0" => $this->tron->toHex($to_address),
                "1" => $this->toSun ($amount)
            ),
            1000000000,
            $this->tron->toHex($this->address), 0, 0
        );
        $signTransaction = $this->tron->signTransaction($result);
        return $this->tron->sendRawTransaction($signTransaction);
    }
}