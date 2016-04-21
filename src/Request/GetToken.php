<?php

namespace Nickpeirson\Evohome\Request;

class GetToken extends AuthAbstract
{
    protected $username;
    protected $password;

    protected function getFormParams()
    {
        $formParams = parent::getFormParams();
        $formParams['grant_type'] = 'password';
        $formParams['Username'] = $this->username;
        $formParams['Password'] = $this->password;

        return $formParams;
    }

    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }
}
