<?php

/**
 * @param string $key secret_login|secret_recaptcha_key|site_recaptcha_key|all_secret
 *
 * @return string
 */
function secretKey($key = null)
{
    $secret = [
        'secret_login' => getenv('SECRET_LOGIN'),
        'secret_recaptcha_key' => getenv('SECRET_KEY'),
        'site_recaptcha_key' => getenv('SITE_KEY'),
    ];

    if ($key)
        return $secret[$key];

    return $secret;
}

/**
 * @return string app_title
 */
function appTitle()
{
    return getenv('APP_TITLE');
}
