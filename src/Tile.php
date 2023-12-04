<?php

declare(strict_types=1);

namespace MinistryOfWeb\OsmTiles;

use InvalidArgumentException;

/**
 * @see https://wiki.openstreetmap.org/wiki/Slippy_map_tilenames
 */
class Tile
{
    /**
     * @throws InvalidArgumentException
     */
    public function __construct(public readonly int $x, public readonly int $y, public readonly int $zoom)
    {
        if ($zoom <= 0) {
            throw new InvalidArgumentException('zoom must be >= 1');
        }

        if ($x < 0) {
            throw new InvalidArgumentException('x cannot be < 0');
        }

        if ($x > (2 ** $zoom - 1)) {
            throw new InvalidArgumentException('x cannot be > (2^zoom - 1)');
        }

        if ($y < 0) {
            throw new InvalidArgumentException('y cannot be < 0');
        }

        if ($y > (2 ** $zoom - 1)) {
            throw new InvalidArgumentException('y cannot be > (2^zoom - 1)');
        }
    }

    public static function fromLocation(LatLng $location, int $zoom): self
    {
        return (new Converter())->toTile($location, $zoom);
    }

    /**
     * @deprecated use property instead
     */
    public function getX(): int
    {
        return $this->x;
    }

    /**
     * @deprecated use property instead
     */
    public function getY(): int
    {
        return $this->y;
    }

    /**
     * @deprecated use property instead
     */
    public function getZoom(): int
    {
        return $this->zoom;
    }
}
