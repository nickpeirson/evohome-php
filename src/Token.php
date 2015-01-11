<?php
namespace Nickpeirson\Evohome;

class Token
{
    protected $accessToken;
    protected $refreshToken;
    protected $expiry;
    protected $expiresAt;
    protected $type = 'bearer';

    public function isExpired()
    {
        return time() >= $this->expiresAt;
    }

    public function setAccessToken($token)
    {
        $this->accessToken = $token;
        return $this;
    }

    public function setExpiry($expiry)
    {
        $this->expiresAt = time() + $expiry;
        $this->expiry = $expiry;
        return $this;
    }

    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }

    public function setRefreshToken($refreshToken)
    {
        $this->refreshToken = $refreshToken;
        return $this;
    }

    public function getAccessToken()
    {
        return $this->accessToken;
    }

    public function getType()
    {
        return $this->type;
    }
	public function getRefreshToken() {
		return $this->refreshToken;
	}


}