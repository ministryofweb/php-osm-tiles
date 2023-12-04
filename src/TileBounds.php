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
        return LatLng::fromTile(new Tile($tile->x + 1, $tile->y, $tile->zoom));
    }

    public static function getSouthEast(Tile $tile): LatLng
    {
        return LatLng::fromTile(new Tile($tile->x + 1, $tile->y + 1, $tile->zoom));
    }

    public static function getSouthWest(Tile $tile): LatLng
    {
        return LatLng::fromTile(new Tile($tile->x, $tile->y + 1, $tile->zoom));
    }
}
