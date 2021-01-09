<?php
namespace CarloNicora\Minimalism\Services\Geolocator;

use CarloNicora\Minimalism\Interfaces\ServiceInterface;
use Exception;
use IP2Location\Database;
use RuntimeException;

class Geolocator implements ServiceInterface
{
    /**
     * @var string
     */
    private string $geolocationFile;

    /** @var Database|null */
    private ?Database $ip2location=null;

    /**
     * Geolocator constructor.
     */
    public function __construct(
    ){
        $this->geolocationFile = __DIR__ . '/../data/IP2LOCATION-LITE-DB5.BIN';
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
            $this->ip2location = new Database($this->geolocationFile, Database::MEMORY_CACHE);
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

    /**
     *
     */
    public function initialise(): void {}

    /**
     *
     */
    public function destroy(): void {}
}