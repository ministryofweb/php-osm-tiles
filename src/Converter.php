<?php

declare(strict_types=1);

namespace MinistryOfWeb\OsmTiles;

use InvalidArgumentException;
use RuntimeException;

/**
 * @see https://wiki.openstreetmap.org/wiki/Slippy_map_tilenames
 */
class Converter
{
    /**
     * @throws RuntimeException
     */
    public function toTile(LatLng $latLng, int $zoom): Tile
    {
        if (!$this->isValidZoom($zoom)) {
            throw new RuntimeException('Invalid Zoom level (must be an integer > 0)');
        }

        $tileX = (int)floor((($latLng->lng + 180) / 360) * (2 ** $zoom));
        $tileY = (int)floor(
            (1 - log(tan(deg2rad($latLng->lat)) + 1 / cos(deg2rad($latLng->lat))) / M_PI) / 2 * (2 ** $zoom)
        );

        return new Tile($tileX, $tileY, $zoom);
    }

    /**
     * The resulting lat/lon pair is located at the north-west node of the tile.
     *
     * @throws InvalidArgumentException
     */
    public function toLatLng(Tile $tile): LatLng
    {
        $zPow = 2 ** $tile->zoom;
        $lat = rad2deg(atan(sinh(M_PI * (1 - 2 * $tile->y / $zPow))));
        $lng = $tile->x / $zPow * 360.0 - 180.0;

        return new LatLng($lat, $lng);
    }

    private function isValidZoom(int $zoom): bool
    {
        return $zoom > 0;
    }
}
