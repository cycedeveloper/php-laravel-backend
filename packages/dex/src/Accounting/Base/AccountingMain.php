<?php
namespace Sayedsoft\Dex\Accounting\Base;

use Sayedsoft\Dex\Accounting\Models\AccountingTotal;

class AccountingMain {

    use AccountingStore;

    private $_total_for;

    private $_user;

    private $_token;

    public  function __construct($_total_for,$_token,$_user)
    {
        $this->_total_for = $_total_for;
        $this->_token = $_token;
        $this->_user = $_user;
    }   




}