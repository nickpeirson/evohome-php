<?php
namespace Nickpeirson\Evohome\Request;
use Nickpeirson\Evohome\Token;

class RefreshToken extends AuthAbstract
{
	/**
	 *
	 * @var Token
	 */
	protected $token;

    protected function getBody()
    {
        $body = parent::getBody();
        $body['grant_type'] = 'refresh_token';
        $body['refresh_token'] = $this->token->getRefreshToken();
        return $body;
    }

    public function setToken(Token $token)
    {
        $this->token = $token;
        return $this;
    }
}