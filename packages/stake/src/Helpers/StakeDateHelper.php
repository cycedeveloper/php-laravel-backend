<?php

namespace Sayedsoft\StakeToken\Helpers;
 
use Carbon\Carbon;

 class StakeDateHelper {

    public static function getDiffByType($period_type,$from) {
        $time = ($from == null) ? Carbon::now() : Carbon::parse($from);
       
        switch ($period_type) {
            case 'hour':
                return $time->diffInHours(false);
                break;
            case 'day':
                return $time->diffInDays(false);
                break;
            case 'month':
                return $time->diffInMonths(false);
                break;
            case 'year':
                return $time->diffInYears(false);
                break;
            default:
                
                break;
        } 
    }


    public static function getDiff($period_type,$period_interval,$diff_type,$from = null ) {
        $time = ($from == null) ? Carbon::now() : Carbon::parse($from);
        switch ($period_type) {
            case 'hour':
                $time->addHours($period_interval);
                break;
            case 'day':
                $time->addDays($period_interval);
                break;
            case 'month':
                $time->addMonths($period_interval);
                break;
            case 'year':
                $time->addYears($period_interval);
                break;
            default:
                
                break;
        } 


        switch ($diff_type) {
            case 'hour':
                return $time->diffInHours(false);
                break;
            case 'day':
                return $time->diffInDays(false);
                break;
            case 'month':
                return $time->diffInMonths(false);
                break;
            case 'year':
                return $time->diffInYears(false);
                break;
            default:
                
                break;
        } 
    }


    public static function addPeriodsToDate($time,$period_type,$period_interval) {
        $date = Carbon::parse($time);
        switch ($period_type) {
            case 'hour':
                return $date->addHours($period_interval);
                break;
            case 'day':
                return $date->addDays($period_interval);
                break;
            case 'month':
                return $date->addMonths($period_interval);
                break;
            case 'year':
                return $date->addYears($period_interval);
                break;
            default:
                return $period_interval;
                break;
        } 
    }


    public static function endsAt($period_type,$period_interval) {
        switch ($period_type) {
            case 'hour':
                return Carbon::now()->addHours($period_interval);
                break;
            case 'day':
                return Carbon::now()->addDays($period_interval);
                break;
            case 'month':
                return Carbon::now()->addMonths($period_interval);
                break;
            case 'year':
                return Carbon::now()->addYears($period_interval);
                break;
        }
    }

    public static function getDiffFromNow($time,$period_type) {
        $date = Carbon::parse($time);
        $now  = Carbon::now();

        switch ($period_type) {
            case 'day':
                return $now->diffInHours($date);
                break;
            case 'day':
                return $now->diffInDays($date);
                break;
            case 'month':
                return $now->diffInMonths($date);
                break;
            case 'year':
                return $now->diffInYears($date);
                break;
        }
    }

    public static function getDiffTowDates($from,$to,$period_type) {
        $from = Carbon::parse($from);
        $to  = Carbon::parse($to);
        
        switch ($period_type) {
            case 'hour':
                return $from->diffInHours($to);
                break;
            case 'day':
                return $from->diffInDays($to);
                break;
            case 'month':
                return $from->diffInMonths($to);
                break;
            case 'year':
                return $from->diffInYears($to);
                break;
        }
    }


 }