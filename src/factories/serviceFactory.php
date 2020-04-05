<?php
namespace carlonicora\minimalism\services\geolocator\factories;

use carlonicora\minimalism\core\services\abstracts\abstractServiceFactory;
use carlonicora\minimalism\core\services\exceptions\configurationException;
use carlonicora\minimalism\core\services\factories\servicesFactory;
use carlonicora\minimalism\services\geolocator\configurations\geolocatorConfigurations;
use carlonicora\minimalism\services\geolocator\geolocator;

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