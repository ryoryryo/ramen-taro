<?php
/*
Template Name: お問い合わせ
*/

get_header(); ?>
<main>
    <section class="inquiry__sec">
        <div class="inquiry__wrapper">
            <div class="inquiry__background">
                <div class="inquiry__information">
                    <div class="inquiry__information--detail">
                        <div><?php echo get_field('text1'); ?></div>
                        <address><?php echo get_field('textarea1'); ?></address>
                    </div>
                    <div class="inquiry__information--image"></div>
                    <div class="inquiry__information--image"></div>
                </div>
            </div>
            <div class="inquiry-form__wrapper wrapper">
                <span class="back-fragment fg1"></span><span class="back-fragment fg2"></span>
                <h2><?php echo get_field('title'); ?></h2>
                <span class="inquiry-form__wrapper--text">wordpressのContact Form 7を使用しています</span>
                <span class="inquiry-form__wrapper--text">入力されたアドレスに完了メールが自動送信されます</span>
                <a class="inquiry-form__wrapper--link" href="<?php echo esc_url(home_url('/php_mail/')); ?>"><i class="fa-solid fa-circle-chevron-right"></i>PHPメール版はこちら</a>
                <div class="inquiry-form__content wrapper">
                    <?php echo apply_filters('the_content', get_post_meta($post->ID, 'short-code', true)); ?>
                </div>
            </div>
        </div>
    </section>
</main>
<?php get_footer(); ?>