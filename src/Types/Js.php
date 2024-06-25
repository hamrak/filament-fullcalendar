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

        // Use a regex pattern to identify JavaScript functions and remove the quotes around them
        $pattern = '/"(\w+)"\s*:\s*"(function\(.*?\}|fn\(.*?\})"/';

        // Use preg_replace_callback to handle complex replacements
        $json = preg_replace_callback($pattern, function ($matches) {
            // $matches[2] contains the JavaScript function with escaped single quotes
            $functionContent = str_replace("\\\"", '"', $matches[2]);

            // Return the key and the cleaned function content
            return "\"{$matches[1]}\": {$functionContent}";
        }, $json);

        return str_replace('"', "'", $json);
    }
}
