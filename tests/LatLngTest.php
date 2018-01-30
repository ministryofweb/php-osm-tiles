<?php

namespace Tests\MinistryOfWeb\OsmTiles;

use MinistryOfWeb\OsmTiles\LatLng;
use PHPUnit\Framework\TestCase;

class LatLngTest extends TestCase
{
    public function testIfGetLatWorksAsExpected()
    {
        $latLng = new LatLng(52.5, 13.5);

        $this->assertEquals(52.5, $latLng->getLat());
    }

    public function testIfGetYWorksAsExpected()
    {
        $latLng = new LatLng(52.5, 13.5);

        $this->assertEquals(13.5, $latLng->getLng());
    }
}
