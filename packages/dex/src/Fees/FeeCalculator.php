<?php
namespace Sayedsoft\Dex\Fees;


use Exception;
use Sayedsoft\Dex\Base\Helpers\NF;
use Sayedsoft\Dex\Fees\Models\FeeFace;

class FeeCalculator  {

    public $face_id,$amount;
    public $face;
    
    public function __construct($face_id,$amount)
    {
         $this->face_id = $face_id;
         $this->face =  FeeFace::find($face_id);  ;
         $this->amount = $amount;

         if (!$this->face) {
            throw(New Exception('Face not found'));
       }
    }

    public  function calculate() {
       if ($this->face->type == 'none') {  return $this->setTotals(0);  }
       elseif ($this->face->type == 'fixed') {  return $this->fixedFee();  }
       elseif ($this->face->type == 'percent') {  return $this->percentFee();  }
    }

    private function setTotals($fee) {
            return [
                'amount'     => NF::set($this->amount),
                'amount_fee' => NF::set($fee),
                'total'      => NF::set($this->amount - $fee),
                'face'       => $this->face
            ];
     }

     private  function fixedFee() {
        return $this->setTotals($this->face->fixed_amount);
     }

     private  function percentFee() {
        $percent_amount = $this->face->percent_amount;
        $fee = ($this->amount * $percent_amount) / 100;
        return $this->setTotals($fee);
     }

     public function defaultFee () {
      return [
         'amount'     => NF::set(0),
         'amount_fee' => NF::set(0),
         'total'      => NF::set(0),
         'face'       => $this->face
       ];
     }



    
}