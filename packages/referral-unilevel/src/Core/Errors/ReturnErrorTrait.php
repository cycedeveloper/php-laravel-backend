<?php
namespace Sayedsoft\ReferralUnilevel\Core\Errors;

use Exception;

trait ReturnErrorTrait {

    public $returnWithError = false;

     /**
     * Get the value of returnWithError
     */ 
    public function getReturnWithError()
    {
        return $this->returnWithError;
    }

    /**
     * Set the value of returnWithError
     *
     * @return  self
     */ 
    public function setReturnWithError($returnWithError)
    {
        $this->returnWithError = $returnWithError;

        return $this;
    }

     public function returnError ($message) {
        if ($this->returnWithError) throw new Exception($message, 1);
        return false;
     }
}