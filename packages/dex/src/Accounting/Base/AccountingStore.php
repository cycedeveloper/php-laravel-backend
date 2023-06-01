<?php
namespace Sayedsoft\Dex\Accounting\Base;

use Exception;
use Sayedsoft\Dex\Accounting\Models\AccountingTotal;

trait AccountingStore {

    private $query;

    private $types;
    
    public function hasRecord () {
       return  $this->query->exists();
    }

    public function get ($get_row = false) {
        $this->_setQuery();
        if (!$this->hasRecord()) { $this->_create(); }
        
        // reset query
        $this->_setQuery();
        $row = $this->query->first();
        return (!$get_row) ? $row->amount :  $row;
    }


    public function set ($total) {
        $this->get(true)->setTotal($total);
        return $this;
    }

    private function _typeOf ($total_for) {
        $types = config('dex.accounting_types');
        return (isset($types[$total_for])) ? $types[$total_for] : false;
    }


    private function _create () {
        $type = $this->_typeOf($this->_total_for);
        if (!$type) {
            throw(new Exception('No type for '.$this->_total_for));
        }
        $defult  = [
            'user_id' => $this->_user,
            'token_id' => $this->_token,
            'total_for' => $this->_total_for,
            'type' => $type,
            'amount' => 0
        ];
        AccountingTotal::create($defult);
    }

    private function _setQuery() {
        $this->query =  AccountingTotal::where('total_for',$this->_total_for);

        if ($this->_user != null) {
            $this->query->where('user_id',$this->_user);
        }

        if ($this->_token != null) {
            $this->query->where('token_id',$this->_token);
        }
    }

}