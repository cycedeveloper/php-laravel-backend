<?php
namespace Sayedsoft\ReferralUnilevel\Traits\Referral;

use Exception;
use Sayedsoft\ReferralUnilevel\Helpers\Utils\Temper;


trait TemperSetter {

    private $temper;

    private $temperInited = false;

        /**
     * Get the value of positionsTypes
     */ 
    public function getTemper()
    {       
        if (!$this->temperInited) {
           throw new Exception('No temper has inited!');
        }

        return $this->temper;
    }

    /**
     * Set the value of positionsTypes
     *
     * @return  self
     */ 
    public function initTemper(
        $user,
        $key,
        $model = null
    )
    {   
        if (!$this->temperInited) { 
            $temper = new Temper($user);
            $temper->setKey($key);
            if ($model != null) {
                $temper->setModel($model);
            }
            $this->temper = $temper;

            $this->temperInited = true;
         }

         return;
    }
}