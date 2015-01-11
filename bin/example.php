#!/usr/bin/env php
<?php
use Nickpeirson\Evohome\Service;
use Nickpeirson\Evohome\Entity\Schedule;
use Nickpeirson\Evohome\Value\Switchpoint;
require dirname(__DIR__).'/vendor/autoload.php';

$evohome = Service::init('username', 'password');
$response = $evohome->fetchUserAccount();
$response = $evohome->fetchInstallationInfo($response->userId);
$response = $evohome->fetchZoneSchedule($response[0]->gateways[0]->temperatureControlSystems[0]->zones[0]->zoneId);
print_r($response);
