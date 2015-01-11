<?php
namespace Nickpeirson\Evohome\Request;

abstract class ZoneAbstract extends TokenAbstract
{
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