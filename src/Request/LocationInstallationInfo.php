<?php
namespace Nickpeirson\Evohome\Request;

class LocationInstallationInfo extends LocationAbstract
{
    protected $path = 'installationInfo?includeTemperatureControlSystems=True';
}