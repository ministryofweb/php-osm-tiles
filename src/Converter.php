<?php

declare(strict_types=1);

namespace MinistryOfWeb\OsmTiles;

use InvalidArgumentException;
use RuntimeException;

/**
 * Class Converter.
 *
 * @see https://wiki.openstreetmap.org/wiki/Slippy_map_tilenames
 */
class Converter
{
    /**
     * @param LatLng $latLng
     * @param int $zoom
     *
     * @return Tile
     * @throws RuntimeException
     */
    public function toTile(LatLng $latLng, int $zoom): Tile
    {
        if (!$this->isValidZoom($zoom)) {
            throw new RuntimeException('Invalid Zoom level (must be an integer > 0)');
        }

        $tileX = (int)floor((($latLng->getLng() + 180) / 360) * (2 ** $zoom));
        $tileY = (int)floor(
            (1 - log(tan(deg2rad($latLng->getLat())) + 1 / cos(deg2rad($latLng->getLat()))) / M_PI) / 2 * (2 ** $zoom)
        );

        return new Tile($tileX, $tileY, $zoom);
    }

    /**
     * The resulting lat/lon pair is located at the north-west node of the tile.
     *
     * @param Tile $tile
     *
     * @return LatLng
     * @throws InvalidArgumentException
     */
    public function toLatLng(Tile $tile): LatLng
    {
        $zPow = 2 ** $tile->getZoom();
        $lat = rad2deg(atan(sinh(M_PI * (1 - 2 * $tile->getY() / $zPow))));
        $lng = $tile->getX() / $zPow * 360.0 - 180.0;

        return new LatLng($lat, $lng);
    }

    /**
     * @param int $zoom
     *
     * @return bool
     */
    private function isValidZoom(int $zoom): bool
    {
        return $zoom > 0;
    }
}
