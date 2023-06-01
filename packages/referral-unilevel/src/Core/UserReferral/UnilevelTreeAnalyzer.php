<?php

namespace Sayedsoft\ReferralUnilevel\Core\UserReferral;

use Sayedsoft\ReferralUnilevel\Core\Errors\ReturnErrorTrait;
use Sayedsoft\ReferralUnilevel\Models\Referral\UnilevelDetail;
use Sayedsoft\ReferralUnilevel\Models\TempsModels\UnilevelDetailsTempModel;
use Sayedsoft\ReferralUnilevel\Traits\Referral\TemperSetter;
use Sayedsoft\ReferralUnilevel\Traits\Referral\UserSetter;
use Sayedsoft\ReferralUnilevel\Unilevel;
use stdClass;

class UnilevelTreeAnalyzer
{
    use ReturnErrorTrait;

    use UserSetter;

    use TemperSetter;

    private $childRow;

    private $list;

    public $counters;

    public $fields;

    private $totals = 0;

    private $childsTree;

    public $modifedTree;

    private $analyzers;

    private $analyzerInited = false;

    public function __construct($user)
    {
        $this->setUser($user);

        $this->initTemper(
            $this->getUser(),
            'analyzers',
            UnilevelDetailsTempModel::class,
        );

        // Set counters
        $this->counters = collect([]);

        $this->analyzers = collect([]);

        $this->modifedTree = collect([]);

        $this->fields = collect([]);
    }


    private function initAnalyzers()
    {
        if ($this->analyzerInited) {
            return;
        }
        $this->childsTree = Unilevel::ReferralOf($this->getUser())->childsTree->set()->asOneList()->withUserData()->get();
        $this->analyzerInited = true;
    }

    public function subCounter($counter, $level, $add)
    {
        $selector = $this->counters->lazy()->where('name', $counter);
        $_counter = $selector->first();
        if (isset($_counter)) {
            $levelName = 'l_'.$level;
            if (!isset($_counter->values->$levelName)) {
                $_counter->values->$levelName = $add;
            } else {
                $_counter->values->$levelName += $add;
            }
        }
        $selector->replace($_counter);
    }

    public function defineCounter($name)
    {
        $values = new stdClass();

        $this->counters->add((object)[
            'name' => $name,
            'values' => $values
        ]);
        return $this;
    }

     public function defineFields($name)
     {
         $values = new stdClass();

         $this->fields->add((object)[
             'name' => $name,
             'values' => $values
         ]);
         return $this;
     }

    public function addFields($name, $level, $fields)
    {
        $selector = $this->fields->lazy()->where('name', $name);
        $_fields = $selector->first();
        if (isset($_fields)) {
            $levelName = 'l_'.$level;
            if (!isset($_fields->values->$levelName)) {
                $newCollect = [];
                $newCollect[] = $fields;
                $_fields->values->$levelName = $newCollect;
            } else {
                $collect = $_fields->values->$levelName;
                $collect[] = $fields;
                $_fields->values->$levelName = $collect;
            }
        }
        $selector->replace((object) $_fields);
    }





    public function defineAnalyzer($name, $callback, $append = false)
    {
        $this->analyzers->add((object) [
            'name' => $name,
            'append' => $append,
            'clouser' => $callback
        ]);

        return $this;
    }


    protected function boot()
    {
    }

    public function analyze()
    {
        $this->initAnalyzers();

        $this->boot();
        $analyzers = $this->analyzers->all();

        foreach ($this->childsTree as $child) {
            $appends = new stdClass();

            foreach ($analyzers as $analyzer) {
                $fun =  $analyzer->clouser;

                $run  = $fun($child);
                if ($analyzer->append) {
                    $name = $analyzer->name;
                    $appends->$name = $run;
                }
            }

            $child->appends = $appends;

            $this->modifedTree->add($child);
        }

        return $this->modifedTree->all();
    }

    public function result()
    {
        $temp = $this->getTemper()->getTemp();


        if ($temp !== null && !empty($temp)) {
            return $temp;
        }

        $this->rebuild();


        return (object) $this->_results();
    }

    private function _results()
    {
        return  (object) array_merge((array) $this->counters->all(), (array) $this->fields->all());
        ;
    }

    public function saveToDetails()
    {
        $counters =  $this->_results();
        foreach ($counters as $key => $counter) {
            foreach ($counter->values as $level => $value) {
                $_value = $value;
                if (getType($value) == 'object' || 'array') {
                    $_value = json_encode($value);
                }
                UnilevelDetail::updateOrCreate([
                    'level' => $level,
                    'user_id' => $this->getUserId(),
                    'detail_key' => $counter->name,
                ], [
                    'detail_value' => $_value,
                    'detail_type' =>  $counter->name,
                ]);
            }
        }
    }

    public function rebuild()
    {
        $this->initAnalyzers();
        $this->analyze();
        $this->getTemper()->updateTemp((object) $this->_results());
        $this->saveToDetails();
        return $this;
    }


    /**
     * Get the value of tree
     */
    public function getTree()
    {
        return $this->tree;
    }

    /**
     * Set the value of tree
     *
     * @return  self
     */
    public function setTree($tree)
    {
        $this->tree = $tree;

        return $this;
    }
}
