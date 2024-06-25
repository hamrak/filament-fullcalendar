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
        return '|_JS_BEGIN_|'.$this->js.'|_JS_END_|';
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

        $json = str_replace(["\\r", "\\n", "\\t"], '', $json);

        // Use a regex pattern to identify the custom markers and the JavaScript function content
        $pattern = '/"(\w+)"\s*:\s*"\|_JS_BEGIN_\|(.*?)\|_JS_END_\|"/';

        // Use preg_replace_callback to handle the replacement
        $json = preg_replace_callback($pattern, function ($matches) {
            // $matches[2] contains the JavaScript function content between the markers
            $functionContent = $matches[2];

            // Remove single-line comments
            $functionContent = preg_replace('/\/\/[^\n]*\n?/', '', $functionContent);

            // Remove multi-line comments
            $functionContent = preg_replace('/\/\*.*?\*\//s', '', $functionContent);

            $functionContent = str_replace('\\"', "'", $functionContent);

            // Return the key and the cleaned function content
            return "\"{$matches[1]}\": {$functionContent}";
        }, $json);

        return str_replace('"', "'", $json);
    }
}
