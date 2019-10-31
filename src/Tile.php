<?php

declare(strict_types=1);

namespace MinistryOfWeb\OsmTiles;

use InvalidArgumentException;

/**
 * Class Tile.
 *
 * @see https://wiki.openstreetmap.org/wiki/Slippy_map_tilenames
 */
class Tile
{
    /**
     * @var int
     */
    private $tileX;

    /**
     * @var int
     */
    private $tileY;

    /**
     * @var int
     */
    private $zoom;

    /**
     * Tile constructor.
     *
     * @param int $tileX
     * @param int $tileY
     * @param int $zoom
     *
     * @throws InvalidArgumentException
     */
    public function __construct(int $tileX, int $tileY, int $zoom)
    {
        if ($zoom <= 0) {
            throw new InvalidArgumentException('zoom must be >= 1');
        }

        if ($tileX < 0) {
            throw new InvalidArgumentException('x cannot be < 0');
        }

        if ($tileX > (2 ** $zoom - 1)) {
            throw new InvalidArgumentException('x cannot be > (2^zoom - 1)');
        }

        if ($tileY < 0) {
            throw new InvalidArgumentException('y cannot be < 0');
        }

        if ($tileY > (2 ** $zoom - 1)) {
            throw new InvalidArgumentException('y cannot be > (2^zoom - 1)');
        }

        $this->tileX = $tileX;
        $this->tileY = $tileY;
        $this->zoom = $zoom;
    }

    /**
     * @return int
     */
    public function getX(): int
    {
        return $this->tileX;
    }

    /**
     * @return int
     */
    public function getY(): int
    {
        return $this->tileY;
    }

    /**
     * @return int
     */
    public function getZoom(): int
    {
        return $this->zoom;
    }
}
