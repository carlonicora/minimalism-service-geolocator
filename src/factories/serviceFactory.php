<?php
namespace phlow\library\services\geolocator\factories;

use carlonicora\minimalism\core\services\abstracts\abstractServiceFactory;
use carlonicora\minimalism\core\services\exceptions\configurationException;
use carlonicora\minimalism\core\services\factories\servicesFactory;
use phlow\library\services\geolocator\configurations\geolocatorConfigurations;
use phlow\library\services\geolocator\geolocator;

class serviceFactory extends abstractServiceFactory {
    /**
     * serviceFactory constructor.
     * @param servicesFactory $services
     * @throws configurationException
     */
    public function __construct(servicesFactory $services) {
        $this->configData = new geolocatorConfigurations();

        parent::__construct($services);
    }

    /**
     * @param servicesFactory $services
     * @return mixed|geolocator
     */
    public function create(servicesFactory $services) {
        return new geolocator($this->configData, $services);
    }
}