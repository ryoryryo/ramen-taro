<?php
/*
Template Name: ホーム
*/

get_header(); ?>
<main>
    <div class="home-mv__wrapper">
        <span class="home-mv__wrapper--video">
            <video muted loop>
                <source src="<?php echo esc_url(get_theme_file_uri('/images/mv-movie.mp4')); ?>" media="(min-width: 1024px)" type="video/mp4">
                <source src="<?php echo esc_url(get_theme_file_uri('/images/mv-movie-sp.mp4')); ?>" media="(max-width: 1023px)" type="video/mp4">
            </video>
        </span>
        <div class="home-mv__main--title">
            <p class="top"> <span><?php echo get_field('top-word1'); ?></span> <span><?php echo get_field('top-word2'); ?></span> <span><?php echo get_field('top-word3'); ?></span> <span><?php echo get_field('top-word4'); ?></span> <span><?php echo get_field('top-word5'); ?></span>
                <span><?php echo get_field('top-word6'); ?></span>
                <span><?php echo get_field('top-word7'); ?></span> <span><?php echo get_field('top-word8'); ?></span>
            </p>
            <p class="bottom"> <span><?php echo get_field('bottom-word1'); ?></span> <span><?php echo get_field('bottom-word2'); ?></span> <span><?php echo get_field('bottom-word3'); ?></span> <span><?php echo get_field('bottom-word4'); ?></span> <span><?php echo get_field('bottom-word5'); ?></span>
                <span><?php echo get_field('bottom-word6'); ?></span>
                <span><?php echo get_field('bottom-word7'); ?></span> <span><?php echo get_field('bottom-word8'); ?></span> <span><?php echo get_field('bottom-word9'); ?></span> <span><?php echo get_field('bottom-word10'); ?></span>
            </p>
        </div>
        <div class="home-mv__sub--title">
            <p><?php echo get_field('sub-text1'); ?></p>
            <p><?php echo get_field('sub-text2'); ?></p>
        </div>
        <div class="home-mv__emblem">
            <div>Driven*by*ramen*</div>
        </div>
    </div>
    <div class="home-back-ground">
        <section class="home-blog__sec">
            <span class="sakura"></span>
            <span class="home-blog__sec--info"><?php echo get_field('text1'); ?></span>
            <div class="home-blog__wrapper wrapper">
                <h2><?php echo get_field('heading1'); ?></h2>
                <div class="home-blog__box">
                    <ul>
                        <li>
                            <?php
                            $args = array(
                                'post_type' => 'post',
                                'posts_per_page' => 5,
                                'orderby' => 'date',
                                'order' => 'DESC',
                            );

                            $query = new WP_Query($args);

                            if ($query->have_posts()) :
                                while ($query->have_posts()) :
                                    $query->the_post();
                            ?>
                                    <a href="<?php the_permalink(); ?>">
                                        <dl class="row">
                                            <dt>
                                                ・<?php the_time('Y年n月j日'); ?>
                                                <br class="sp-newline">
                                                <?php
                                                $categories = get_the_category();
                                                if (!empty($categories)) {
                                                    foreach ($categories as $category) {
                                                        $category_class = 'category-' . esc_html($category->slug);
                                                        echo '<span class="home-blog__box--category ' . esc_attr($category_class) . '">' . esc_html($category->name) . '</span> ';
                                                    }
                                                }
                                                ?>
                                            </dt>
                                            <dd>
                                                <?php
                                                $title = get_the_title();
                                                $max_length = 50; // 最大文字数をバイトで制限する
                                                $title = mb_strimwidth($title, 0, $max_length, '...', 'UTF-8');
                                                echo esc_html($title);
                                                ?>
                                            </dd>
                                        </dl>
                                    </a>
                            <?php endwhile;
                            endif; ?>
                            <?php wp_reset_postdata(); ?>
                        </li>
                    </ul>
                    <a class="home-blog__btn" href="<?php echo esc_url(home_url('/announcements/')) . $url_lang; ?>"><?php echo get_field('button1'); ?></a>
                </div>
            </div>
        </section>
        <section class="home-introduction__sec">
            <div class="home-introduction__back-image">
                <div class="home-introduction__wrapper wrapper">
                    <div class="home-headline hh1">
                        <h2><?php echo get_field('heading2'); ?></h2>
                    </div>
                    <div class="home-introduction__grid">
                        <div class="home-introduction__grid--image big-image fade-up-order"> <img decoding="async"
                                src="<?php echo esc_url(get_theme_file_uri('/images/kitchen1.jpg')); ?>" alt="image">
                            <div>
                                <p><?php echo get_field('textarea1'); ?></p>
                            </div>
                        </div>
                        <div class="home-introduction__grid--image fade-up-order"> <img decoding="async" src="<?php echo esc_url(get_theme_file_uri('/images/ramen8.jpg')); ?>"
                                alt="image">
                            <div>
                                <p><?php echo get_field('textarea2'); ?></p>
                            </div>
                        </div>
                        <div class="home-introduction__grid--image fade-up-order"> <img decoding="async" src="<?php echo esc_url(get_theme_file_uri('/images/chef1.jpg')); ?>"
                                alt="image">
                            <div>
                                <p><?php echo get_field('textarea3'); ?></p>
                            </div>
                        </div>
                        <div class="home-introduction__grid--image fade-up-order"> <img decoding="async" src="<?php echo esc_url(get_theme_file_uri('/images/shop1.jpg')); ?>"
                                alt="image">
                            <div>
                                <p><?php echo get_field('textarea4'); ?></p>
                            </div>
                        </div>
                        <div class="home-introduction__grid--image fade-up-order"> <img decoding="async" src="<?php echo esc_url(get_theme_file_uri('/images/ramen7.png')); ?>"
                                alt="image">
                            <div>
                                <p><?php echo get_field('textarea5'); ?></p>
                            </div>
                        </div>
                    </div>
                    <div class="home-introduction__sentence">
                        <p><?php echo get_field('textarea6'); ?></p>
                        <div class="flash-emblem">
                            <object type="image/svg+xml" data="<?php echo esc_url(get_theme_file_uri('images/taro-emblem-02.svg')); ?>"></object>
                            <div class="flash-emblem-mask">
                                <div class="flash-emblem-light"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="home-slider fade-up">
                    <ul class="swiper-wrapper">
                        <li class="swiper-slide"> <img decoding="async" src="<?php echo esc_url(get_theme_file_uri('/images/ramen1.jpg')); ?>" alt="image"> </li>
                        <li class="swiper-slide"> <img decoding="async" src="<?php echo esc_url(get_theme_file_uri('/images/ramen5.png')); ?>" alt="image"> </li>
                        <li class="swiper-slide"> <img decoding="async" src="<?php echo esc_url(get_theme_file_uri('images/unknownfood2.jpg')); ?>" alt="image"> </li>
                        <li class="swiper-slide"> <img decoding="async" src="<?php echo esc_url(get_theme_file_uri('/images/ramen3.jpg')); ?>" alt="image"> </li>
                        <li class="swiper-slide"> <img decoding="async" src="<?php echo esc_url(get_theme_file_uri('/images/ramen4.png')); ?>" alt="image"> </li>
                        <li class="swiper-slide"> <img decoding="async" src="<?php echo esc_url(get_theme_file_uri('/images/dotedon.jpg')); ?>" alt="image"> </li>
                    </ul>
                </div>
            </div>
        </section>
        <section class="home-process__sec">
            <div class="back-image">
                <div class="home-headline wrapper other">
                    <h2><?php echo get_field('heading2'); ?></h2>
                </div>
            </div>
            <div class="home-process__wrapper ">
                <div class="home-process__inner wrapper">
                    <div class="pin-area">
                        <div class="home-process__box">
                            <h3 class="home-process__heading"><img src=<?php echo esc_url(get_theme_file_uri('/images/taros-feature01.png')); ?>
                                    alt="taros-feature01"></h3>
                            <div class="home-process__content">
                                <div class="home-process__image"> <img decoding="async"
                                        src="<?php echo esc_url(get_theme_file_uri('/images/home-process2.png')); ?>" alt="image">
                                </div>
                                <dl class="home-process__desc row" style="transition-delay: .3s;">
                                    <dt><?php echo get_field('text2'); ?></dt>
                                    <dd><?php echo get_field('textarea7'); ?></dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                    <div class="pin-area">
                        <div class="home-process__box">
                            <h3 class="home-process__heading"><img src=<?php echo esc_url(get_theme_file_uri('/images/taros-feature02.png')); ?>
                                    alt="taros-feature02"></h3>
                            <div class="home-process__content box-bottom">
                                <div class="home-process__image"> <img decoding="async" src="<?php echo esc_url(get_theme_file_uri('/images/home-process1.png')); ?>" alt="image"> </div>
                                <dl class="home-process__desc row" style="transition-delay: .3s;">
                                    <dt><?php echo get_field('text3'); ?></dt>
                                    <dd><?php echo get_field('textarea8'); ?></dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                </div>
        </section>
        <div class="row-scroll-container">
            <div class="row-scroll-inner">
                <div class="row-scroll-text"><?php echo get_field('text4'); ?></div>
            </div>
        </div>
        <div class="home-sv__sec">
            <div class="home-sv__wrapper"> <span>
                </span>
                <div class="home-sv__phrase"><?php echo get_field('text5'); ?></div>
            </div>
        </div>
        <div class="home-welcome__sec"> <span>
            </span>
            <div class="home-welcome__wrapper wrapper">
                <div class="sticky-text">
                    <div><?php echo get_field('text6'); ?></div>
                </div>
            </div>
            <div class="home-welcome__image row">
                <div class="home-welcome__image--inner"> <img decoding="async" src="<?php echo esc_url(get_theme_file_uri('/images/manekineko.png')); ?>" alt="image"> </div>
            </div>
        </div>
    </div>
</main>
<?php get_footer(); ?>