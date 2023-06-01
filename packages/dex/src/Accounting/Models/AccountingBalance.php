<?php
namespace Sayedsoft\Dex\Accounting\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Sayedsoft\Dex\Accounting\Accounting;
use Sayedsoft\Dex\Base\Helpers\NF;
use Sayedsoft\Dex\Base\Traits\UserBelongTrait;
use Sayedsoft\Dex\Token\Models\Token;
use Sayedsoft\Dex\Token\Traits\TokenBelongsTrait;
use Sayedsoft\ExchangeToken\Exchange\Helpers\CurrencyConvert;

class AccountingBalance extends Model
{
    use UserBelongTrait,TokenBelongsTrait;

    protected $table = 'dex_accounting_balances';



    protected $fillable = [
        'id',
        'user_id',
        'token_id',
        'depts',
        'incomes',
        'outgoings',
        'invoices',
        'balance'
    ];

    protected $appends = [
        'converted_balance'
    ];

    protected $hidden = [ 
        'created_at',
        'updated_at'
    ];

    public function convertBalance() {
        if (!$this->balance) return;
        $num = CurrencyConvert::convertTo($this->balance,$this->token_id);
        return NF::set($num,4);
    }

    public function getTotalDepts () {
        $totalDepts = AccountingTotal::totalDepts($this->user_id,$this->token_id)->first();
        return (!empty($totalDepts)) ? $totalDepts->total : NF::set(0);
    }

    public function getTotalOutgoings () {
        $totalOutgoings = AccountingTotal::totalOutgoings($this->user_id,$this->token_id)->first();
        return (!empty($totalOutgoings)) ? $totalOutgoings->total : NF::set(0);
    }

    public function getTotalIncomes () {
        $totalIncomes = AccountingTotal::totalIncomes($this->user_id,$this->token_id)->first();
        return (!empty($totalIncomes)) ? $totalIncomes->total : NF::set(0);
    } 

    public function getConvertedBalanceAttribute() {
         if ($this->balance) {
            return $this->convertBalance();
         }
         return 0;
    }

    public function reCalculate() {
         $accountings = Accounting::getAccountings();
         foreach ($accountings as $accounting) {
           $a = new $accounting($this->token_id,$this->user_id);
               $a->refreshTotals();
            
         }
         return 0;
    }

    public function refresh () {
        DB::beginTransaction();    

        try {

            $depts     = $this->getTotalDepts();
            $incomes   = $this->getTotalIncomes();
            $outgoings = $this->getTotalOutgoings();
            
            $this->depts = $depts;
            $this->incomes = $incomes;
            $this->outgoings = $outgoings;
            $this->balance = ($incomes) + -($outgoings);

            $this->save();
             DB::commit();
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollBack();
        } 
       
    }


}
