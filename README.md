# evohome-php
PHP library to connect to the Honeywell EvoHome API

This is a work in progress. Fetching information is reasonably complete and should be easy enough to extend as needed. I started work on pushing settings back, but this isn't at all complete and may need completely reworking to make work.

# Example

```php
use Nickpeirson\Evohome\Service;
use Nickpeirson\Evohome\Entity\Schedule;
use Nickpeirson\Evohome\Value\Switchpoint;
require dirname(__DIR__).'/vendor/autoload.php';

$evohome = Service::init('username', 'password');
$response = $evohome->fetchUserAccount();
$response = $evohome->fetchInstallationInfo($response->userId);
$response = $evohome->fetchZoneSchedule($response[0]->gateways[0]->temperatureControlSystems[0]->zones[0]->zoneId);
print_r($response);
```

# Credits

I heavily relied on the information in [this thread](http://www.automatedhome.co.uk/vbulletin/showthread.php?3863-Decoded-EvoHome-API-access-to-control-remotely) which saved me a load of time on sniffing and trial and error.
