<?php

namespace Sayedsoft\StakeToken\Helpers;
 
use Carbon\Carbon;
use stdClass;

 class StakePeriods {


    

    public static function set($type,$invterval,$time = null) {

        $time = ($time == null) ? Carbon::now() : Carbon::parse($time);

        $period = self::getPeriods($type);

        $all_periods = self::getPeriods();

        $addFun = $period['addFunction'];  

       

        $date = new stdClass();

        $date->endDate  = $time->$addFun($invterval);

        $diff_periods = [];

        foreach ($all_periods as $name => $period) {

            $diffFun = $period['diffFunction'];  

            $diffDate = $date->endDate->$diffFun();

            $diff_periods[$name] = $diffDate;
        }


        $date->diffPeriods  = $diff_periods;

        return $date;
    }

    public static function getPeriods($key = null) {
        $rows = [
            'year' => [
                'name'  => 'year',
                'lable' => 'Year',
                'childPeriods' => ['month','day'],
                'addFunction' => 'addYears',
                'diffFunction' => 'diffInYears',
            ],
            'month' => [
                'name'  => 'month',
                'lable' => 'Month',
                'childPeriods' => ['day'],
                'addFunction' => 'addMonths',
                'diffFunction' => 'diffInMonths',

            ],
            'day' => [
                'name'  => 'day',
                'lable' => 'Day',
                'childPeriods' => ['hour'],
                'addFunction' => 'addDays',
                'diffFunction' => 'diffInDays',
            ],
            'hour' => [
                'name'  => 'hour',
                'lable' => 'Hour',
                'childPeriods' => [],
                'addFunction' => 'addHours',
                'diffFunction' => 'diffInHours',
            ],
            
            
        ];

        return ($key == null) ? $rows : $rows[$key];
    }


 }