<?php
namespace Nickpeirson\Evohome\Entity;

use Nickpeirson\Evohome\Value\Switchpoint;
class Schedule
{
    protected $days = [
        'Monday' => 'Monday',
        'Tuesday' => 'Tuesday',
        'Wednesday' => 'Wednesday',
        'Thursday' => 'Thursday',
        'Friday' => 'Friday',
        'Saturday' => 'Saturday',
        'Sunday' => 'Sunday'
    ];
    protected $dayOfWeek;
    protected $switchpoints = [];

    public function __construct($dayOfWeek, $switchpoints = [])
    {
        $dayOfWeek = ucfirst(strtolower($dayOfWeek));
        if (!isset($this->days[$dayOfWeek])) {
            throw new \Exception(
                '"'.$dayOfWeek.'" is not a valid day. Please use one of: '.implode(', ', $this->days)
            );
        }
        $this->dayOfWeek = $dayOfWeek;
        $this->setSwitchpoints($switchpoints);
    }

    public function __get($property)
    {
        return $this->{$property};
    }

    public function getDayOfWeek()
    {
        return $this->dayOfWeek;
    }

    public function getSwitchpoints()
    {
        return $this->switchpoints;
    }

    protected function setDayOfWeek($dayOfWeek)
    {
        $this->dayOfWeek = $dayOfWeek;
        return $this;
    }

    public function setSwitchpoints($switchpoints)
    {
        $this->switchpoints = new \SplPriorityQueue();
        foreach($switchpoints as $switchpoint) {
            $this->addSwitchpoint($switchpoint);
        }
        return $this;
    }

    public function addSwitchpoint(Switchpoint $switchpoint)
    {
        $this->switchpoints->insert($switchpoint, -$switchpoint->getTimeInSeconds());
        return $this;
    }
}