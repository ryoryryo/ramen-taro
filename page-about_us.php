<?php
/*
Template Name: お店について
*/

get_header(); ?>

<div class="about-bg"></div>
<div id="luxy">
    <main>
        <div class="about-top__wrapper wrapper luxy-el" data-horizontal='1' data-speed-y="30" data-speed-x="2"
            data-offset="0">
            <div class="about-top__image luxy-el" data-speed-y="15" data-offset="0">
                <img decoding=”async” src="<?php echo esc_url(get_theme_file_uri('/images/ramen5.png')); ?>" alt="location">
            </div>
            <h2 class="about-top__heading luxy-el" data-speed-y="15"><?php echo get_field('title'); ?></h2>
            <div class="about-top__text luxy-el" data-horizontal='1' data-speed-y="10" data-speed-x="-5" data-offset="0">
                <?php echo get_field('text1'); ?> </div>
            <span class="scroll-pointer luxy-el" data-horizontal='1' data-speed-y="-15" data-speed-x="-10" data-offset="0">scroll</span>
        </div>
        <div class="about-history__sec">
            <div class="about-history__wrapper wrapper">
                <dl class="about-history__text fade-up">
                    <dt><?php echo get_field('text2'); ?></dt>
                    <dd><?php echo get_field('textarea1'); ?></dd>
                </dl>
                <div class="about-history__image luxy-el" data-horizontal='1' data-speed-y="-10" data-speed-x="-5"
                    data-offset="0"> <img decoding=”async” src="<?php echo esc_url(get_theme_file_uri('/images/place.jpg')); ?>" alt="history"> </div>
                <div class="about-history__image luxy-el" data-horizontal='1' data-speed-y="-15" data-speed-x="5"
                    data-offset="0"> <img decoding=”async” src="<?php echo esc_url(get_theme_file_uri('/images/shop2.jpg')); ?>" alt="history"> </div>
            </div>


            <dl class="about-history__chronology wrapper row fade-up">
                <?php for ($i = 1; $i <= 10; $i++): ?>
                    <?php $history = get_field('history' . $i); ?>
                    <?php if ($history): ?>
                        <?php if (!empty($history['time'])): ?>
                            <dt><?php echo esc_html($history['time']); ?></dt>
                        <?php endif; ?>

                        <?php if (!empty($history['text'])): ?>
                            <dd><?php echo esc_html($history['text']); ?></dd>
                        <?php endif; ?>
                    <?php endif; ?>
                <?php endfor; ?>
            </dl>

            <div class="about-history__image bottom luxy-el" data-horizontal='1' data-speed-y="-5" data-speed-x="-1"
                data-offset="0"> <img decoding=”async” src="<?php echo esc_url(get_theme_file_uri('/images/ramen8.jpg')); ?>" alt="history"> </div>
        </div>
        <div class="about-owner__sec">
            <div class="about-owner__wrapper wrapper">
                <div class="about-owner__image luxy-el" data-horizontal='1' data-speed-y="1" data-speed-x="1"
                    data-offset="0"> <img decoding=”async” src="<?php echo esc_url(get_theme_file_uri('/images/chef4.jpg')); ?>" alt="owner"> </div>
                <div class="about-owner__comment fade-up luxy-el" data-speed-y="-1" data-offset="0">
                    <p><?php echo get_field('textarea2'); ?></p>
                    <div><?php echo get_field('text3'); ?></div>
                </div>
            </div>
        </div>
    </main>
    <?php get_footer(); ?>