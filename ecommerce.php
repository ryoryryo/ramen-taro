<?php
/*
Template Name: オンライン通販
*/
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo bloginfo('name'); ?> -オンライン通販</title>
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
    <meta property="og:title" content="<?php echo bloginfo('name'); ?> -オンライン通販">
    <meta property="og:image" content="images/logo.png">
    <meta property="og:locale" content="ja_JP">

    <?php wp_head(); ?>

</head>

<body id="ecommerce">
    <header>
        <div class="header__wrapper">
            <h1 class="header__logo">
                <a href="<?php echo esc_url(home_url('/home/')); ?>">
                    <img src="<?php echo esc_url(get_theme_file_uri('/images/logo_white.png')); ?>" alt="らーめんたろう">
                </a>
            </h1>
            <button>ログイン</button>
        </div>
    </header>
    <main>
        <div class="ecommerce__bg"></div>
        <section>
            <div class="ecommerce__wrapper wrapper">
                <h2>オンライン通販</h2>
                <div class="ecommerce__inner">
                    <a class="ecommerce__content" href="">
                        <dl>
                            <dt>商品名商品名</dt>
                            <dd><img src="<?php echo esc_url(get_theme_file_uri('/images/ramen8.jpg')); ?>" alt="商品"></dd>
                            <dd>780円</dd>
                            <dd>商品説明が入ります商品説明が入ります商品説明が入ります商品説明が入ります商品説明が入ります</dd>
                        </dl>
                        <div class="remains">残り<span>5</span></div>
                    </a>
                    <a class="ecommerce__content" href="">
                        <dl>
                            <dt>商品名商品名</dt>
                            <dd><img src="<?php echo esc_url(get_theme_file_uri('/images/ramen8.jpg')); ?>" alt="商品"></dd>
                            <dd>780円</dd>
                            <dd>商品説明が入ります商品説明が入ります商品説明が入ります商品説明が入ります商品説明が入ります</dd>
                        </dl>
                        <div class="remains">残り<span>5</span></div>
                    </a>
                    <a class="ecommerce__content" href="">
                        <dl>
                            <dt>商品名商品名</dt>
                            <dd><img src="<?php echo esc_url(get_theme_file_uri('/images/ramen8.jpg')); ?>" alt="商品"></dd>
                            <dd>780円</dd>
                            <dd>商品説明が入ります商品説明が入ります商品説明が入ります商品説明が入ります商品説明が入ります</dd>
                        </dl>
                        <div class="remains">残り<span>5</span></div>
                    </a>
                    <a class="ecommerce__content" href="">
                        <dl>
                            <dt>商品名商品名</dt>
                            <dd><img src="<?php echo esc_url(get_theme_file_uri('/images/ramen8.jpg')); ?>" alt="商品"></dd>
                            <dd>780円</dd>
                            <dd>商品説明が入ります商品説明が入ります商品説明が入ります商品説明が入ります商品説明が入ります</dd>
                        </dl>
                        <div class="remains">残り<span>5</span></div>
                    </a>

                </div>
            </div>
        </section>
    </main>
    <footer>
        <div class="footer__wrapper wrapper">
            <div class="footer__logo">
                <a href="<?php echo esc_url(home_url('/home/')); ?>">
                    <div><img decoding=”async” src="<?php echo esc_url(get_theme_file_uri('/images/logo_white.png')); ?>images/logo_white.png" alt="らーめんたろう"></div>
                </a>
            </div>
            <div class="footer__navi">
                <ul>
                    <li> <a href="<?php echo esc_url(home_url('/about/')); ?>">お店について</a> </li>
                    <li> <a href="<?php echo esc_url(home_url('/menu/')); ?>">お品書き</a> </li>
                    <li> <a href="<?php echo esc_url(home_url('/shop/')); ?>">店舗一覧</a> </li>
                    <li> <a href="<?php echo esc_url(home_url('/inquiry/')); ?>">お問い合わせ</a> </li>
                </ul>
            </div>
        </div> <small>© Driven by ramen</small>
    </footer>
</body>

</html>