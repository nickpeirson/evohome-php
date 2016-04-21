<?php

namespace Nickpeirson\Evohome\Request;

use Nickpeirson\Evohome\RequestInterface;
use Nickpeirson\Evohome\Service;

abstract class AuthAbstract implements RequestInterface
{
    const APP_PASS = 'test';

    public function getOptions()
    {
        return [
            'headers' => $this->getHeaders(),
            'form_params' => $this->getFormParams(),
        ];
    }

    public function getHeaders()
    {
        $authToken = base64_encode(Service::APP_ID.':'.static::APP_PASS);

        return [
            'Authorization' => 'Basic '.$authToken,
        ];
    }

    protected function getFormParams()
    {
        return [
            'scope' => 'EMEA-V1-Basic EMEA-V1-Anonymous EMEA-V1-Get-Current-User-Account',
        ];
    }

    public function getMethod()
    {
        return 'post';
    }

    public function getPath()
    {
        return 'Auth/OAuth/Token';
    }
}
