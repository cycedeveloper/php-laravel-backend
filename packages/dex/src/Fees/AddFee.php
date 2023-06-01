<?php
namespace Sayedsoft\Dex\Fees;


use Exception;

use Sayedsoft\Dex\Fees\Models\Fees;

class AddFee  {
       
    private static function isExsite($related_id,$type) {
        $get =  Fees::where('related_id',$related_id)->where('for_type',$type)->first();
        return (!$get) ? false : true;
    }
    
    public static function save ($fee_id,$total_amount,$user_id,$type,$related_id) {
        if (self::isExsite($related_id,$type)) { return; }
        $fee = new FeeCalculator($fee_id,$total_amount);
        $fee_amount = $fee->calculate($fee_id,$total_amount);
        Fees::create([
            'user_id' => $user_id,
            'token_id' =>  $fee_amount['face']->token_id,
            'fee_face_id' =>  $fee_id,
            'related_id' => $related_id,
            'amount' =>  $fee_amount['amount_fee'],
            'for_type' => $type,
        ]);
    }

    
}