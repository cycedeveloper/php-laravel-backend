<?php
namespace Sayedsoft\StakeToken\Stake;

use App\Models\User;

use Sayedsoft\StakeToken\Validations\StakeAmountValidate;
use Sayedsoft\StakeToken\Validations\UserBanalceValidate;
use Sayedsoft\StakeToken\Validations\UserCanStake;

trait StakeValidate {

    public $validated = false;

    protected $validations = [
        StakeAmountValidate::class,
        
    ];

    public function addValidate($class) {
        $this->validations[] = $class;
        return $this;
    }
    
    public function validate() {

        if ($this->validated) return $this;
        
        $this->init();


        foreach ($this->validations as $i => $class) { $class::validate($this);  }

        $this->validated = true;


        return $this;
    }

    


}