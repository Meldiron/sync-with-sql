<?php

/**
 * Throws an exception if any of the keys are missing from the object
 * @param array|object $obj
 * @param string[] $keys
 * @throws Exception
 */
function throw_if_missing(mixed $obj, array $keys): void
{
    $missing = [];
    foreach ($keys as $key) {
        if (!isset($obj[$key]) || empty($obj[$key])) {
            $missing[] = $key;
        }
    }
    if (count($missing) > 0) {
        throw new Exception('Missing required fields: ' . implode(', ', $missing));
    }
}
