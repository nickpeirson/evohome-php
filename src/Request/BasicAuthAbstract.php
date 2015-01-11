<?php
namespace Nickpeirson\Evohome\Request;

use Nickpeirson\Evohome\RequestInterface;
use Nickpeirson\Evohome\Service;

abstract class BasicAuthAbstract implements RequestInterface
{
    const APP_PASS = 'test';

    protected $username;
    protected $password;

    public function getOptions()
    {
        return [
            'headers' => $this->getHeaders(),
            'body' => $this->getBody()
        ];
    }

    public function getHeaders()
    {
        $authToken = base64_encode(Service::APP_ID.':'.static::APP_PASS);
        return [
            'Authorization' => 'Basic '.$authToken
        ];
    }

    protected function getBody()
    {
        return [
            'grant_type' => 'password',
            'scope' => 'EMEA-V1-Basic EMEA-V1-Anonymous EMEA-V1-Get-Current-User-Account',
            'Username' => $this->username,
            'Password' => $this->password
        ];
    }

    public function getMethod()
    {
        return 'post';
    }

    abstract public function getPath();

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