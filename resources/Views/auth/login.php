<!DOCTYPE html>
<html lang="fa" direction="rtl" dir="rtl" style="direction: rtl">

<head>
    <meta charset="utf-8" />
    <title><?php echo appTitle() ?> | ورود مدیران</title>
    <meta name="description" content="Login page example" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link href="<?php echo assets('/css/pages/login/login-2.css'); ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo plugins('/global/plugins.bundle.rtl.css'); ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo plugins('/custom/prismjs/prismjs.bundle.rtl.css'); ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo assets('/css/style.bundle.rtl.css'); ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo assets('/css/themes/layout/header/base/light.rtl.css'); ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo assets('/css/themes/layout/header/menu/light.rtl.css'); ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo assets('/css/themes/layout/brand/dark.rtl.css'); ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo assets('/css/themes/layout/aside/dark.rtl.css'); ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo assets('/media/logos/favicon.ico'); ?>" rel="shortcut icon" />
</head>

<body id="kt_body" class="header-fixed header-mobile-fixed subheader-enabled subheader-fixed aside-enabled aside-fixed aside-minimize-hoverable page-loading">
    <div class="d-flex flex-column flex-root">
        <div class="login login-2 login-signin-on d-flex flex-column flex-lg-row flex-column-fluid bg-white" id="kt_login">
            <div class="login-aside order-2 order-lg-1 d-flex flex-row-auto position-relative overflow-hidden">
                <div class="d-flex flex-column-fluid flex-column justify-content-between py-1 px-7 py-lg-1 px-lg-3">
                    <div class="d-flex flex-column-fluid flex-column flex-center mt-0">
                        <div class="login-form login-signin py-1">
                            <form class="form" novalidate="novalidate" id="signin_form">
                                <div class="text-center pb-0">
                                    <h2 class="font-weight-bolder text-dark font-size-h2 font-size-h1-lg">ورود به مدیریت</h2>
                                </div>
                                <div class="form-group">
                                    <label class="font-size-h6 font-weight-bolder text-dark">نام کاربری:</label>
                                    <input class="form-control form-control-solid h-auto py-4 px-6 rounded-lg" type="text" name="username" autocomplete="off" />
                                </div>
                                <div class="form-group">
                                    <div class="d-flex justify-content-between mt-n5">
                                        <label class="font-size-h6 font-weight-bolder text-dark pt-5">کلمه عبور:</label>
                                    </div>
                                    <input class="form-control form-control-solid h-auto py-4 px-6 rounded-lg" type="password" name="password" autocomplete="off" />
                                </div>
                                <div class="text-center pb-0">
                                    <div class="g-recaptcha text-center" data-sitekey="<?php echo secretKey('site_recaptcha_key'); ?>"></div>
                                </div>
                                <div class="text-center pt-2">
                                    <button id="signin_submit" class="btn btn-dark font-weight-bolder font-size-h6 px-8 py-3 my-3">ورود</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content order-1 order-lg-2 d-flex flex-column w-100 pb-0" style="background-color: #B1DCED;">
                <div class="content-img d-flex flex-row-fluid bgi-no-repeat bgi-position-y-bottom bgi-position-x-center" style="background-image: url(<?php echo assets('/media/svg/illustrations/login-visual-2.svg'); ?>);"></div>
            </div>
        </div>
    </div>

    <script src="<?php echo plugins('/global/plugins.bundle.js'); ?>"></script>
    <script src="<?php echo plugins('/custom/prismjs/prismjs.bundle.js'); ?>"></script>

    <script src="<?php echo jsFiles('/app/scripts.bundle.js'); ?>"></script>

    <script src="<?php echo jsFiles('/login/login.js'); ?>"></script>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</body>

</html>