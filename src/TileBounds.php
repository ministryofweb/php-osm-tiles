<?php

declare(strict_types=1);

namespace MinistryOfWeb\OsmTiles;

class TileBounds
{
    public static function getNorthWest(Tile $tile): LatLng
    {
        return LatLng::fromTile($tile);
    }

    public static function getNorthEast(Tile $tile): LatLng
    {
        return LatLng::fromTile(new Tile($tile->getX() + 1, $tile->getY(), $tile->getZoom()));
    }

    public static function getSouthEast(Tile $tile): LatLng
    {
        return LatLng::fromTile(new Tile($tile->getX() + 1, $tile->getY() + 1, $tile->getZoom()));
    }

    public static function getSouthWest(Tile $tile): LatLng
    {
        return LatLng::fromTile(new Tile($tile->getX(), $tile->getY() + 1, $tile->getZoom()));
    }
}
