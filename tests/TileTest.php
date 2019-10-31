<?php
declare(strict_types=1);

namespace Tests\MinistryOfWeb\OsmTiles;

use InvalidArgumentException;
use MinistryOfWeb\OsmTiles\Tile;
use PHPUnit\Framework\TestCase;

class TileTest extends TestCase
{
    public function testIfGetXWorksAsExpected(): void
    {
        $tile = new Tile(32000, 31930, 15);

        self::assertSame(32000, $tile->getX());
    }

    public function testIfGetYWorksAsExpected(): void
    {
        $tile = new Tile(32000, 31930, 15);

        self::assertSame(31930, $tile->getY());
    }

    public function testIfGetZoomWorksAsExpected(): void
    {
        $tile = new Tile(32000, 31930, 15);

        self::assertSame(15, $tile->getZoom());
    }

    public function testIfZeroZoomValueThrowsAnException(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('zoom must be >= 1');

        new Tile(1, 1, 0);
    }

    public function testIfNonIntegerZoomValueThrowsAnException(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('zoom must be an integer value');

        new Tile(1, 1, 4.5);
    }

    public function testIfNegativeXThrowsAnException(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('x cannot be < 0');

        new Tile(-1, 1, 1);
    }

    public function testIfNegativeYThrowsAnException(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('y cannot be < 0');

        new Tile(1, -1, 1);
    }

    public function testIfTooLargeXThrowsAnException(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('x cannot be > (2^zoom - 1)');

        new Tile(16, 1, 4);
    }

    public function testIfTooLargeYThrowsAnException(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('y cannot be > (2^zoom - 1)');

        new Tile(1, 16, 4);
    }
}
