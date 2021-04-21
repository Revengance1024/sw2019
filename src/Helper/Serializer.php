<?php

namespace Sw\Helper;

// TODO for Billy (Task 1): Update this file to use more modern serialization methods.
//  Sometimes attribute values contain one of the separators, and that breaks the whole functionality. Please change
//  this functionality so that we don't have these issues.

class Serializer
{
    const KEY_VALUE_SEPARATOR = ':';
    const ROW_SEPARATOR = '|';

    public static function serialize(array $data): string
    {
        $dataRows = [];
        foreach ($data as $key => $value) {
            $dataRows[] = $key . self::KEY_VALUE_SEPARATOR . $value;
        }

        return implode(self::ROW_SEPARATOR, $dataRows);
    }

    public static function unserialize(string $dataString): array
    {
        $dataRows = explode(self::ROW_SEPARATOR, $dataString);
        $data = [];
        foreach ($dataRows as $row) {
            list($key, $value) = explode(self::KEY_VALUE_SEPARATOR, $row);
            $data[$key] = $value;
        }

        return $data;
    }
}
