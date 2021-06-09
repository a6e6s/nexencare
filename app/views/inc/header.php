<?php
// if (!$_SERVER['HTTPS']) {
// header("Location: https://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);
// }
?>
<!DOCTYPE html>
<html lang="ar">
<!--
Copyright (C) 2020 Easy CMS Framework Ahmed Elmahdy

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License
@license    https://opensource.org/licenses/GPL-3.0

@package    Easy CMS MVC framework
@author     Ahmed Elmahdy
@link       https://ahmedx.com

For more information about the author , see <http://www.ahmedx.com/>.
-->

<head>
    <!-- Primary Meta Tags -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="keywords" content="<?php echo $data['settings']['seo']->meta_keywords; ?>">
    <meta name="title" content="<?php echo $data['settings']['site']->title; ?>">
    <meta name="description" content="<?php echo $data['settings']['seo']->meta_description; ?>">
    <meta name="author" content="Ahmed Elmahdy">
    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="<?php echo "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]" ?>">
    <meta property="og:title" content="<?php echo $data['settings']['site']->title; ?>">
    <meta property="og:description" content="<?php echo $data['settings']['seo']->meta_description; ?>">
    <meta property="og:image" content="<?php echo URLROOT . '/templates/nexencare/images/logo.png';; ?>">

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="<?php echo "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]" ?>">
    <meta property="twitter:title" content="<?php echo $data['settings']['site']->title; ?>">
    <meta property="twitter:description" content="<?php echo $data['settings']['seo']->meta_description; ?>">
    <meta property="twitter:image" content="<?php echo URLROOT . '/templates/nexencare/images/logo.png'; ?>">

    <?php echo $data['settings']['site']->header_code; ?>
    <link rel="shortcut icon" href="<?php echo URLROOT; ?>/templates/nexencare/images/favicon.ico" type="image/x-icon">
    <link rel="icon" href="<?php echo URLROOT; ?>/templates/nexencare/images/favicon.ico" type="image/x-icon">
    <title><?php echo ($data['pageTitle']) ?? SITENAME; ?></title>
    <!-- main styles with bootstrap -->
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/templates/nexencare/css/main.min.css" />
    <!-- icofont iconss -->
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/templates/nexencare/css/icofont.min.css" />
</head>

<body>
    <div class="preloader text-center">
        <div class="text-center">
            <img src="<?php echo URLROOT; ?>/templates/nexencare/images/icon.gif" alt="">
        </div>
    </div>
    <section id="top-bar" class="bg-dark pb-5">
        <div class="container text-light pt-3 mb-lg-3 mb-2">
            <div class="row align-items-center">
                <div class="col-lg-4 col-6 ">
                    <h6 class="text-right welcome-text"><?php echo $data['settings']['site']->welcomeText; ?></h6>
                </div>
                <div class="col-lg-8 col-6">
                    <div class="row justify-content-end text-right">
                        <div class="col-2 col-md-1 mt-2 p-0 text-center">
                            <a class="d-block text-light" href="tel:<?php echo isset($_SESSION['store']->email) ? $_SESSION['store']->email : $data['settings']['contact']->email; ?>">
                                <i class="icofont-envelope p-2 bg-light text-dark rounded-circle icofont-lg"></i>
                            </a>
                        </div>
                        <div class="col-3 p-0 d-none d-lg-inline">
                            <span class="pr-1">أرسل لنا بريدًا إلكترونيًا:</span>
                            <?php
                            if (isset($_SESSION['store']->email)) {
                                echo '<a class="d-block text-light" href="mailto:' . $_SESSION['store']->email . '"> ' . $_SESSION['store']->email . '</a>';
                            } else {
                                echo '<a class="d-block text-light" href="mailto:' . $data['settings']['contact']->email . '"> ' . $data['settings']['contact']->email . ' </a>';
                            }
                            ?>
                        </div>
                        <div class="col-2 col-md-1 mt-2 p-0 text-center mx-2">
                            <?php
                            if (isset($_SESSION['store']->mobile)) {
                                echo '<a class="d-block text-light" href="tel:' . $_SESSION['store']->mobile . '"><i class="icofont-phone p-2 bg-light text-dark rounded-circle icofont-lg"></i></a>';
                            } else {
                                echo '<a class="d-block text-light" href="tel:' . $data['settings']['contact']->mobile . '"><i class="icofont-phone p-2 bg-light text-dark rounded-circle icofont-lg"></i></a>';
                            }
                            ?>
                        </div>
                        <div class="col-3 p-0 d-none d-lg-inline">
                            <span class="pr-1">أتصل بنا:</span>
                            <?php
                            if (isset($_SESSION['store']->mobile)) {
                                echo '<a class="d-block text-light" href="tel:' . $_SESSION['store']->mobile . '">' . $_SESSION['store']->mobile . '</a>';
                            } else {
                                echo '<a class="d-block text-light" href="tel:' . $data['settings']['contact']->mobile . '">' . $data['settings']['contact']->mobile . '</a>';
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
        <!-- main menu end -->
        <section id="menu-bar">
        <div class="container-lg bg-white rounded py-0 d-flex shadow">
            <nav class="navbar navbar-expand-lg navbar-light py-2">
                <button type="button" data-toggle="collapse" data-target="#navbarContent" aria-controls="navbars" aria-expanded="false" aria-label="Toggle navigation" class="navbar-toggler p-1">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <a href="<?php echo URLROOT; ?>" class="navbar-brand font-weight-bold ml-auto pr-0">
                    <img class="" src="<?php echo  URLROOT . '/templates/nexencare/images/logo.png' ; ?>" alt="<?php echo SITENAME; ?>" width="" />
                </a>
                <div id="navbarContent" class="collapse navbar-collapse">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a href="<?php echo URLROOT; ?>" class="nav-link active"><i class="icofont-home icofont-lg"></i> <span class="d-sm-inline d-lg-none">الرئيسية</span></a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo URLROOT; ?>/pages/subscription" class="nav-link active"> <span class="">التسجيل</span></a>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
    </section>