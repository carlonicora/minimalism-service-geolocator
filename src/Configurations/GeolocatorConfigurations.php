<?php
namespace CarloNicora\Minimalism\Services\Geolocator\Configurations;

use CarloNicora\Minimalism\core\Services\abstracts\abstractServiceConfigurations;

class GeolocatorConfigurations extends AbstractServiceConfigurations
{
    /** @var string  */
    public string $geolocationFile;

    public function __construct()
    {
        $this->geolocationFile = __DIR__ . '/../../data/IP2LOCATION-LITE-DB3.BIN';
    }
}