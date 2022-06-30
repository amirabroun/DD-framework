<?php

/**
 * @param string $key
 *
 * @return string admin
 * @return string public
 * @return string origin
 * @return array all_domain
 */
function domain($key = null)
{
    $domain = [
        'admin' => getenv('ADMIN_DOMAIN'),
        'public' => getenv('PUBLIC_DOMAIN'),
        'origin' => getenv('ORIGIN_DOMAIN'),
    ];

    if ($key)
        return $domain[$key];

    return $domain;
}

/**
 * @param string $key
 *
 * @return string secret_login
 * @return string secret_recaptcha_key
 * @return string site_recaptcha_key
 * @return string all_secret
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
