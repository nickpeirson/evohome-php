<?php
namespace Nickpeirson\Evohome\Request;

use Nickpeirson\Evohome\RequestInterface;
use Nickpeirson\Evohome\Service;
use Nickpeirson\Evohome\Token;

abstract class TokenAbstract implements RequestInterface
{
    protected $token;
    protected $type = 'bearer';

    public function getHeaders()
    {
        return [
            'Authorization' => $this->token->getType().' '.$this->token->getAccessToken(),
            'applicationId' => Service::APP_ID
        ];
    }

    public function getOptions()
    {
        return [
            'headers' => $this->getHeaders()
        ];
    }

    public function getPath()
    {
        return 'WebAPI/emea/api/v1/';
    }

    public function getMethod()
    {
        return 'get';
    }

    public function setToken(Token $token)
    {
        $this->token = $token;
        return $this;
    }
}