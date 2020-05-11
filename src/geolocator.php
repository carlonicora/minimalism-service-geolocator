<?php
namespace carlonicora\minimalism\services\geolocator;

use carlonicora\minimalism\core\services\abstracts\abstractService;
use carlonicora\minimalism\core\services\factories\servicesFactory;
use carlonicora\minimalism\core\services\interfaces\serviceConfigurationsInterface;
use Exception;
use IP2Location\Database;
use carlonicora\minimalism\services\geolocator\configurations\geolocatorConfigurations;
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
     * @param string $latitude
     * @param string $longitude
     * @throws Exception
     */
    public function lookupIP(string $ip, string &$countryCode, string &$cityName, string &$latitude, string &$longitude) : void {
        if ($this->ip2location === null){
            $this->ip2location = new Database($this->configData->geolocationFile, Database::FILE_IO);
        }

        $record = $this->ip2location->lookup($ip, Database::ALL);

        if (empty($record)){
            throw new RuntimeException('IP not found');
        }

        $countryCode = ($record['countryCode'] === '-') ? '': $record['countryCode'];
        $cityName = ($record['cityName'] === '-') ? '' : $record['cityName'];
        $latitude = (empty($record['latitude'])) ? '': $record['latitude'];
        $longitude = (empty($record['longitude'])) ? '': $record['longitude'];
    }
}