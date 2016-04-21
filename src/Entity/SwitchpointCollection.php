<?php

namespace Nickpeirson\Evohome\Entity;

class SwitchpointCollection extends \SplMaxHeap
{
    protected $switchpoints = [];

    protected function compare($switchpoint1, $switchpoint2)
    {
        return $switchpoint1->getTimeInSeconds() - $switchpoint2->getTimeInSeconds();
    }
}
