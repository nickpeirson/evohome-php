<?php

namespace Nickpeirson\Evohome\Request;

class LocationStatus extends LocationAbstract
{
    protected $path = 'status?includeTemperatureControlSystems=True';
}
