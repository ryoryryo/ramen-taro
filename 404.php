<?php
/*
Template Name: 404
*/
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo bloginfo('name'); ?> -404</title>
    <link rel="icon" href="<?php echo esc_url(get_theme_file_uri('/images/logo.png')); ?>" sizes="16x16" type="images/logo.png">
    <link rel="icon" href="<?php echo esc_url(get_theme_file_uri('/images/logo.png')); ?>" sizes="32x32" type="images/logo.png">
    <link rel="icon" href="<?php echo esc_url(get_theme_file_uri('/images/logo.png')); ?>" sizes="48x48" type="images/logo.png">
    <link rel="icon" href="<?php echo esc_url(get_theme_file_uri('/images/logo.png')); ?>" sizes="62x62" type="images/logo.png">
    <link rel="apple-touch-icon-precomposed" href="<?php echo esc_url(get_theme_file_uri('/images/logo.png')); ?>">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="description" content="<?php bloginfo('description'); ?>">
    <!-- 検索避け -->
    <meta name="robots" content="noindex,nofollow">
    <meta property="og:site_name" content="<?php echo bloginfo('name'); ?>">
    <meta property="og:type" content="website">
    <meta property="og:title" content="<?php echo bloginfo('name'); ?> -404">
    <meta property="og:image" content="images/logo.png">
    <meta property="og:locale" content="ja_JP">

    <?php wp_head(); ?>

</head>

<body id="unknown">

    <?php wp_body_open(); ?>

    <header>
        <div class="header__wrapper">
            <h1 class="header__logo">
                <a href="<?php echo esc_url(home_url('/')); ?>">
                    <picture>
                        <source class="logo-source" srcset="<?php echo esc_url(get_theme_file_uri('/images/logo_black.png')); ?>" media="(max-width: 576px)">
                        <img class="logo-img" src="<?php echo esc_url(get_theme_file_uri('/images/logo_white.png')); ?>" alt="らーめんたろう">
                    </picture>
                </a>
            </h1>
            <nav class="header__navi">
                <ul>
                    <li><a href="<?php echo esc_url(home_url('/about_us/')); ?>">
                            <span>お店について</span>
                            <span>ABOUT US</span>
                        </a></li>
                    <li class="hover-li"><a href="<?php echo esc_url(home_url('/menu/')); ?>">
                            <span>お品書き<i class="fa-solid fa-circle-chevron-down"></i></span>
                            <span>MENU</span>
                        </a>
                        <ul class="hover-ul">
                            <li> <a href="<?php echo esc_url(home_url('/')); ?>menu#ramen">ラーメン</a> </li>
                            <li> <a href="<?php echo esc_url(home_url('/')); ?>menu#rice">飯類</a> </li>
                            <li> <a href="<?php echo esc_url(home_url('/')); ?>menu#side-menu">サイドメニュー</a> </li>
                        </ul>
                    </li>
                    <li><a href="<?php echo esc_url(home_url('/shop/')); ?>">
                            <span>店舗一覧</span>
                            <span>SHOPS</span>
                        </a></li>
                    <li><a href="<?php echo esc_url(home_url('/inquiry/')); ?>">
                            <span>お問い合わせ</span>
                            <span>INQUIRY</span>
                        </a></li>
                </ul>
            </nav>
            <button class="menu__btn">
                <span></span>
                <span></span>
                <span></span>
            </button>
        </div>
    </header>
    <main>
        <section>
            <div class="not-found__wrapper wrapper">
                <div class="not-found__content">
                    <h2>404</h2>
                    <p>NOT FOUND</p>
                    <a href="<?php echo esc_url(home_url('/')); ?>">back to TOP</a>
                </div>
            </div>
        </section>
    </main>
</body>

</html>