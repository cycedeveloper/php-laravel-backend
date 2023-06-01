<?php
namespace Sayedsoft\StakeToken;

use Exception;
use Sayedsoft\StakeToken\Stake\StakeAmounts;
use Sayedsoft\StakeToken\Stake\StakeValidate;
use Sayedsoft\StakeToken\Stake\Details;
use Sayedsoft\StakeToken\Stake\StakePreview;
use Sayedsoft\StakeToken\Stake\StakeSave;


class StakeToken
{
    
    use Details,
        StakeValidate,
        StakeAmounts,
        StakePreview,
        StakeSave;

    private $inited = false;

    public function  __construct(){}   

    public function init () {

        if ($this->inited) return $this;

        $this->inited = true;        

        $this->details =  $this->getPlan()->preview($this->getAmount());

    }
    

    public function save () {
        
       $this->init();




       $this->validate();

      return  $this->saveDB();
    }

    public function returnError ($message) {
        throw new Exception($message, 1);
    }
   

}
