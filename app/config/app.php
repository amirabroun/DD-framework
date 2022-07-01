<?php

return [

    'secret' => [
        'secret_login' => getenv('SECRET_LOGIN'),
        'secret_recaptcha_key' => getenv('SECRET_KEY'),
        'site_recaptcha_key' => getenv('SITE_KEY'),
    ]
];
