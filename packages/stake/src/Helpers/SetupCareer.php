<?php

namespace Sayedsoft\StakeToken\Helpers;
 
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Sayedsoft\StakeToken\Models\Career\Career;
use Sayedsoft\StakeToken\Models\Career\CareerTerms;
use Sayedsoft\StakeToken\Models\Career\CareerTermsDetails;
use stdClass;

 class SetupCareer {

    public static function setup() {
    

        

     try {
                    DB::beginTransaction();

                      $career =  Career::create([
                                'name' =>  'New Staker' ,
                                'default' => true ,
                        ]);

                    $saveTerm = CareerTerms::create([
                        'name' => 'Min Teem Ciro' ,
                        'term_key' => 'teamciro' ,
                        'type' => 'amount_required',
                    ]);

                    $careers = [
                        1 => 5000,
                        2 => 100000,
                        3 => 200000,
                        4 => 300000,
                        5 => 400000,
                        6 => 500000,
                        7 => 750000,
                        8 => 1000000,
                    ];

                    foreach ($careers as $no => $ciro) {
                        $career =  Career::create([
                                'name' =>  $no.'. Career' ,
                                'default' => false ,
                        ]);

                        $careerd =  CareerTermsDetails::create([
                                'term_id' =>  $saveTerm->id ,
                                'career_id' =>  $career->id ,
                                'value_num_1' => $ciro,
                                'trem_details' => json_encode([])
                        ]);
                    }
       
            DB::commit();
        } catch (\Throwable $th) {
                DB::rollBack();
                throw($th);
        }
          
        
    }

  
 }