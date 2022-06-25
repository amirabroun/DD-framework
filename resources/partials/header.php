<!DOCTYPE html>
<html lang="fa" direction="rtl" dir="rtl" style="direction: rtl">

<head>
    <meta charset="utf-8" />
    <title><?php echo appTitle() ?></title>
    <meta name="description" content="Metronic admin dashboard live demo. Check out all the features of the admin panel. A large number of settings, additional services and widgets." />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link href="<?php echo plugins('/custom/fullcalendar/fullcalendar.bundle.rtl.css'); ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo plugins('/global/plugins.bundle.rtl.css'); ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo plugins('/custom/prismjs/prismjs.bundle.rtl.css'); ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo assets('/css/style.bundle.rtl.css'); ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo assets('/css/themes/layout/header/base/light.rtl.css'); ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo assets('/css/themes/layout/header/menu/light.rtl.css'); ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo assets('/css/themes/layout/brand/dark.rtl.css'); ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo assets('/css/themes/layout/aside/dark.rtl.css'); ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo assets('/media/logos/favicon.ico'); ?>" rel="shortcut icon" />
    <link href="<?php echo plugins('/custom/datatables/datatables.bundle.rtl.css'); ?>" rel="stylesheet" type="text/css" />
</head>

<body id="kt_body" class="header-fixed header-mobile-fixed subheader-enabled subheader-fixed aside-enabled aside-fixed aside-minimize-hoverable page-loading footer-fixed">
    <div id="kt_header_mobile" class="header-mobile align-items-center header-mobile-fixed">
        <a href="index.html">
            <img alt="Logo" src="assets/media/logos/logo-light.png" />
        </a>
        <div class="d-flex align-items-center">
            <button class="btn p-0 burger-icon burger-icon-left" id="kt_aside_mobile_toggle">
                <span></span>
            </button>
            <button class="btn p-0 burger-icon ml-4" id="kt_header_mobile_toggle">
                <span></span>
            </button>
            <button class="btn btn-hover-text-primary p-0 ml-2" id="kt_header_mobile_topbar_toggle">
                <span class="svg-icon svg-icon-xl">
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <polygon points="0 0 24 0 24 24 0 24" />
                            <path d="M12,11 C9.790861,11 8,9.209139 8,7 C8,4.790861 9.790861,3 12,3 C14.209139,3 16,4.790861 16,7 C16,9.209139 14.209139,11 12,11 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" />
                            <path d="M3.00065168,20.1992055 C3.38825852,15.4265159 7.26191235,13 11.9833413,13 C16.7712164,13 20.7048837,15.2931929 20.9979143,20.2 C21.0095879,20.3954741 20.9979143,21 20.2466999,21 C16.541124,21 11.0347247,21 3.72750223,21 C3.47671215,21 2.97953825,20.45918 3.00065168,20.1992055 Z" fill="#000000" fill-rule="nonzero" />
                        </g>
                    </svg>
                </span>
            </button>
        </div>
    </div>

    <div class="d-flex flex-column flex-root">
        <div class="d-flex flex-row flex-column-fluid page">

            <div class="d-flex flex-column flex-row-fluid wrapper" id="kt_wrapper">