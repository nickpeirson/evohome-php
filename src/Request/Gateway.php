<?php
namespace Nickpeirson\Evohome\Request;

class Gateway extends TokenAbstract
{
    public function getPath()
    {
        return parent::getPath().'gateway';
    }
}