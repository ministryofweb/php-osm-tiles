<?php
declare(strict_types=1);

namespace Tests\MinistryOfWeb\OsmTiles;

use MinistryOfWeb\OsmTiles\LatLng;
use PHPUnit\Framework\TestCase;

class LatLngTest extends TestCase
{
    public function testIfGetLatWorksAsExpected(): void
    {
        $latLng = new LatLng(52.5, 13.5);

        self::assertSame(52.5, $latLng->lat);
    }

    public function testIfGetYWorksAsExpected(): void
    {
        $latLng = new LatLng(52.5, 13.5);

        self::assertSame(13.5, $latLng->lng);
    }
}
