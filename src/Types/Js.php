<?php

namespace Saade\FilamentFullCalendar\Types;

class Js
{
    protected ?string $js = null;

    /**
     * @throws \JsonException
     */
    public function __construct(null|array|object|string $js)
    {
        if (is_array($js) || is_object($js)) {
            $this->js = json_encode($js, JSON_THROW_ON_ERROR);
        } else {
            $this->js = $js;
        }
    }

    public function __toString(): string
    {
        return $this->js;
    }

    protected static function prepareProcessConfig(?array $array): array
    {
        $processedArray = [];

        foreach ((array)$array as $key => $value) {
            if (is_array($value)) {
                $processedArray[$key] = static::prepareProcessConfig($value);
            } elseif (is_object($value) && method_exists($value, '__toString')) {
                // Convert Js function to raw JavaScript
                $processedArray[$key] = (string) $value;
            } else {
                $processedArray[$key] = $value;
            }
        }

        return $processedArray;
    }

    /**
     * @throws \JsonException
     */
    public static function processConfig(?array $array): string|false
    {
        $processedArray = static::prepareProcessConfig($array);

        $json = json_encode($processedArray, JSON_THROW_ON_ERROR | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
        $json = preg_replace('/\s+/', ' ', $json);
        $json = str_replace('"', "'", $json);

        return preg_replace_callback('/"(\w+)"\s*:\s*"(function\(.+?\)|fn\(.+?\)=>.+?)"/', static function ($matches) {
            return "\"{$matches[1]}\": {$matches[2]}";
        }, $json);
    }
}
