<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>BIEQUEEN</title>
    <link rel="icon" href="/views/assets/images/favicon/icon.png">
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/views/assets/css/all.min.css">
    <link rel="stylesheet" href="/views/assets/css/slick.css">
    <link rel="stylesheet" href="/views/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="/views/assets/css/style.css">
    <link rel="stylesheet" href="/views/assets/css/media-query.css">

    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-8407972809852383"
     crossorigin="anonymous"></script>
</head>

<body>
    <div class="site-content">
        <!-- Preloader Start -->
        <div class="loader-mask">
            <div class="circle">
            </div>
        </div>
        <!-- Preloader End -->
        <!-- Header Start -->
        <header id="top-navbar" class="top-navbar">
            <div class="container">
                <div class="top-navbar_full">
                    <div class="back-btn">
                        <?php
                        $page = $_GET['page'];
                        if (!$page == null) {
                        ?>
                            <a href="javascript:history.go(-1)">
                                <img src="/views/assets/svg/back-btn.svg" alt="back-btn">
                            </a>
                        <?php
                        }
                        ?>
                    </div>
                    <div class="top-navbar-title">
                        <a href="/">
                            <p>BIEQUEEN</p>
                        </a>
                    </div>
                    <div class="skip_btn notification-badge-btn">
                    </div>
                </div>
            </div>
            <div class="navbar-boder"></div>
        </header>
        <!-- Header End -->
