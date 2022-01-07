<?php
namespace CarloNicora\Minimalism\Services\Geolocator;

use CarloNicora\Minimalism\Abstracts\AbstractService;
use CarloNicora\Minimalism\Services\Path;
use Exception;
use GeoIp2\Database\Reader;

class Geolocator extends AbstractService
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
        parent::__construct();
        $this->database = $path->getRoot()
            . DIRECTORY_SEPARATOR
            . 'data'
            . DIRECTORY_SEPARATOR
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
                $record = (new Reader($this->database))->city($ip);

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