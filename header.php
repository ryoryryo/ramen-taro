<?php
global $current_lang;
global $url_lang;

$terms = get_the_terms(get_the_ID(), 'lang_category');  // 'lang_category' はカスタムタクソノミーのスラッグ
$current_lang = '';

if ($terms && !is_wp_error($terms)) {
    $current_lang = $terms[0]->slug;
}
if ($current_lang === 'ja' || $current_lang === '') {
    $url_lang = '';
} else {
    $url_lang = $current_lang . '/';
}
// -----------------------------------------------------------------------------
// 親ページと子ページの情報を取得する関数
function get_page_info($post_id)
{
    // 現在の投稿IDから親ページを取得
    $parent_id = wp_get_post_parent_id($post_id);

    if (!$parent_id) {
        $parent_id = $post_id;  // 現在のページが親ページの場合
    }

    $parent_slug = get_post_field('post_name', $parent_id);  // 親ページまたは現在ページのスラッグ

    // URLとカテゴリースラッグ、カテゴリー名を格納する配列
    $urls_and_categories = array();

    // 親ページの情報を取得
    $parent_url = get_permalink($parent_id);
    $parent_category_info = get_page_category_info($parent_id);  // カテゴリーのスラッグと名前を取得
    $urls_and_categories[] = array(
        'url' => $parent_url,
        'category_slug' => $parent_category_info['slug'],
        'category_name' => $parent_category_info['name']
    );

    // 固定ページまたは投稿タイプの子ページの情報を取得
    if (get_post_type($post_id) === 'page') {
        // 固定ページの場合
        $child_pages = get_pages(array(
            'child_of' => $parent_id,
            'sort_column' => 'menu_order',
        ));
    } else {
        // 投稿タイプの場合
        $child_pages = get_posts(array(
            'post_type' => get_post_type($post_id), // 現在の投稿タイプに合わせる
            'post_parent' => $parent_id,
            'posts_per_page' => -1,
            'orderby' => 'menu_order',
        ));
    }

    foreach ($child_pages as $child_page) {
        $child_url = get_permalink($child_page->ID);
        $child_category_info = get_page_category_info($child_page->ID);
        $urls_and_categories[] = array(
            'url' => $child_url,
            'category_slug' => $child_category_info['slug'],
            'category_name' => $child_category_info['name']
        );
    }

    return array(
        'urls_and_categories' => $urls_and_categories,
        'parent_slug' => $parent_slug
    );
}

$result = get_page_info(get_the_ID());
// -----------------------------------------------------------------------------
// ページのカテゴリー情報を取得
function get_page_category_info($post_id)
{
    $terms = get_the_terms($post_id, 'lang_category');  // 'lang_category' はカスタムタクソノミー
    if ($terms && !is_wp_error($terms)) {
        return array(
            'slug' => $terms[0]->slug,
            'name' => $terms[0]->name
        );
    }
    return array('slug' => '', 'name' => '');
}

// ナビ部分のタイトル出力関数
function navi_titles($parent_slug)
{
    global $current_lang;

    // 親ページの情報を取得
    $parent = get_page_by_path($parent_slug);

    if ($parent) {
        // 親ページが見つかった場合
        if ($current_lang === 'ja' || $current_lang === '') {
            // 日本語の場合、親ページのタイトルを表示
            echo $parent->post_title;
        } else {
            // その他の言語の場合、子ページを表示
            $args = array(
                'post_type'      => 'page',
                'post_parent'    => $parent->ID,
                'posts_per_page' => -1,
                'tax_query'      => array(
                    array(
                        'taxonomy' => 'lang_category',
                        'field'    => 'slug',
                        'terms'    => $current_lang,
                    ),
                ),
            );
            $child_pages = get_posts($args);

            // 子ページが見つかった場合、タイトルを表示
            if (!empty($child_pages)) {
                foreach ($child_pages as $child_page) {
                    echo $child_page->post_title;
                }
            } else {
                // 子ページが見つからない場合
                echo 'no page';
            }
        }
    } else {
        // 親ページが見つからない場合
        echo 'no page';
    }
}
// ----------------------------------------------------------------------
// menuページ　ACF フィールド 'menu-title' の値を取得
function display_menu_title_from_same_category($menu_title_param)
{
    global $post;

    // 現在ページのカスタムカテゴリー 'lang_category' を取得
    $terms = get_the_terms($post->ID, 'lang_category');

    // カスタムカテゴリーがない場合、'ja' スラッグをデフォルトに設定
    if ($terms && !is_wp_error($terms)) {
        $current_category_slug = $terms[0]->slug;
    } else {
        $current_category_slug = 'ja'; // カスタムカテゴリーがない場合のデフォルト値
    }

    // 現在ページと同じカスタムカテゴリーに属するページを取得
    $args = array(
        'post_type' => 'page',
        'posts_per_page' => -1,
        'tax_query' => array(
            array(
                'taxonomy' => 'lang_category', // カスタムタクソノミー 'lang_category'
                'field'    => 'slug',
                'terms'    => $current_category_slug, // 現在ページのカテゴリーと一致、もしくは 'ja'
            ),
        ),
        'meta_query' => array(
            array(
                'key' => '_wp_page_template',  // ページテンプレートのメタキー
                'value' => 'page-menu.php',    // 'page-menu.php' テンプレートを使用しているページ
            ),
        ),
    );
    $pages = get_posts($args);

    // 同じカテゴリーに属するページが見つかった場合
    if ($pages) {
        foreach ($pages as $page) {
            // ACF フィールド 'menu-title' の値を取得
            $menu_title = get_field($menu_title_param, $page->ID);

            if ($menu_title) {
                // フィールドの値を表示
                echo esc_html($menu_title);
            } else {
                echo '<p>No menu title found.</p>';
            }
        }
    } else {
        echo '<p>No pages found</p>';
    }
}

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php
            if (is_front_page() || is_home()) {
                echo bloginfo('name');
            } else {
                echo bloginfo('name') . ' - ' . get_the_title();
            }
            ?></title>
    <meta name="description" content="<?php bloginfo('description'); ?>">
    <link rel="icon" href="<?php echo esc_url(get_theme_file_uri('/images/logo.png')); ?>" sizes="16x16" type="images/logo.png">
    <link rel="icon" href="<?php echo esc_url(get_theme_file_uri('/images/logo.png')); ?>" sizes="32x32" type="images/logo.png">
    <link rel="icon" href="<?php echo esc_url(get_theme_file_uri('/images/logo.png')); ?>" sizes="48x48" type="images/logo.png">
    <link rel="icon" href="<?php echo esc_url(get_theme_file_uri('/images/logo.png')); ?>" sizes="62x62" type="images/logo.png">
    <link rel="apple-touch-icon-precomposed" href="<?php echo esc_url(get_theme_file_uri('/images/logo.png')); ?>">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <!-- hreflnag指定 -->
    <?php
    foreach ($result['urls_and_categories'] as $item) {
        // カテゴリーが 'zh-cn' のときは 'zh-Hans'、'zh-tw' のときは 'zh-Hant' に置き換え
        $hreflang = $item['category_slug'];

        if ($hreflang === 'zh-cn') {
            $hreflang = 'zh-Hans';
        } elseif ($hreflang === 'zh-tw') {
            $hreflang = 'zh-Hant';
        }

        // <link rel="alternate"> タグを生成
        echo '<link rel="alternate" href="' . esc_url($item['url']) . '" hreflang="' . esc_attr($hreflang) . '" />' . "\n";
    }

    ?>
    <!-- 検索避け -->
    <meta name="robots" content="noindex,nofollow">
    <meta property="og:site_name" content="<?php echo bloginfo('name'); ?>">
    <meta property="og:type" content="website">
    <meta property="og:title" content="<?php echo bloginfo('name'); ?> -<?php the_title() ?>">
    <meta property="og:image" content="<?php echo esc_url(get_theme_file_uri('/images/logo.png')); ?>">
    <meta property="og:locale" content="ja_JP">

    <?php wp_head(); ?>

</head>

<?php
$slug = $result['parent_slug'];
if (is_singular('shop_detail')) {
    $slug = 'shop_detail';
}
if (is_singular('post')) {
    $slug = 'post';
}
?>

<body id="<?php echo $slug; ?>">

    <?php wp_body_open(); ?>

    <!-- フロントページのみローディング -->
    <?php
    $parent_id = wp_get_post_parent_id(get_the_ID()); // 親ページのIDを取得
    $parent_slug = $parent_id ? get_post_field('post_name', $parent_id) : ''; // 親ページのスラッグを取得
    if (is_front_page() || is_page('home') || $parent_slug == 'home') {
        echo '<div class="loading">
        <p>Driven by ramen</p> <i class="loading-icon"></i>
    </div>';
    }
    ?>

    <header>
        <div class="header__wrapper">
            <h1 class="header__logo">
                <a href="<?php echo esc_url(home_url('/home/' . $url_lang)); ?>">
                    <picture>
                        <source class="logo-source" srcset="<?php echo esc_url(get_theme_file_uri('/images/logo_black.png')); ?>" media="(max-width: 576px)">
                        <img decoding=”async” class="logo-img" src="<?php echo esc_url(get_theme_file_uri('/images/logo_white.png')); ?>" alt="らーめんたろう">
                    </picture>
                </a>
            </h1>
            <nav class="header__navi">
                <ul>
                    <li><a href="<?php echo esc_url(home_url('/about_us/' . $url_lang)); ?>">
                            <span><?php navi_titles('about_us'); ?></span>
                            <span>ABOUT US</span>
                        </a></li>
                    <li class="hover-li"><a href="<?php echo esc_url(home_url('/menu/' . $url_lang)); ?>">
                            <span><?php navi_titles('menu'); ?><i class="fa-solid fa-circle-chevron-down"></i></span>
                            <span>MENU</span>
                        </a>
                        <ul class="hover-ul">
                            <li> <a href="<?php echo esc_url(home_url('/menu/' . $url_lang)); ?>#ramen"><?php display_menu_title_from_same_category('menu-title1'); ?></a> </li>
                            <li> <a href="<?php echo esc_url(home_url('/menu/' . $url_lang)); ?>#rice"><?php display_menu_title_from_same_category('menu-title2'); ?></a> </li>
                            <li> <a href="<?php echo esc_url(home_url('/menu/' . $url_lang)); ?>#side-menu"><?php display_menu_title_from_same_category('menu-title3'); ?></a> </li>
                        </ul>
                    </li>
                    <li><a href="<?php echo esc_url(home_url('/shop/' . $url_lang)); ?>">
                            <span><?php navi_titles('shop'); ?></span>
                            <span>SHOPS</span>
                        </a></li>
                    <li><a href="<?php echo esc_url(home_url('/inquiry/' . $url_lang)); ?>">
                            <span><?php navi_titles('inquiry'); ?></span>
                            <span>INQUIRY</span>
                        </a></li>
                </ul>
                <!-- 言語プルダウン -->
                <?php if (!is_singular('post')) { ?>
                    <div class="language-select-box">
                        Language
                        <ul>
                            <?php
                            foreach ($result['urls_and_categories'] as $item) {
                            ?>
                                <li class="<?php if ($current_lang === $item['category_slug']) {
                                                echo 'lang-selected';
                                            } ?>">
                                    <a href="<?php echo esc_url($item['url']); ?>">
                                        <?php echo esc_html($item['category_name']); ?>
                                    </a>
                                </li>
                            <?php
                            }
                            ?>
                        </ul>
                    </div>
                <?php } ?>
            </nav>
            <button class="menu__btn">
                <span></span>
                <span></span>
                <span></span>
            </button>
        </div>
    </header>