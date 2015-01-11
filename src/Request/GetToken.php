<?php
namespace Nickpeirson\Evohome\Request;

class GetToken extends AuthAbstract
{
    protected $username;
    protected $password;

    protected function getBody()
    {
        $body = parent::getBody();
        $body['grant_type'] = 'password';
        $body['Username'] = $this->username;
        $body['Password'] = $this->password;
        return $body;
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