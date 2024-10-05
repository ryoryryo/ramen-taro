<?php
/*
Template Name: 店舗一覧
*/

get_header(); ?>
<main>
    <section>
        <div class="shop__wrapper">
            <div class="row">
                <div class="shop__map">
                    <div class="shop-map-sticky"> <span id="google-map"></span> </div>
                </div>
                <div class="shop__container row">
                    <div class="shop__sticky">
                        <h2><?php echo get_field('title'); ?></h2>
                    </div>
                    <?php
                    $args = array(
                        'post_type' => 'shop_detail',
                        'orderby' => 'date',
                        'order' => 'ASC',
                        'posts_per_page' => -1,
                        'tax_query' => array(
                            array(
                                'taxonomy' => 'lang_category', // カスタムタクソノミーのスラッグ
                                'field'    => 'slug',
                                'terms'    => $current_lang, // 現在の言語カテゴリーのスラッグを使用
                            ),
                        ),
                    );
                    $the_query = new WP_Query($args);
                    ?>
                    <?php if ($the_query->have_posts()) : ?>
                        <?php while ($the_query->have_posts()) : $the_query->the_post(); ?>


                            <div class="shop__box" id="<?php the_field('shop-id'); ?>">
                                <div class="shop__name">
                                    <div><a href="<?php echo get_permalink(); ?>">
                                            <?php the_field('shop-name'); ?></a></div> <span></span>
                                </div>
                                <dl>
                                    <dt>address:</dt>
                                    <dd>
                                        <?php the_field('shop-address'); ?>
                                    </dd>
                                    <dt>tel:</dt>
                                    <dd>
                                        &nbsp;<?php the_field('shop-tel'); ?>
                                    </dd>
                                </dl>
                                <div class="btn-box"> <a href="<?php echo get_permalink(); ?>"><span>
                                            <span><?php echo get_field('button1'); ?></span>
                                            <span><?php echo get_field('button1'); ?></span>
                                            <span><?php echo get_field('button1'); ?></span>
                                            <span><?php echo get_field('button1'); ?></span>
                                            <span><?php echo get_field('button1'); ?></span>
                                            <span><?php echo get_field('button1'); ?></span>
                                        </span></a></div>
                            </div>
                        <?php endwhile; ?>
                        <?php wp_reset_postdata(); ?>
                    <?php endif; ?>

                    <p class="attention">※Google Maps JavaScript APIを使用しています</p>
                    <p class="attention">カスタム投稿で店舗の追加削除、カスタムフィールドで店舗情報の追加削除が管理画面からできます</p>
                </div>
            </div>
        </div>
    </section>
</main>

<?php get_footer(); ?>

<script>
    function initMap() {
        //店舗のカスタムフィールド情報ループ
        const shopData = [
            <?php if ($the_query->have_posts()) : ?>
                <?php while ($the_query->have_posts()) : $the_query->the_post(); ?> {
                        name: "<?php the_field('shop-name'); ?>",
                        lat: <?php the_field('shop-lat'); ?>,
                        lng: <?php the_field('shop-lng'); ?>,
                        image: "<?php the_field('shop-image'); ?>",
                        id: "<?php the_field('shop-id'); ?>"
                    },
                <?php endwhile; ?>
                <?php wp_reset_postdata(); ?>
            <?php endif; ?>

        ];
        let marker = [];
        let infoWindow = [];
        let currentInfoWindow = null;
        const map = new google.maps.Map(document.getElementById('google-map'), {
            zoom: 5.5,
            center: {
                lat: 37.0472703,
                lng: 136.5436676
            }
        });
        for (let i = 0; i < shopData.length; i++) {
            let shopLatLng = {
                lat: shopData[i]["lat"],
                lng: shopData[i]["lng"]
            };
            marker[i] = new google.maps.Marker({
                position: shopLatLng,
                map: map,
                icon: "<?php echo esc_url(get_theme_file_uri('images/marker.png')); ?>"
            });
            infoWindow[i] = new google.maps.InfoWindow({ // 吹き出しの追加
                content: `<div class="marker"><p>${shopData[i]['name']}</p><img decoding=”async” src="${shopData[i]["image"]}" alt="#"></div>` // 吹き出しに表示する内容
            });
            marker[i].addListener('click', function() { // マーカーをクリックしたとき
                if (currentInfoWindow) {
                    currentInfoWindow.close();
                }
                infoWindow[i].open(map, marker[i]); // 吹き出しの表示    
                currentInfoWindow = infoWindow[i]; //開いた情報ウィンドウを記録しておく
                //ウィンドウが1024px以上のときのみスクロール機能
                if (window.innerWidth >= 1024) {
                    let scrollId = document.getElementById(shopData[i]["id"]);
                    const scrollPosition = scrollId.offsetTop;
                    window.scrollTo({
                        top: scrollPosition,
                        behavior: 'smooth'
                    });
                    scrollId.classList.add("shop-name-shine");
                    setTimeout(() => {
                        scrollId.classList.remove("shop-name-shine");
                    }, "4000")
                }
            });
        }
    }
</script>
<script async defer src="[MY_GOOGLE_API_KEY]&callback=initMap"></script>
