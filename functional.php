<?php

namespace rainbow_paper\functional;

function map(array $array, callable $function, $user_data = NULL) {
    return \array_map(
        function($key) use($array, $function) {
            return call_user_func_array(
                $function,
                array_merge([$array[$key], $key],
                            is_null($user_data)
                            ? []
                            : [$user_data]));
        },
        array_keys($array));
}


function reduce(array $array, callable $callable, $initial = NULL) {
    return call_user_func_array(
        'array_reduce',
        array_merge([$array, $callable],
                    is_null($initial)
                    ? []
                    : [$initial]));
}


function each(array $array, callable $function, $user_data = NULL) {
    return call_user_func_array(
        'array_walk',
        array_merge([&$array, $function],
                    is_null($user_data)
                    ? []
                    : [$user_data]));
}
