<?php

use Jungi\Common\Result;
use Jungi\Common\Option;

if (!function_exists('Ok')) {
    /**
     * @template T
     * @template E
     *
     * @param T $value
     *
     * @return Result<T, E>
     */
    function Ok($value = null): Result
    {
        return Result::Ok($value);
    }
}

if (!function_exists('Err')) {
    /**
     * @template T
     * @template E
     *
     * @param E $value
     *
     * @return Result<T, E>
     */
    function Err($value = null): Result
    {
        return Result::Err($value);
    }
}

if (!function_exists('Some')) {
    /**
     * @template T
     *
     * @param T $value
     */
    function Some($value = null): Option
    {
        return Option::Some($value);
    }
}

if (!function_exists('None')) {
    function None(): Option
    {
        return Option::None();
    }
}
