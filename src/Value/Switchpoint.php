<?php
namespace Nickpeirson\Evohome\Value;

class Switchpoint
{
    const HOURS = '(?:[0-1][0-9]|2[0-3])';
    const MINS = '[0-5][0-9]';
    const SECS = '[0-5][0-9]';

    protected $temperature;
    protected $timeOfDay;
    protected $timeInSeconds;

    public function __construct($timeOfDay, $temperature)
    {
        $this->setTemperature($temperature)
            ->setTimeOfDay($timeOfDay);
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

    protected function setTemperature($temperature)
    {
        $this->temperature = (float) $temperature;
        return $this;
    }

    protected function setTimeOfDay($timeOfDay)
    {
        $pattern = '/(?<hours>'.static::HOURS.'):(?<mins>'.static::MINS.'):(?<secs>'.static::SECS.')/';
        if (!preg_match($pattern, $timeOfDay, $timeParts)) {
            throw new \Exception('Expected time in the format 00:00:00, "'.$timeOfDay.'" given');
        }
        $this->timeOfDay = $timeOfDay;
        $this->timeInSeconds = (($timeParts['hours'] * 60) + $timeParts['mins']) * 60;
        return $this;
    }

    public function getTimeInSeconds()
    {
        return $this->timeInSeconds;
    }
}