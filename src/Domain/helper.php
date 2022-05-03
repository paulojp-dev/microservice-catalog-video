<?php

if (!function_exists('array_first')) {
    function array_first(array $arr): mixed
    {
        return $arr[array_key_first($arr)] ?? null;
    }
}

if (!function_exists('array_last')) {
    function array_last(array $arr): mixed
    {
        return $arr[array_key_last($arr)] ?? null;
    }
}

if (!function_exists('array_has')) {
    function array_has(array $arr, string $key): bool
    {
        return array_key_exists($key, $arr);
    }
}

if (!function_exists('dd')) {
    /**
     * @codeCoverageIgnore
     * @param mixed ...$data
     */
    function dd(mixed ...$data): void
    {
        dump($data);
        die();
    }
}

if (!function_exists('now')) {
    function now(): \DateTime
    {
        return new \DateTime();
    }
}
