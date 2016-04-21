<?php
namespace Nickpeirson\Evohome;

use Nickpeirson\Evohome\Request\GetToken;
use Nickpeirson\Evohome\Request\UserAccount;
use Nickpeirson\Evohome\Token;
use Nickpeirson\Evohome\Request\TokenAbstract;
use Nickpeirson\Evohome\Request\InstallationInfo;
use Nickpeirson\Evohome\Request\LocationStatus;
use Nickpeirson\Evohome\Request\Gateway;
use Nickpeirson\Evohome\Request\LocationInstallationInfo;
use Nickpeirson\Evohome\Request\RefreshToken;
use Nickpeirson\Evohome\Request\Zone\Schedule;
use Nickpeirson\Evohome\Request\ZoneAbstract;
use Nickpeirson\Evohome\Request\Zone\HeatSetpoint;

class Service
{
    const APP_ID = 'b013aa26-9724-4dbd-8897-048b9aada249';

    /**
     *
     * @var Client
     */
    protected $client;

    /**
     *
     * @var Token
     */
    protected $token;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public static function init($username, $password)
    {
        $service = new static(
            Client::init()
        );
        $service->login($username, $password);
        return $service;
    }

    public function login($username, $password)
    {
        $request = (new GetToken())
            ->setUsername($username)
            ->setPassword($password);
        $response = $this->client->sendRequest($request);
        if (isset($response->error) && $response->error == 'invalid_grant') {
            throw new \Exception('Invalid username or password');
        }
        $this->token = $this->mapResponseToToken($response);
        return $this->token;
    }

    public function fetchUserAccount()
    {
        $response = $this->sendRequest(new UserAccount());
        return $response;
    }

    /**
     * API call taken from the linked file, but returns 404 when I tested
     *
     * @link https://github.com/watchforstock/evohome-client/blob/master/evohomeclient2/__init__.py#L79
     * @throws \Exception
     */
    public function fetchGateway()
    {
        throw new \Exception('See method comment');
        $response = $this->sendRequest(new Gateway());
        return $response;
    }

    public function fetchInstallationInfo($userId)
    {
        $response = $this->sendRequest(new InstallationInfo($userId));
        return $response;
    }

    public function fetchLocationStatus($location)
    {
        $response = $this->sendRequest(new LocationStatus($location));
        return $response;
    }

    public function fetchLocationInfo($location)
    {
        $response = $this->sendRequest(new LocationInstallationInfo($location));
        return $response;
    }

    public function fetchZoneSchedule($zone)
    {
        $response = $this->sendRequest(new Schedule($zone));
        return $response;
    }

    public function setZoneTemperaturePermanently($zoneId, $temperature)
    {
        return $this->setZoneTemperature($zoneId, $temperature, ZoneAbstract::MODE_PERMANENT);
    }

    public function setZoneTemperatureTemporarily($zoneId, $temperature, \DateTime $timeUntil)
    {
        return $this->setZoneTemperature($zoneId, $temperature, ZoneAbstract::MODE_TEMPORARY, $timeUntil);
    }

    public function setZoneTemperatureScheduled($zoneId)
    {
        return $this->setZoneTemperature($zoneId, 0);
    }

    protected function setZoneTemperature(
        $zoneId,
        $temperature = 0,
        $mode = ZoneAbstract::MODE_SCHEDULE,
        \DateTime $timeUntil = null
    ) {
        $response = $this->sendRequest(new HeatSetpoint($zoneId, $temperature, $mode, $timeUntil));
        return $response;
    }

    public function sendRequest(TokenAbstract $request)
    {
        if (!$this->token instanceof Token) {
            throw new \Exception('Please log in before making requests');
        }
        if ($this->token->isExpired()) {
            $this->refreshToken();
        }
        $request->setToken($this->token);
        return $this->client->sendRequest($request);
    }

    public function refreshToken()
    {
        $request = (new RefreshToken())
            ->setToken($this->token);
        $response = $this->client->sendRequest($request);
        if (isset($response->error)) {
            throw new \Exception('Unable to refresh token');
        }
        $this->token = $this->mapResponseToToken($response);
    }

    protected function mapResponseToToken($response)
    {
        return (new Token())
            ->setAccessToken($response->access_token)
            ->setExpiry($response->expires_in)
            ->setRefreshToken($response->refresh_token)
            ->setType($response->token_type);
    }
}