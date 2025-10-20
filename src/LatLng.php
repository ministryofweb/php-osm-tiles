<?php

declare(strict_types=1);

namespace MinistryOfWeb\OsmTiles;

use InvalidArgumentException;

class LatLng
{
    /**
     * @throws InvalidArgumentException
     */
    public function __construct(public readonly float $lat, public readonly float $lng)
    {
        if ($lat < -90.0 || $lat > 90.0) {
            throw new InvalidArgumentException('Latitude must be between -90.0 and 90.0');
        }

        if ($lng < -180.0 || $lng > 180.0) {
            throw new InvalidArgumentException('Longitude must be between -180.0 and 180.0');
        }
    }

    public static function fromTile(Tile $tile): self
    {
        return (new Converter())->toLatLng($tile);
    }

    /**
     * @deprecated use property instead
     */
    public function getLat(): float
    {
        return $this->lat;
    }

    /**
     * @deprecated use property instead
     */
    public function getLng(): float
    {
        return $this->lng;
    }
}
