<?php

/**
 * @return string
 */
function secretKey($key = null)
{
    $secret = require __DIR__ . "/../../config/app.php";
    $secret = $secret['secret'];

    if ($key) {
        return $secret[$key];
    }

    return $secret;
}
