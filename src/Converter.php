<?php

namespace MinistryOfWeb\OsmTiles;

/**
 * Class Converter
 *
 * @package MinistryOfWeb\OsmTiles
 * @see https://wiki.openstreetmap.org/wiki/Slippy_map_tilenames
 */
class Converter
{
    /**
     * @param LatLng $latLng
     * @param int $zoom
     *
     * @return Tile
     * @throws \InvalidArgumentException
     * @throws \RuntimeException
     */
    public function toTile(LatLng $latLng, $zoom)
    {
        if (! $this->isValidZoom($zoom)) {
            throw new \RuntimeException('Invalid Zoom level (must be integer > 0)');
        }

        $tileX = floor((($latLng->getLng() + 180) / 360) * (2 ** $zoom));
        $tileY = floor(
            (1 - log(tan(deg2rad($latLng->getLat())) + 1 / cos(deg2rad($latLng->getLat()))) / M_PI) / 2 * (2 ** $zoom)
        );

        return new Tile($tileX, $tileY, $zoom);
    }

    /**
     * @param Tile $tile
     *
     * @return LatLng
     * @throws \InvalidArgumentException
     */
    public function toLatLng(Tile $tile)
    {
        $zPow = 2 ** $tile->getZoom();
        $lat  = rad2deg(atan(sinh(M_PI * (1 - 2 * $tile->getY() / $zPow))));
        $lng  = $tile->getX() / $zPow * 360.0 - 180.0;

        return new LatLng($lat, $lng);
    }

    /**
     * @param int $zoom
     *
     * @return bool
     */
    private function isValidZoom($zoom)
    {
        if (! is_int($zoom)) {
            return false;
        }

        return $zoom > 0;
    }
}
