<?php

namespace Tests\MinistryOfWeb\OsmTiles;

use InvalidArgumentException;
use MinistryOfWeb\OsmTiles\Tile;
use PHPUnit\Framework\TestCase;

class TileTest extends TestCase
{
    public function testIfGetXWorksAsExpected()
    {
        $tile = new Tile(32000, 31930, 15);

        $this->assertEquals(32000, $tile->getX());
    }

    public function testIfGetYWorksAsExpected()
    {
        $tile = new Tile(32000, 31930, 15);

        $this->assertEquals(31930, $tile->getY());
    }

    public function testIfGetZoomWorksAsExpected()
    {
        $tile = new Tile(32000, 31930, 15);

        $this->assertEquals(15, $tile->getZoom());
    }

    public function testIfZeroZoomValueThrowsAnException()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('zoom must be >= 1');

        new Tile(1, 1, 0);
    }

    public function testIfNonIntegerZoomValueThrowsAnException()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('zoom must be an integer value');

        new Tile(1, 1, 4.5);
    }

    public function testIfNegativeXThrowsAnException()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('x cannot be < 0');

        new Tile(-1, 1, 1);
    }

    public function testIfNegativeYThrowsAnException()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('y cannot be < 0');

        new Tile(1, -1, 1);
    }

    public function testIfTooLargeXThrowsAnException()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('x cannot be > (2^zoom - 1)');

        new Tile(16, 1, 4);
    }

    public function testIfTooLargeYThrowsAnException()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('y cannot be > (2^zoom - 1)');

        new Tile(1, 16, 4);
    }
}
