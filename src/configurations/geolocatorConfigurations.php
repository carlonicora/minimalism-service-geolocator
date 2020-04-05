<?php
namespace phlow\library\services\geolocator\configurations;


use carlonicora\minimalism\core\services\abstracts\abstractServiceConfigurations;

class geolocatorConfigurations extends abstractServiceConfigurations {
    /** @var string  */
    public string $geolocationFile;

    public function __construct() {
        $this->geolocationFile = __DIR__ . '/../data/IP2LOCATION-LITE-DB3.BIN';
    }
}