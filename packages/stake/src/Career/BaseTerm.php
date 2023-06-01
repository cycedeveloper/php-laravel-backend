<?php 
namespace Sayedsoft\StakeToken\Career;

use Sayedsoft\StakeToken\Models\Career\Career;
use Sayedsoft\StakeToken\Models\Career\CareerTerms;


class BaseCareerTerms {

  
    public $term_key;

    public $term_model;

    public $user;

    public $career;

    public $inited = false;

    private function setTerm() {
        if ($this->term_model instanceof CareerTerms) { return $this->term_model; } 
        $this->term_model = CareerTerms::where('term_key',$this->term_key)->first();
        return $this->term_model;
    }


    function setCareer(Career $career) {

        $this->career = $career;


        return $this->career;
    }


    private function init() {
        if ($this->inited) {
            return;
        }

        $this->setTerm();

        


    }

    public function validate($user, $career_id) {
      
    }



    /**
     * Get the value of inited
     */ 
    public function getInited()
    {
        return $this->inited;
    }

    /**
     * Set the value of inited
     *
     * @return  self
     */ 
    public function setInited($inited)
    {
        $this->inited = $inited;

        return $this;
    }
}