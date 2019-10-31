# PHP OSM Tiles

This library helps converting OpenStreetMap (OSM) map tile numbers to
geographical coordinates and vice versa.

## Installation

Using Composer, just add it to your `composer.json` by running:

```shell
composer require ministryofweb/php-osm-tiles
```

## Compatibility

The PHP OSM Tiles library requires PHP >= 7.1.

For older PHP version you can install the PHP OSM Tiles library at version 0.1.0.

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

printf('/tiles/%d/%d/%d.png', $zoom, $tile->getX(), $tile->getY());
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

printf('%.5f, %.5f', $point->getLat(), $point->getLng());
```

The code above produces the output below:

```text
52.50953, 13.35938
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
