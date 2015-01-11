<?php
namespace Nickpeirson\Evohome\Request;

abstract class LocationAbstract extends TokenAbstract
{
    protected $location;
    protected $path = '';

    public function __construct($location)
    {
        $this->location = $location;
    }

    public function getPath()
    {
        $path = sprintf('location/%s/', $this->location).$this->path;
        return parent::getPath().$path;
    }
}