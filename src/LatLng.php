<?php

namespace MinistryOfWeb\OsmTiles;

/**
 * Class LatLng
 *
 * @package MinistryOfWeb\OsmTiles
 */
class LatLng
{
    /**
     * @var float
     */
    private $lat;

    /**
     * @var float
     */
    private $lng;

    /**
     * LatLng constructor.
     *
     * @param float $lat
     * @param float $lng
     *
     * @throws \InvalidArgumentException
     */
    public function __construct($lat, $lng)
    {
        if ($lat < -90.0 || $lat > 90.0) {
            throw new \InvalidArgumentException('Latitude must be between -90.0 and 90.0');
        }

        if ($lng < -180.0 || $lng > 180.0) {
            throw new \InvalidArgumentException('Longitude must be between -180.0 and 180.0');
        }

        $this->lat = $lat;
        $this->lng = $lng;
    }

    /**
     * @return float
     */
    public function getLat()
    {
        return $this->lat;
    }

    /**
     * @return float
     */
    public function getLng()
    {
        return $this->lng;
    }
}
