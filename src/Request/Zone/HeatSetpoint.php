<?php

namespace Nickpeirson\Evohome\Request\Zone;

use Nickpeirson\Evohome\Request\ZoneAbstract;

class HeatSetpoint extends ZoneAbstract
{
    protected $path = 'heatSetpoint';
    protected $temperature;
    protected $mode;
    protected $timeUntil;

    public function __construct($zone, $temperature, $mode, \DateTime $timeUntil = null)
    {
        parent::__construct($zone);
        $this->temperature = $temperature;
        $this->mode = $mode;
        $this->timeUntil = $timeUntil;
    }

    public function getOptions()
    {
        $options = parent::getOptions();
        $options['json'] = [
            'HeatSetpointValue' => $this->temperature,
            'SetpointMode' => $this->mode,
        ];
        if (!empty($this->timeUntil)) {
            $options['json']['TimeUntil'] = $this->timeUntil->format(\DateTime::ATOM);
        }

        return $options;
    }

    public function getMethod()
    {
        return 'put';
    }
}
