<?php

namespace rainbow_paper\bg;
header('Content-type: image/png', FALSE, 200);

define('WIDTH', 4096);
define('HEIGHT', 100);

define('RANGE_MIN', 10);
define('RANGE_MAX', 16);

define('COLOR_BG', 'CCC');
define('COLOR_FG', 'FFF');

require_once sprintf('%s/functional.php', __DIR__);

use rainbow_paper\functional;


function color($image, $hex) {
    $colors = strlen($hex) == 3
              ? functional\map(str_split($hex, 1),
                               function($item) {
                                   return str_repeat($item, 2);
                               })
              : str_split($hex, 2);

    return call_user_func_array('imagecolorallocate',
                                array_merge([$image],
                                functional\map($colors,
                                               function($item) { return hexdec($item); })));
}


function fill($image, $height, $zoom, $color, array $pair) {
    list($from, $to) = $pair;

    call_user_func_array('imagefilledrectangle',
                         array_merge([$image],
                                     [$from[0],
                                      $height,
                                      $to[0],
                                      round($to[1] / $zoom)],
                                     [$color]));
}


function image_create($width, $height) {
    $base = imagecreatetruecolor($width, $height);
    imagecolortransparent($base, imagecolorallocate($base, 0, 0, 0));

    imagealphablending($base, TRUE);
    imagesavealpha($base, FALSE);

    return $base;
}


function pair(array $points) {
    return functional\reduce(range(0, count($points) - 2),
                             function($result, $index) use($points) {
                                 return array_merge($result,
                                                    [[$points[$index],
                                                      $points[$index + 1]]]);
                             },
                             []);
}


function point_new($height, $range_min, $range_max, $point_last) {
    list($x, $_) = $point_last;

    return [rand($x + $range_min, $x + $range_max),
            rand(0, $height - $range_min)];
}


function point_over_max($width, array $point) {
    list($x, $_) = $point;

    return $x > $width;
}


function points($width, $height, $range_min, $range_max, array $result=NULL) {
    $to_return = [];

    if(is_null($result)) {
        $to_return = points($width,
                            $height,
                            $range_min,
                            $range_max,
                            [[0, $height]]);
    } else if(point_over_max($width, end($result))) {
        $to_return = $result;
    } else {
        $to_return = points($width,
                            $height,
                            $range_min,
                            $range_max,
                            array_merge($result,
                                        [point_new($height,
                                                   $range_min,
                                                   $range_max,
                                                   end($result))]));
    }

    return $to_return;
}


function param($key, $default_value) {
    return array_key_exists($key, $_GET) ?
        $_GET[$key]
        : $default_value;
}


$image = functional\reduce(
    pair(points(param('w', WIDTH), param('h', HEIGHT), round(param('n', RANGE_MIN)/ 2), round(param('x', RANGE_MAX) / 2))),
    function($image, array $pair) {
        fill($image, param('h', HEIGHT), 0.75, color($image, param('f', COLOR_FG)), $pair);

        return $image;
    },
    functional\reduce(
        pair(points(param('w', WIDTH), param('h', HEIGHT), param('n', RANGE_MIN), param('x', RANGE_MAX))),
        function($image, array $pair) {
            fill($image, param('h', HEIGHT), 1, color($image, param('b', COLOR_BG)), $pair);

            return $image;
        },
        image_create(param('w', WIDTH), param('h', HEIGHT))));
imagepng($image);
imagedestroy($image);
