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

    protected function getFormParams()
    {
        $formParams = parent::getFormParams();
        $formParams['grant_type'] = 'refresh_token';
        $formParams['refresh_token'] = $this->token->getRefreshToken();
        return $formParams;
    }

    public function setToken(Token $token)
    {
        $this->token = $token;
        return $this;
    }
}