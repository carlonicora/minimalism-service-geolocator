<?php
namespace CarloNicora\Minimalism\Services\Geolocator;

use CarloNicora\Minimalism\Interfaces\ServiceInterface;
use CarloNicora\Minimalism\Services\Path;
use Exception;
use GeoIp2\Database\Reader;

class Geolocator implements ServiceInterface
{
    /** @var string|null  */
    private ?string $database;

    /**
     * Geolocator constructor.
     * @param Path $path
     */
    public function __construct(
        Path $path,
    ){
        $this->database = $path->getRoot()
            . 'data' . DIRECTORY_SEPARATOR
            . 'GeoIP2-City.mmdb';

        if (!file_exists($this->database)){
            $this->database = null;
        }
    }

    /**
     * @param string $ip
     * @param string|null $countryCode
     * @param string|null $cityName
     * @param float|null $latitude
     * @param float|null $longitude
     */
    public function lookupIP(
        string $ip,
        ?string &$countryCode,
        ?string &$cityName,
        ?float &$latitude,
        ?float &$longitude
    ) : void
    {
        if ($this->database !== null){
            try {
                $reader = new Reader($this->database);

                $record = $reader->city($ip);

                $countryCode = $record->country->isoCode;
                $cityName = $record->city->name;
                $latitude = $record->location->latitude;
                $longitude = $record->location->longitude;
            } catch (Exception) {
                $countryCode = null;
                $cityName = null;
                $latitude = null;
                $longitude = null;
            }
        }
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