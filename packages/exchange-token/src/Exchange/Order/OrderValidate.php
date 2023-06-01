<?php
namespace Sayedsoft\ExchangeToken\Exchange\Order;

use App\Models\User;
use Sayedsoft\ExchangeToken\Exchange\Validations\OrderAmountValidate;
use Sayedsoft\ExchangeToken\Exchange\Validations\UserBanalceValidate;

trait OrderValidate {

    public $validated = false;

    protected $validations = [
        UserBanalceValidate::class,
        OrderAmountValidate::class
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