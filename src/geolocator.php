<?php
namespace phlow\library\services\geolocator;

use carlonicora\minimalism\core\services\abstracts\abstractService;
use carlonicora\minimalism\core\services\factories\servicesFactory;
use carlonicora\minimalism\core\services\interfaces\serviceConfigurationsInterface;
use Exception;
use IP2Location\Database;
use phlow\library\services\geolocator\configurations\geolocatorConfigurations;
use RuntimeException;

class geolocator extends abstractService {
    /** @var geolocatorConfigurations  */
    private geolocatorConfigurations $configData;

    /** @var Database|null */
    private ?Database $ip2location=null;

    /**
     * abstractApiCaller constructor.
     * @param serviceConfigurationsInterface $configData
     * @param servicesFactory $services
     */
    public function __construct(serviceConfigurationsInterface $configData, servicesFactory $services) {
        parent::__construct($configData, $services);

        /** @noinspection PhpFieldAssignmentTypeMismatchInspection */
        $this->configData = $configData;
    }

    /**
     * @param string $ip
     * @param string $countryCode
     * @param string $cityName
     * @throws Exception
     */
    public function lookupIP(string $ip, string &$countryCode, string &$cityName) : void {
        if ($this->ip2location === null){
            $$this->ip2location = new Database($this->configData->geolocationFile, Database::FILE_IO);
        }

        $record = $this->ip2location->lookup($ip, Database::ALL);

        if ($record === null){
            throw new RuntimeException('IP not found');
        }

        $countryCode = $record['countryCode'];
        $cityName = $record['cityName'];
    }
}