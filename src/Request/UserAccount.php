<?php

namespace Nickpeirson\Evohome\Request;

class UserAccount extends TokenAbstract
{
    public function getPath()
    {
        return parent::getPath().'userAccount';
    }
}
