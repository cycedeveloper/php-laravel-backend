<?php

namespace Sayedsoft\ReferralUnilevel\Core\UserReferral;

use Sayedsoft\ReferralUnilevel\Core\Errors\ReturnErrorTrait;
use Sayedsoft\ReferralUnilevel\Core\UserReferral\Helpers\UnilevelTreeModifer;
use Sayedsoft\ReferralUnilevel\Core\UserReferral\UnilevelUserReferral;
use Sayedsoft\ReferralUnilevel\Models\TempsModels\UnilevelChildsTemp;
use Sayedsoft\ReferralUnilevel\Traits\Referral\TemperSetter;
use Sayedsoft\ReferralUnilevel\Traits\Referral\UserSetter;
use Sayedsoft\ReferralUnilevel\Unilevel;

class UnilevelChildsTree
{
    use ReturnErrorTrait;


    use UserSetter;

    use TemperSetter;

    private $userReferral;

    private $parentRow;

    private $tree;

    private $list;

    public function __construct(UnilevelUserReferral $userReferral)
    {
        $this->setUser($userReferral->getUser());

        $this->userReferral = $userReferral;

        $this->parentRow = $this->userReferral->details->asRow();

        $this->initTemper(
            $userReferral->getUser(),
            'childs',
            UnilevelChildsTemp::class,
        );

        $this->list = collect([]);
    }

    private function build()
    {
        $row = $this->parentRow;

        $row->level = 0;

        $build = $this->_buildChilds($row);

        $this->tree = $build;

        return $build;
    }

    private function _buildChilds($row, $level = 0)
    {
        if ($row == null) {
            return $row;
        }

        $level++;

        if (isset($row->childs)) {
            foreach ($row->childs as $id) {
                try {
                    $_row = Unilevel::DetailsOf($id)->asRow();
                } catch (\Exception $e) {
                    continue;
                }

                $_row->level = $level;

                $row->childs->$id = $this->_buildChilds($_row, $level);
            }
        }

        return $row;
    }

    public function rebuildJob()
    {
        // RebuildChildsTreeTempJob::dispatch($this->getUserId())->onQueue('RebuildTempJob');
    }

    public function rebuild()
    {
        $this->getTemper()->updateTemp($this->build());
        return $this;
    }

    public function setTemperKey($key)
    {
        $this->getTemper()->setKey($key);
        return $this;
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

        return new UnilevelTreeModifer($tree);
    }
}
