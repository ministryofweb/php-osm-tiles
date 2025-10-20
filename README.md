# PHP OSM Tiles

This library helps to convert OpenStreetMap (OSM) map tile numbers to
geographical coordinates and vice versa.

[![PHP OSM Tiles Tests](https://github.com/ministryofweb/php-osm-tiles/actions/workflows/php.yml/badge.svg)](https://github.com/ministryofweb/php-osm-tiles/actions/workflows/php.yml)

## Installation

Using Composer, add it to your `composer.json` by running:

```shell
composer require ministryofweb/php-osm-tiles
```

## Compatibility

The PHP OSM Tiles library requires PHP >= 8.1.

If support for older PHP versions is needed, the PHP OSM Tiles library can be installed at version 2.0
(PHP 7.3, PHP 7.4 and PHP 8.0), 1.0 (PHP 7.1 and PHP 7.2) or version 0.1.0 (PHP 7.0).

## Usage/Examples

## Convert from geographical coordinates to map tile numbers

```php
<?php

use MinistryOfWeb\OsmTiles\Converter;
use MinistryOfWeb\OsmTiles\LatLng;

$converter = new Converter();
$point     = new LatLng(52.5, 13.4);
$zoom      = 13;

$tile = $converter->toTile($point, $zoom);

printf('/tiles/%d/%d/%d.png', $zoom, $tile->x, $tile->y);
```

The code above produces the output below:

```text
/tiles/13/4400/2687.png
```

## Convert from map tile numbers to geographical coordinates

```php
<?php

use MinistryOfWeb\OsmTiles\Converter;
use MinistryOfWeb\OsmTiles\Tile;

$converter = new Converter();
$tile     = new Tile(4400, 2687, 13);

$point = $converter->toLatLng($tile);

printf('%.5f, %.5f', $point->lat, $point->lat);
```

The code above produces the output below:

```text
52.50953, 13.35938
```

## Get Bounds of a Tile

It's possible to get the coordinates for the Tiles north-western, north-eastern, south-eastern and south-western nodes:

```php
<?php

use MinistryOfWeb\OsmTiles\LatLng;
use MinistryOfWeb\OsmTiles\Tile;
use MinistryOfWeb\OsmTiles\TileBounds;

$tile = Tile::fromLocation(new LatLng(52.5, 13.5));

echo 'South-eastern point for tile is located at: ' . TileBounds::getSouthEast($tile)->lat . ', ' . TileBounds::getSouthEast($tile)->lng . PHP_EOL;
```

The code above produces the output below:

```
South-eastern point for tile is located at: 52.496159531097, 13.51318359375
```

## Run Tests

``` shell script
make test
```

or

``` shell script
./vendor/bin/phpunit
```

## Run all CI tools

``` shell script
make ci
```

## OpenStreetMap Map Tile Names Documentation

- https://wiki.openstreetmap.org/wiki/Slippy_map_tilenames
