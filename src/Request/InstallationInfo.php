<?php
namespace Nickpeirson\Evohome\Request;

class InstallationInfo extends TokenAbstract
{
    protected $userId;

    public function __construct($userId)
    {
        $this->userId = $userId;
    }

    public function getPath()
    {
        $path = sprintf('location/installationInfo?userId=%s&includeTemperatureControlSystems=True', $this->userId);
        return parent::getPath().$path;
    }
}