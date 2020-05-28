<?php
namespace CarloNicora\Minimalism\Services\Geolocator;

use CarloNicora\Minimalism\Core\Services\Abstracts\AbstractService;
use CarloNicora\Minimalism\Core\Services\Factories\ServicesFactory;
use CarloNicora\Minimalism\Core\Services\Interfaces\ServiceConfigurationsInterface;
use Exception;
use IP2Location\Database;
use CarloNicora\Minimalism\Services\Geolocator\Configurations\GeolocatorConfigurations;
use RuntimeException;

class Geolocator extends AbstractService
{
    /** @var GeolocatorConfigurations  */
    private GeolocatorConfigurations $configData;

    /** @var Database|null */
    private ?Database $ip2location=null;

    /**
     * AbstractApiCaller constructor.
     * @param ServiceConfigurationsInterface $configData
     * @param ServicesFactory $services
     */
    public function __construct(ServiceConfigurationsInterface $configData, ServicesFactory $services)
    {
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
    public function lookupIP(string $ip, string &$countryCode, string &$cityName, string &$latitude, string &$longitude) : void
    {
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