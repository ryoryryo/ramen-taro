<?php
/*
Template Name: phpメール送信完了画面
*/
?>

<?php get_header(); ?>

<main>
    <div class="thanks__wrapper wrapper">
        <div class="thanks__inner">
            <p>メールを受け付けました</p>
            <p>受付自動返信メールが送信されます</p>
            <a href="<?php echo esc_url(home_url('/php_mail/' . $url_lang)); ?>">もどる</a>
        </div>
    </div>
</main>

<?php get_footer(); ?>