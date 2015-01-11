<?php
namespace Nickpeirson\Evohome\Request;

class GetToken extends BasicAuthAbstract
{
    public function getPath()
    {
        return 'Auth/OAuth/Token';
    }
}