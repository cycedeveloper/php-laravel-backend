<?php
namespace Sayedsoft\ReferralUnilevel\Helpers\Utils;

use Exception;
use Sayedsoft\ReferralUnilevel\Core\Errors\ReturnErrorTrait;
use Sayedsoft\ReferralUnilevel\Traits\Referral\UserSetter;



class Temper  {

    use UserSetter;

    use ReturnErrorTrait;

    protected $model;

    protected $key;

    private $isValidated = false;

    public function __construct($user) {
        $this->setUser($user);
    }

    private function validate () {
        if ($this->isValidated) { return $this;  }
       $this->checkUser();

       if ($this->model == null) {
      //   $this->model = BinaryDetailsTempModel::class;
       }

       if (empty($this->key)) {
         $this->ReturnError('Key is not setted');
       }
    }

    public function hasTemp () {
        return $this->model::whereUserId($this->getUserId())->whereTempKey($this->getKey())->exists();
    }

    public function getTemp () {
        $this->checkUser();

        if ($this->hasTemp()) {

           return json_decode($this->model::whereUserId($this->getUserId())->whereTempKey($this->getKey())->first()->temp);
        }  

        return null;
    }



    public function updateTemp (Object $data) {

        $this->validate();

        $saved = $this->model::updateOrCreate([
            'user_id' => $this->getUserId(),
            'temp_key' => $this->getKey(),
        ],[
            'user_id' => $this->getUserId(),
            'temp' => json_encode($data),
            'temp_key' => $this->getKey(),
        ]);

        if (!isset($saved->temp) ) {
            throw new Exception('Invalid temp row');
        }

        return json_decode($saved->temp);
    }



    /**
     * Get the value of key
     */ 
    public function getModel()
    {
        return $this->model;
    }

    /**
     * Set the value of key
     *
     * @return  self
     */ 
    public function setModel($model)
    {   
        
        $this->model = $model;

        return $this;
    }


    /**
     * Get the value of key
     */ 
    public function getKey()
    {
        return $this->key;
    }

    /**
     * Set the value of key
     *
     * @return  self
     */ 
    public function setKey($key)
    {
        $this->key = $key;

        return $this;
    }
}