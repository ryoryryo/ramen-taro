<?php
global $url_lang;
global $parent_slug;
?>
<footer>
    <div class="footer__wrapper wrapper">
        <div class="footer__logo">
            <a href="<?php echo esc_url(home_url('/home/' . $url_lang)); ?>">
                <div><img decoding=”async” src="<?php echo esc_url(get_theme_file_uri('/images/logo_white.png')); ?>" alt="らーめんたろう"></div>
            </a>
        </div>
        <div class="footer__navi">
            <ul>
                <li> <a href="<?php echo esc_url(home_url('/about_us/' . $url_lang)); ?>"><?php navi_titles('about_us'); ?></a> </li>
                <li> <a href="<?php echo esc_url(home_url('/menu/' . $url_lang)); ?>"><?php navi_titles('menu'); ?></a> </li>
                <li> <a href="<?php echo esc_url(home_url('/shop/' . $url_lang)); ?>"><?php navi_titles('shop'); ?></a> </li>
                <li> <a href="<?php echo esc_url(home_url('/inquiry/' . $url_lang)); ?>"><?php navi_titles('inquiry'); ?></a> </li>
            </ul>
        </div>
    </div> <small>© Driven by ramen</small>
</footer>
<!-- about_usのとき<div id="luxy">の閉じタグを付与 -->
<?php
if (is_page('about_us') || $parent_slug == 'about_us') {
    echo '</div>';
}
?>
<a class="scroll-up">
    <span>SCROLL
        <br>TOP</span>
</a>

<?php
if (is_singular('shop_detail')) {
?>
    <div class="pdf-modal">
        <div class="pdf-viewer">
            <div class="pdf-container">
                <div class="pdf-canvas"></div>
            </div>
        </div>
        <div class="close-button">
            <img decoding=”async” src="<?php echo esc_url(get_theme_file_uri('/images/close-button.png')); ?>" alt="close-button">
        </div>
    </div>
<?php
}
?>

<?php wp_footer(); ?>

</body>

</html>