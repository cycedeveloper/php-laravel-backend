<?php
namespace Sayedsoft\Dex\Accounting;


trait BaseAccounting  {
    
    private $_user;

    private $_token;

     private $_related_id;

    public  function __construct($_token,$_user)
    {
        $this->_token = $_token;
        $this->_user = $_user;
    }   

    public function refreshTotals() {
         
    }
     
    public function createdEvent () {
       
    }

    public function updatedEvent () {
        
    }

    public function deletedEvent () {
        
    }
    
}   