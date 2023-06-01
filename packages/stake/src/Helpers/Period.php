<?php

namespace Sayedsoft\StakeToken\Helpers;
 
use Carbon\Carbon;
use stdClass;

 class Period {

    private $type;
    
    private $interval;

    private $start_date;

    private $end_date;

    public static function get() {

            $period = new stdClass();

            
    }

    /**
     * Set the value of start_date
     *
     * @return  self
     */ 
    public function setStartDate($start_date)
    {
        $this->start_date = $start_date;

        return $this;
    }

    /**
     * Set the value of type
     *
     * @return  self
     */ 
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Set the value of interval
     *
     * @return  self
     */ 
    public function setInterval($interval)
    {
        $this->interval = $interval;

        return $this;
    }

    /**
     * Get the value of end_date
     */ 
    public function getEndDate()
    {
        return $this->end_date;
    }

    /**
     * Set the value of end_date
     *
     * @return  self
     */ 
    private function setEndDate($end_date)
    {
        $this->end_date = $end_date;

        return $this;
    }
 }