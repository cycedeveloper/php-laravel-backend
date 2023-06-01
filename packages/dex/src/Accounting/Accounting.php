<?php
namespace Sayedsoft\Dex\Accounting;

use App\Models\User;
use Sayedsoft\Dex\Accounting\Base\AccountingMain;
use Sayedsoft\Dex\Accounting\Base\AccountingStore;
use Sayedsoft\Dex\Accounting\Models\AccountingTemp;
use Sayedsoft\Dex\Token\Models\Token;
use Sayedsoft\ExchangeToken\Exchange\Helpers\CurrencyConvert;

class Accounting {
    

    public static function of($total_for,$token,$user) {
      return new AccountingMain($total_for,$token,$user);
    }

    public static function getAccountings() {
      return config('dex.accoutings');
    }
    
    public static function all($user) {
      $types = config('dex.accounting_types');
      $tokens = Token::all();
      $totals = [];

      foreach ($tokens as $token) {
            $_totals = [];
            foreach ($types as $type => $value) {
              $total = self::of($type,$token->id,$user)->get();
              $_totals[$type] = [
                'value' => $total,
                'converted' => CurrencyConvert::convertTo($total,$token->id)
              ];
              
            }
             $totals[$token->id] = $_totals;
      }
      return $totals;
    }
    
    private static function setTemp($user) {
      
      $data = []; 

      $data['balances']                = User::find($user)->balances();

      $data['accounting_totals']       = Accounting::all($user);

      return $data   ;
      
    }
    
    public static function temp($user) {

      $temp = AccountingTemp::where('user_id',$user)->first();
      if (isset($temp->id)) { return json_decode($temp->accounting) ; } 

      $temp = self::setTemp($user);

      $temp = AccountingTemp::create([
        'user_id' => $user,
        'accounting' => json_encode($temp)
      ]);
      return json_decode($temp->accounting); 
    }

    public static function temp_refresh($user) {
      $temp = self::setTemp($user);
      
      $temp_saved = AccountingTemp::where('user_id',$user)->first();
      if (isset($temp_saved->id)) { 
        $temp_saved->accounting = json_encode($temp);
        $temp_saved->save();
        return $temp_saved->accounting;
      }  

      $temp = AccountingTemp::create([
        'user_id' => $user,
        'accounting' => json_encode($temp)
      ]);
      return $temp->accounting;
    }
}