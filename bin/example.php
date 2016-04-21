#!/usr/bin/env php
<?php
use Nickpeirson\Evohome\Service;
use Nickpeirson\Evohome\Entity\Schedule;

require dirname(__DIR__).'/vendor/autoload.php';

$evohome = Service::init('username', 'password');
$account = $evohome->fetchUserAccount();
$installationInfo = $evohome->fetchInstallationInfo($account->userId);
$locationId = $installationInfo[0]->locationInfo->locationId;
$zoneId = $installationInfo[0]->gateways[0]->temperatureControlSystems[0]->zones[0]->zoneId;

//Get the schedules for all zones
$schedule = $evohome->fetchZoneSchedule($zoneId);

//Get the system status
$systemStatus = $evohome->fetchLocationStatus($locationId);

/*
 * Get the status for one zone:
 * {
 *   zoneId = (int)
 *   temperatureStatus => {
 *     temperature => (int)
 *     isAvailable => (boolean)
 *   }
 *   activeFaults => [
 *     {
 *       faultType => (string)
 *       since => (datetime)
 *     },
 *     ...
 *   ]
 *   heatSetpointStatus => {
 *     targetTemperature => (int)
 *     setpointMode => (string)
 *   }
 *   name => (string)
 * }
 */
$zoneStatus = $systemStatus->gateways[0]->temperatureControlSystems[0]->zones[0];

//Set the temperature for a zone permanently
$evohome->setZoneTemperaturePermanently($zoneId, 15);

//Set the temperature for a zone temporarily
$evohome->setZoneTemperatureTemporarily($zoneId, 15, new DateTime('2016-04-25 10:00'));

//Set a zone back to it's regular schedule
$evohome->setZoneTemperatureScheduled($zoneId);