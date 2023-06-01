<?php

namespace Sayedsoft\ReferralUnilevel\Core\UserReferral;

use Sayedsoft\DexReferralBinary\Core\Setters\PositionTypesSetter;
use Sayedsoft\ReferralUnilevel\Core\Errors\ReturnErrorTrait;
use Sayedsoft\ReferralUnilevel\Core\UserReferral\Helpers\UnilevelParentsTreeModifer;
use Sayedsoft\ReferralUnilevel\Core\UserReferral\UnilevelUserReferral;
use Sayedsoft\ReferralUnilevel\Models\TempsModels\UnilevelSponsorsTemp;
use Sayedsoft\ReferralUnilevel\Traits\Referral\TemperSetter;
use Sayedsoft\ReferralUnilevel\Traits\Referral\UserSetter;
use Sayedsoft\ReferralUnilevel\Unilevel;

class UnilevelParentsTree
{
    use ReturnErrorTrait;


    use UserSetter;

    use TemperSetter;

    private $userReferral;

    private $childRow;


    private $list;

    public function __construct(UnilevelUserReferral $userReferral)
    {
        $this->setUser($userReferral->getUser());

        $this->userReferral = $userReferral;

        $this->childRow = $this->userReferral->details->asRow();

        $this->initTemper(
            $userReferral->getUser(),
            'parent',
            UnilevelSponsorsTemp::class,
        );

        $this->list = collect([]);
    }

    private function build()
    {
        $row = $this->childRow;

        $row->level = 0;

        $build = $this->_buildParents($row);

        $this->tree = $build;

        return $build;
    }

    private function _buildParents($row, $level = 0)
    {
        if ($row == null) {
            return null;
        }

        if ($row->parent == $row->user) {
            return null;
        }

        $row->level = $level;
        $row->parent_row = null;



        if (isset($row->parent) && $row->parent != null) {
            $_add = $row;


            unset($_add->childs);

            try {
                $get_prent = Unilevel::DetailsOf($row->parent)->asRow();
                $_add->parent_row = $this->_buildParents($get_prent, $level + 1)  ;

                return $_add;
            } catch (\Exception $e) {
                return $_add  ;
            }


            return $_add;
        }

        return $row ;
    }

    public function rebuildJob()
    {
        //  RebuildParentsTreeTempJob::dispatch($this->getUserId())->onQueue('RebuildTempJob');
    }

    public function rebuild()
    {
        $this->getTemper()->updateTemp($this->build());
    }

    private function _getter()
    {
        if ($this->temper->hasTemp()) {
            $this->tree = $this->getTemper()->getTemp();
        } else {
            $this->tree = $this->build();

            $this->getTemper()->updateTemp($this->tree);
        }

        return $this->tree;
    }

    public function get()
    {
        return $this->_getter();
    }

    public function set()
    {
        $tree = $this->_getter();

        return new UnilevelParentsTreeModifer($tree);
    }
}
