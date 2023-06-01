<?php

namespace Sayedsoft\ReferralUnilevel\Core\UserReferral\Helpers;

use App\Models\User;
use PhpParser\Node\Expr\Cast\Object_;
use Sayedsoft\ReferralUnilevel\Core\Errors\ReturnErrorTrait;

class UnilevelTreeModifer
{
    use ReturnErrorTrait;

    private $tree;

    private $list ;

    private $hasModify = false;

    private $addUserData = false;

    private $convertToList = false;

    private $extraData;

    private $parentUser;

    private $addCustomUserData = false;

    private $customUserDataFun = false;

    private $hasLimitLevels = false;

    private $levels = [];

    private $limitLevels = [];

    private $parents = [];

    public function __construct($tree)
    {
        $this->tree = $tree;

        $this->parentUser = $tree->user;

        $this->list =  collect([]);
    }

    public function withUserData()
    {
        $this->hasModify = true;
        $this->addUserData = true;
        return $this;
    }

    public function withCustomUserData($fun)
    {
        $this->hasModify = true;
        $this->addCustomUserData = true;
        $this->customUserDataFun = $fun;
        return $this;
    }

    public function asOneList()
    {
        $this->hasModify = true;

        $this->convertToList = true;

        return $this;
    }

    public function limitLevelsUsers($limits = [])
    {
        $this->hasModify = true;

        $this->limitLevels = $limits;

        $this->convertToList = true;

        $this->hasLimitLevels = true;

        return $this;
    }

    private function ParentHasAdded($child)
    {
        if ($child->level > 1 && $child->level < 4) {
            if (isset($this->parents[$child->parent])) {
                return true;
            }

            $this->parents[$child->parent] = $child->parent;
        }

        return false;
    }

     private function modifer($tree, $direct_type = null)
     {
         if ($tree == null || !isset($tree->childs)) {
             return null;
         }
         // modify one user
         foreach ($tree->childs as $type => $child) {
             if ($child == null || empty($child)) {
                 continue;
             }

             $child = $this->makeModify($child);

             if ($this->convertToList) {
                 if ($this->parentUser == $child->parent) {
                     $child->direct_child = true;
                 } else {
                     $child->direct_child =  false;
                 }

                 $this->modifer($child, $direct_type);


                 $_add = $child;

                 unset($_add->childs);


                 if ($this->hasLimitLevels && $this->ParentHasAdded($child)) {
                     continue;
                 } else {
                     $this->list->add($_add);
                 }
             } else {
                 $child->childs->$type = $this->modifer($child);
             }
         }
         return $tree;
     }


    private function makeModify($user)
    {
        if ($user == null) {
            return null;
        }

        if ($this->addUserData) {
            $_user =  User::find($user->user);
            $user->user_data = $_user;
        }

        if ($this->addCustomUserData) {
            $function = $this->customUserDataFun;
            $user->user_data_extra = $function($user);
        }

        return $user;
    }

    public function get()
    {
        if ($this->hasModify) {
            $modifeid = $this->modifer($this->tree);

            if ($this->convertToList) {
                return (object) $this->list->all();
            } else {
                return $modifeid;
            }
        }
        return $this->tree;
    }
}
