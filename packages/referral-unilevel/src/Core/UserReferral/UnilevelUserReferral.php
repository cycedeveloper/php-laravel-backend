<?php

namespace Sayedsoft\ReferralUnilevel\Core\UserReferral;

use Sayedsoft\ReferralUnilevel\Core\Errors\ReturnErrorTrait;
use Sayedsoft\ReferralUnilevel\Core\UserReferral\UnilevelChildsTree;
use Sayedsoft\ReferralUnilevel\Core\UserReferral\UnilevelParentsTree;
use Sayedsoft\ReferralUnilevel\Core\UserReferral\UnilevelReferralDetails;
use Sayedsoft\ReferralUnilevel\Traits\Referral\UserSetter;

class UnilevelUserReferral
{
    use UserSetter;

    use ReturnErrorTrait;


    public $details;

    public $childsTree;

    public $parentsTree;

    public $childsOncelevel;

    public $childsTreeOnce;

    public function __construct($user)
    {
        $this->setUser($user);
        $this->init();
    }

    private function init()
    {
        $row = new UnilevelReferralDetails($this->getUser());
        $this->details = $row->get();

        $childsTree = new UnilevelChildsTree($this);
        $this->childsTree = $childsTree;

        $parentsTree = new UnilevelParentsTree($this);
        $this->parentsTree = $parentsTree;
    }



    public function analyzers()
    {
        $analyzer = new UnilevelDefaultAanalyzer($this->getUser());
        $analyzer->analyze();

        return $analyzer;
    }


    public function get()
    {
        return $this;
    }
}
