<?php
namespace CarloNicora\Minimalism\Services\Geolocator\Factories;

use CarloNicora\Minimalism\Core\Services\Abstracts\AbstractServiceFactory;
use CarloNicora\Minimalism\Core\Services\Exceptions\ConfigurationException;
use CarloNicora\Minimalism\Core\Services\Factories\ServicesFactory;
use CarloNicora\Minimalism\Services\Geolocator\Configurations\GeolocatorConfigurations;
use CarloNicora\Minimalism\Services\Geolocator\Geolocator;

class ServiceFactory extends AbstractServiceFactory
{
    /**
     * serviceFactory constructor.
     * @param ServicesFactory $services
     * @throws ConfigurationException
     */
    public function __construct(ServicesFactory $services)
    {
        $this->configData = new GeolocatorConfigurations();

        parent::__construct($services);
    }

    /**
     * @param ServicesFactory $services
     * @return Geolocator
     */
    public function create(ServicesFactory $services) : Geolocator
    {
        return new Geolocator($this->configData, $services);
    }
}