<?php

namespace Nickpeirson\Evohome\Entity;

class Zone
{
    const HOURS = '(?:[0-1][0-9]|2[0-3])';
    const MINS = '[0-5][0-9]';
    const SECS = '[0-5][0-9]';

    protected $temperature;
    protected $timeOfDay;

    public function __construct($timeOfDay, $temperature)
    {
        $this->temperature = (float) $temperature;
        if (!preg_match('/'.static::HOURS.':'.static::MINS.':'.static::SECS.'/', $timeOfDay)) {
            throw new \Exception('Expected time in the format 00:00:00, "'.$timeOfDay.'" given');
        }
        $this->timeOfDay = $timeOfDay;
    }

    public function __get($property)
    {
        return $this->{$property};
    }

    public function getTemperature()
    {
        return $this->temperature;
    }

    public function getTimeOfDay()
    {
        return $this->timeOfDay;
    }
}
