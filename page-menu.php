<?php
/*
Template Name: お品書き
*/

get_header(); ?>
<main>
    <div class="menu-mv__sec">
        <div class="menu-mv__inner">
            <div class="swiper menu-slider2">
                <div class="swiper-wrapper">
                    <!-- Slides -->
                    <div class="swiper-slide slide-main">
                        <img decoding=”async” src="<?php echo get_field('menu-slider-image1')['url']; ?>" alt="<?php echo get_field('menu-slider-image1')['alt']; ?>">
                        <span><?php echo get_field('menu-slider-text1'); ?></span>
                    </div>
                    <div class="swiper-slide slide-main"> <img decoding=”async” src="<?php echo get_field('menu-slider-image2')['url']; ?>" alt="<?php echo get_field('menu-slider-image2')['alt']; ?>">
                        <span><?php echo get_field('menu-slider-text2'); ?></span>
                    </div>
                    <div class="swiper-slide slide-main"> <img decoding=”async” src="<?php echo get_field('menu-slider-image3')['url']; ?>" alt="<?php echo get_field('menu-slider-image3')['alt']; ?>">
                        <span><?php echo get_field('menu-slider-text3'); ?></span>
                    </div>
                    <div class="swiper-slide slide-main"> <img decoding=”async” src="<?php echo get_field('menu-slider-image4')['url']; ?>" alt="<?php echo get_field('menu-slider-image4')['alt']; ?>">
                        <span><?php echo get_field('menu-slider-text4'); ?></span>
                    </div>
                </div>
                <div class="swiper-button-prev"></div>
                <div class="swiper-button-next"></div>
            </div>
            <div class="swiper menu-slider1">
                <div class="swiper-wrapper">
                    <!-- Slides -->
                    <div class="swiper-slide slide-sub"><img decoding=”async” src="<?php echo get_field('menu-slider-image1')['url']; ?>" alt="<?php echo get_field('menu-slider-image1')['alt']; ?>"></div>
                    <div class="swiper-slide slide-sub"><img decoding=”async” src="<?php echo get_field('menu-slider-image2')['url']; ?>" alt="<?php echo get_field('menu-slider-image2')['alt']; ?>"></div>
                    <div class="swiper-slide slide-sub"><img decoding=”async” src="<?php echo get_field('menu-slider-image3')['url']; ?>" alt="<?php echo get_field('menu-slider-image3')['alt']; ?>"></div>
                    <div class="swiper-slide slide-sub"><img decoding=”async” src="<?php echo get_field('menu-slider-image4')['url']; ?>" alt="<?php echo get_field('menu-slider-image4')['alt']; ?>"></div>
                </div>
            </div>
        </div>
    </div>
    <section class="menu-top__sec menu-background">
        <div class="menu-top__wrapper row">
            <div class="menu-left-column">
                <h2><?php echo get_field('title'); ?></h2>
                <?php if (get_field('menu-title1')) : ?>
                    <section class="menu-under__sec" id="ramen">
                        <h3 class="menu-under__heading"><?php echo get_field('menu-title1'); ?></h3>
                        <div class="menu-under__inner row">
                            <!-- メニュー1～6 -->
                            <?php for ($i = 1; $i <= 6; $i++): ?>
                                <?php $menu = get_field('menu' . $i); ?>
                                <?php if ($menu): ?>
                                    <dl class="menu-under__card">
                                        <dt class="menu-under__card--name">
                                            <?php if (!empty($menu['menu-name'])): ?>
                                                <?php echo esc_html($menu['menu-name']); ?>
                                            <?php endif; ?>
                                        </dt>
                                        <dd class="menu-under__card--price">
                                            <?php if (!empty($menu['menu-price'])): ?>
                                                <?php echo esc_html($menu['menu-price']); ?>
                                            <?php endif; ?>
                                        </dd>
                                        <dd class="menu-under__card--image">
                                            <?php if (!empty($menu['menu-image']['url'])): ?>
                                                <img decoding=”async” src="<?php echo esc_url($menu['menu-image']['url']); ?>" alt="<?php echo esc_attr($menu['menu-image']['alt']); ?>">
                                            <?php endif; ?>
                                        </dd>
                                        <dd class="menu-under__card--desc">
                                            <?php if (!empty($menu['menu-desc'])): ?>
                                                <?php echo wp_kses_post($menu['menu-desc']); ?>
                                            <?php endif; ?>
                                        </dd>
                                    </dl>
                                <?php endif; ?>
                            <?php endfor; ?>
                        </div>
                    </section>
                <?php endif; ?>
                <?php if (get_field('menu-title2')) : ?>
                    <section class="menu-under__sec" id="rice">
                        <h3 class="menu-under__heading"><?php echo get_field('menu-title2'); ?></h3>
                        <div class="menu-under__inner row">
                            <!-- メニュー7～12 -->
                            <?php for ($i = 7; $i <= 12; $i++): ?>
                                <?php $menu = get_field('menu' . $i); ?>
                                <?php if ($menu): ?>
                                    <dl class="menu-under__card">
                                        <dt class="menu-under__card--name">
                                            <?php if (!empty($menu['menu-name'])): ?>
                                                <?php echo esc_html($menu['menu-name']); ?>
                                            <?php endif; ?>
                                        </dt>
                                        <dd class="menu-under__card--price">
                                            <?php if (!empty($menu['menu-price'])): ?>
                                                <?php echo esc_html($menu['menu-price']); ?>
                                            <?php endif; ?>
                                        </dd>
                                        <dd class="menu-under__card--image">
                                            <?php if (!empty($menu['menu-image']['url'])): ?>
                                                <img decoding=”async” src="<?php echo esc_url($menu['menu-image']['url']); ?>" alt="<?php echo esc_attr($menu['menu-image']['alt']); ?>">
                                            <?php endif; ?>
                                        </dd>
                                        <dd class="menu-under__card--desc">
                                            <?php if (!empty($menu['menu-desc'])): ?>
                                                <?php echo wp_kses_post($menu['menu-desc']); ?>
                                            <?php endif; ?>
                                        </dd>
                                    </dl>
                                <?php endif; ?>
                            <?php endfor; ?>
                        </div>
                    </section>
                <?php endif; ?>
                <?php if (get_field('menu-title3')) : ?>
                    <section class="menu-under__sec" id="side-menu">
                        <h3 class="menu-under__heading"><?php echo get_field('menu-title3'); ?></h3>
                        <div class="menu-under__inner row">
                            <!-- メニュー13～18 -->
                            <?php for ($i = 13; $i <= 18; $i++): ?>
                                <?php $menu = get_field('menu' . $i); ?>
                                <?php if ($menu): ?>
                                    <dl class="menu-under__card">
                                        <dt class="menu-under__card--name">
                                            <?php if (!empty($menu['menu-name'])): ?>
                                                <?php echo esc_html($menu['menu-name']); ?>
                                            <?php endif; ?>
                                        </dt>
                                        <dd class="menu-under__card--price">
                                            <?php if (!empty($menu['menu-price'])): ?>
                                                <?php echo esc_html($menu['menu-price']); ?>
                                            <?php endif; ?>
                                        </dd>
                                        <dd class="menu-under__card--image">
                                            <?php if (!empty($menu['menu-image']['url'])): ?>
                                                <img decoding=”async” src="<?php echo esc_url($menu['menu-image']['url']); ?>" alt="<?php echo esc_attr($menu['menu-image']['alt']); ?>">
                                            <?php endif; ?>
                                        </dd>
                                        <dd class="menu-under__card--desc">
                                            <?php if (!empty($menu['menu-desc'])): ?>
                                                <?php echo wp_kses_post($menu['menu-desc']); ?>
                                            <?php endif; ?>
                                        </dd>
                                    </dl>
                                <?php endif; ?>
                            <?php endfor; ?>
                        </div>
                    </section>
                <?php endif; ?>
                <?php if (get_field('menu-title4')) : ?>
                    <section class="menu-under__sec">
                        <h3 class="menu-under__heading"><?php echo get_field('menu-title4'); ?></h3>
                        <div class="menu-under__inner row">
                            <!-- メニュー19～24 -->
                            <?php for ($i = 19; $i <= 24; $i++): ?>
                                <?php $menu = get_field('menu' . $i); ?>
                                <?php if ($menu): ?>
                                    <dl class="menu-under__card">
                                        <dt class="menu-under__card--name">
                                            <?php if (!empty($menu['menu-name'])): ?>
                                                <?php echo esc_html($menu['menu-name']); ?>
                                            <?php endif; ?>
                                        </dt>
                                        <dd class="menu-under__card--price">
                                            <?php if (!empty($menu['menu-price'])): ?>
                                                <?php echo esc_html($menu['menu-price']); ?>
                                            <?php endif; ?>
                                        </dd>
                                        <dd class="menu-under__card--image">
                                            <?php if (!empty($menu['menu-image']['url'])): ?>
                                                <img decoding=”async” src="<?php echo esc_url($menu['menu-image']['url']); ?>" alt="<?php echo esc_attr($menu['menu-image']['alt']); ?>">
                                            <?php endif; ?>
                                        </dd>
                                        <dd class="menu-under__card--desc">
                                            <?php if (!empty($menu['menu-desc'])): ?>
                                                <?php echo wp_kses_post($menu['menu-desc']); ?>
                                            <?php endif; ?>
                                        </dd>
                                    </dl>
                                <?php endif; ?>
                            <?php endfor; ?>
                        </div>
                    </section>
                <?php endif; ?>
            </div>
            <aside class="menu-right-column">
                <div class="sticky-navi">
                    <ul class="row">
                        <li><a href="#ramen"><span><?php echo get_field('side1'); ?></span><img decoding=”async” src="<?php echo esc_url(get_theme_file_uri('/images/ramen_illustration.png')); ?>"
                                    alt="<?php echo get_field('side1'); ?>"></a></li>
                        <li><a href="#rice"><span><?php echo get_field('side2'); ?></span><img decoding=”async” src="<?php echo esc_url(get_theme_file_uri('/images/rice_illustration.png')); ?>" alt="<?php echo get_field('side2'); ?>"></a>
                        </li>
                        <li><a href="#side-menu"><span><?php echo get_field('side3'); ?></span><img decoding=”async” src="<?php echo esc_url(get_theme_file_uri('/images/sidemenu_illustration.png')); ?>"
                                    alt="<?php echo get_field('side3'); ?>"></a></li>
                    </ul>
                </div>
            </aside>
        </div>
    </section>
</main>
<?php get_footer(); ?>