<?php

namespace Sayedsoft\ReferralUnilevel\Core\UserReferral\Helpers;

use App\Models\User;
use Sayedsoft\ReferralUnilevel\Core\Errors\ReturnErrorTrait;



Class UnilevelParentsTreeModifer {
    
    use ReturnErrorTrait;
    
    private $tree;

    private $list ;

    private $hasModify = false;

    private $addUserData = false;

    private $convertToList = false;
    
    private $extraData;

    private $childUser;

    public function __construct($tree) {
        $this->tree = $tree;

        $this->childUser = $tree->user;

        $this->list =  collect([]);

    }

    public function withUserData () {
         $this->hasModify = true;
         $this->addUserData = true;
         return $this;
    }

    public function asOneList () {

         $this->hasModify = true;

         $this->convertToList = true;

         return $this;
    }


    private function modifer ($tree,$direct_type = null) {
        if ($tree == null || !isset($tree->parent_row)) { return null; }
        // modify one user 
          $parent = $this->makeModify($tree->parent_row);
            if ($parent == null) { return $tree; }
            if ($this->convertToList) {
                
                $this->modifer($parent,$direct_type);
                
                $_add = $parent;
                
                unset($_add->childs);

                $this->list->add( $_add );
                
            } else {
               $tree->parent_row  = $this->modifer($parent);
            }
       return $tree;
    }

    private function makeModify ($user) {
       if ($user == null) { return null; }
        
       if ($this->addUserData) {
            $_user =  User::find($user->user);
            $user->user_data = $_user;
       }
       return $user;
    }

    public function get () {
        if ($this->hasModify) {
          
           $modifeid = $this->modifer($this->tree);

           if ($this->convertToList) {
              return (Object) $this->list->all();
           } else {
              return $modifeid;
           }
        }
        return $this->tree;
    }

}