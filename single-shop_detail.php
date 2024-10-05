<?php
/*
Template Name: 店舗詳細
Template Post Type:shop_detail
*/

get_header(); ?>
<main>
    <span class="oblique-line"></span> <span class="oblique-line"></span> <span class="oblique-line"></span> <span
        class="oblique-line"></span>
    <div class="shop-detail__wrapper wrapper">
        <h2><?php the_field('shop-name'); ?></h2>
        <?php if ($pdf_file = get_field('pdf-file')) { ?>
            <a href="javascript:void(0);" class="shop-detail__menu-pdf"
                data-pdf-link="<?php echo esc_url($pdf_file['url']); ?>">
                <?php the_field('pdf-button'); ?>
            </a>
        <?php } ?>
        <p>管理画面からPDFファイルのアップロードが可能です</p>
        <div class="shop-detail__inner">
            <div class="shop-detail__top row">
                <div class="shop-detail__map"> <iframe
                        src="<?php the_field('shop-map'); ?>"
                        width="400" height="300" style="border:0;" allowfullscreen="" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"></iframe> </div>
                <table class="shop-detail__table">
                    <tr style="border-bottom: 1px solid black;">
                        <td style="border-right: 1px solid black;"><?php the_field('text1'); ?></td>
                        <td><?php the_field('shop-time'); ?></td>
                    </tr>
                    <tr style="border-bottom: 1px solid black;">
                        <td style="border-right: 1px solid black;"><?php the_field('text2'); ?></td>
                        <td><?php the_field('shop-holiday'); ?></td>
                    </tr>
                    <tr style="border-bottom: 1px solid black;">
                        <td style="border-right: 1px solid black;"><?php the_field('text3'); ?></td>
                        <td><?php the_field('shop-address'); ?></td>
                    </tr>
                    <tr>
                        <td style="border-right: 1px solid black;"><?php the_field('text4'); ?></td>
                        <td><?php the_field('shop-tel'); ?></td>
                    </tr>
                </table>
            </div>
            <div class="shop-detail__grid">
                <div class="shop--detail__grid--image"> <img decoding=”async” src="<?php echo esc_url(get_theme_file_uri('/images/shop-detail1.jpg')); ?>" alt="shop-image"> </div>
                <div class="shop--detail__grid--image"> <img decoding=”async” src="<?php echo esc_url(get_theme_file_uri('/images/shop-detail3.jpg')); ?>" alt="shop-image"> </div>
                <div class="shop--detail__grid--image"> <img decoding=”async” src="<?php echo esc_url(get_theme_file_uri('/images/shop-detail2.jpg')); ?>" alt="shop-image"> </div>
                <div class="shop--detail__grid--image"> <img decoding=”async” src="<?php echo esc_url(get_theme_file_uri('/images/shop-detail4.jpg')); ?>" alt="shop-image"> </div>
                <div class="shop--detail__grid--image"> <img decoding=”async” src="<?php echo esc_url(get_theme_file_uri('/images/shop-detail5.jpg')); ?>" alt="shop-image"> </div>
                <div class="shop--detail__grid--image"> <img decoding=”async” src="<?php echo esc_url(get_theme_file_uri('/images/shop-detail6.jpg')); ?>" alt="shop-image"> </div>
            </div>
        </div>
    </div>
</main>

<?php get_footer(); ?>