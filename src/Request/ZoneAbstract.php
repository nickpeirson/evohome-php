<?php

namespace Nickpeirson\Evohome\Request;

abstract class ZoneAbstract extends TokenAbstract
{
    const MODE_SCHEDULE = 0;
    const MODE_PERMANENT = 1;
    const MODE_TEMPORARY = 2;

    protected $zone;
    protected $path = '';

    public function __construct($zone)
    {
        $this->zone = $zone;
    }

    public function getPath()
    {
        $path = sprintf('temperatureZone/%s/', $this->zone).$this->path;

        return parent::getPath().$path;
    }
}
