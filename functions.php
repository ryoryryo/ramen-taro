<?php
// style関係読み込み
function enqueueStyles()
{
    // 親ページのIDを取得
    $parent_id = wp_get_post_parent_id(get_the_ID());

    wp_enqueue_style('ress', get_template_directory_uri() . '/style/ress.css');
    wp_enqueue_style('google-font-sawarabi', 'https://fonts.googleapis.com/css?family=Sawarabi+Mincho');

    // フロントページのスタイル
    $home_page = get_page_by_path('home');
    $home_id = $home_page ? $home_page->ID : null;

    if (is_front_page() || is_page('home') || $parent_id == $home_id) {
        wp_enqueue_style('style', get_stylesheet_uri(), array('ress'), false, 'all');
    }

    // about_us または menu ページ、またはその親ページ
    $about_us_page = get_page_by_path('about_us');
    $menu_page = get_page_by_path('menu');
    $about_us_id = $about_us_page ? $about_us_page->ID : null;
    $menu_id = $menu_page ? $menu_page->ID : null;

    if (is_page('about_us') || is_page('menu') || $parent_id == $about_us_id || $parent_id == $menu_id) {
        wp_enqueue_style('style2', get_template_directory_uri() . '/style2.css', array('ress'), false, 'all');
    }

    // shop, shop_detail または inquiry ページ、または、mailページまたはその親ページ
    $shop_page = get_page_by_path('shop');
    $shop_detail_page = get_page_by_path('shop_detail');
    $inquiry_page = get_page_by_path('inquiry');
    $php_mail_page = get_page_by_path('php_mail');
    $shop_id = $shop_page ? $shop_page->ID : null;
    $shop_detail_id = $shop_detail_page ? $shop_detail_page->ID : null;
    $inquiry_id = $inquiry_page ? $inquiry_page->ID : null;
    $php_mail_id = $php_mail_page ? $php_mail_page->ID : null;

    if (is_page('shop') || is_singular('shop_detail') || is_page('inquiry') || is_page('php_mail') || is_page('confirm_mail') || $parent_id == $shop_id || $parent_id == $shop_detail_id || $parent_id == $inquiry_id || $parent_id == $php_mail_id) {
        wp_enqueue_style('style3', get_template_directory_uri() . '/style3.css', array('ress'), false, 'all');
    }

    // お知らせ一覧 ページ、投稿ページ、404ページのスタイル
    $announcements_page = get_page_by_path('announcements');
    $announcements_id = $announcements_page ? $announcements_page->ID : null;
    if (is_page('announcements') || is_singular('post') || is_404() | $parent_id == $announcements_id) {
        wp_enqueue_style('style4', get_template_directory_uri() . '/style4.css', array('ress'), false, 'all');
    }

    // オンライン通販
    $ecommerce_page = get_page_by_path('ecommerce');
    if (is_page('ecommerce')) {
        wp_enqueue_style('style5', get_template_directory_uri() . '/style5.css', array('ress'), false, 'all');
    }

    // フロントページ、ホーム、menuページに対してSwiper CSSを読み込む
    $home_page = get_page_by_path('home');
    $menu_page = get_page_by_path('menu');
    $home_id = $home_page ? $home_page->ID : null;
    $menu_id = $menu_page ? $menu_page->ID : null;
    if (is_front_page() || is_page('home') || is_page('menu') || $parent_id == $home_id || $parent_id == $menu_id) {
        wp_enqueue_style('swiper-css', get_template_directory_uri() . '/style/swiper-bundle.min.css', array('ress'), false, 'all');
    }
}
add_action('wp_enqueue_scripts', 'enqueueStyles');


// script関係読み込み
function enqueueScripts()
{
    $parent_id = wp_get_post_parent_id(get_the_ID());

    wp_enqueue_script('font-awesome', 'https://kit.fontawesome.com/6597216174.js', array(), null, true);

    if (is_front_page() || is_page('home') || is_page('menu') || $parent_id == get_page_by_path('home')->ID || $parent_id == get_page_by_path('menu')->ID) {
        wp_enqueue_script('swiper-js', get_template_directory_uri() . '/script/swiper-bundle.min.js');
    }

    if (is_page('about_us') || $parent_id == get_page_by_path('about_us')->ID) {
        wp_enqueue_script('luxy-script', get_template_directory_uri() . '/plugin/luxy.min.js');
    }
    wp_enqueue_script('script', get_template_directory_uri() . '/script/script.js');
}
add_action('wp_enqueue_scripts', 'enqueueScripts');

// -----------------------------------------------------------------------------------------------------
//カスタム投稿実装、カテゴリー実装（店舗一覧）
function shopDetailCustomPost()
{
    register_post_type('shop_detail', array(
        'labels' => array(
            'name' => '店舗詳細',
            'singular_name' => '店舗詳細',
            'add_new'            => '新規追加',
            'add_new_item'       => '新しい店舗を追加',
            'edit_item'          => '店舗を編集',
            'new_item'           => '新しい店舗',
            'view_item'          => '店舗を表示',
            'search_items'       => '店舗を検索',
            'not_found'          => '店舗が見つかりませんでした',
            'not_found_in_trash' => 'ゴミ箱に店舗が見つかりませんでした',
            'parent_item_colon'  => '',
            'menu_name'          => '店舗詳細'
        ),

        'public'              => true,
        'publicly_queryable'  => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'query_var'           => true,
        'rewrite'             => array('slug' => 'shop_detail'),
        'capability_type'     => 'post',
        'has_archive'         => true,
        'menu_position'       => 5,
        'hierarchical'        => true,
        'supports'            => array('title', 'page-attributes')
    ));
}

add_action('init', 'shopDetailCustomPost');

//カスタム投稿にカテゴリーを実装
function custom_taxonomy_shop()
{
    register_taxonomy(
        'shop_category',
        'shop_detail',
        array(
            'label' => '店舗地域別',
            'rewrite' => array('slug' => 'shop_category'),
            'hierarchical' => true
        )
    );
}
add_action('init', 'custom_taxonomy_shop');
//-----------------------------------------------------------------------------
//カスタムカテゴリーを追加（言語カテゴリー）

function my_custom_category_taxonomy()
{
    $labels = array(
        'name'              => '言語カテゴリー',
        'singular_name'     => '言語カテゴリー',
        'search_items'      => '言語カテゴリーを検索',
        'all_items'         => 'すべての言語カテゴリー',
        'parent_item'       => '親カテゴリー',
        'parent_item_colon' => '親カテゴリー:',
        'edit_item'         => '言語カテゴリーを編集',
        'update_item'       => '言語カテゴリーを更新',
        'add_new_item'      => '新しい言語カテゴリーを追加',
        'new_item_name'     => '新しい言語カテゴリー名',
        'menu_name'         => '言語カテゴリー',
    );

    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,  // 投稿リスト画面に表示
        'query_var'         => true,
        'rewrite'           => array('slug' => 'lang-category'),
        'show_in_rest'      => true,  // ブロックエディター (Gutenberg) で使用可能にする
    );

    register_taxonomy('lang_category', array('page', 'shop_detail', 'post'), $args);
}
add_action('init', 'my_custom_category_taxonomy');

// -----------------------------------------------------------------------------
//contact form 7に確認用メールアドレス機能を追加
add_filter('wpcf7_validate_email', 'wpcf7_text_validation_filter_extend', 11, 2);
add_filter('wpcf7_validate_email*', 'wpcf7_text_validation_filter_extend', 11, 2);
function wpcf7_text_validation_filter_extend($result, $tag)
{
    $type = $tag['type'];
    $name = $tag['name'];
    $_POST[$name] = trim(strtr((string) $_POST[$name], "\n", " "));
    if ('email' == $type || 'email*' == $type) {
        if (preg_match('/(.*)_confirm$/', $name, $matches)) {
            $target_name = $matches[1];
            if ($_POST[$name] != $_POST[$target_name]) {
                if (method_exists($result, 'invalidate')) {
                    $result->invalidate($tag, "確認用のメールアドレスが一致していません");
                } else {
                    $result['valid'] = false;
                    $result['reason'][$name] = '確認用のメールアドレスが一致していません';
                }
            }
        }
    }
    return $result;
}

// -----------------------------------------------------------------
// ブロックエディタ関係
function mytheme_support()
{
    // コアブロックの追加分の CSS を読み込む
    add_theme_support('wp-block-styles');
    // テーマの CSS（style.css）をエディターに読み込む
    //add_editor_style( 'style.css' );
    // add_editor_style() を有効化
    add_theme_support('editor-styles');
    // HTML5 対応を有効化
    add_theme_support('html5', array(
        'style',
        'script'
    ));
    // 埋め込みブロックのレスポンシブを有効化
    add_theme_support('responsive-embeds');
    // 投稿（post）タイプにのみアイキャッチ画像のサポートを追加
    add_theme_support('post-thumbnails', array('post'));
}

add_action('after_setup_theme', 'mytheme_support');

// ---------------------------------------------------------------------
// 固定ページのブロックエディタを消す
function remove_page_block_editor()
{
    remove_post_type_support('page', 'editor');
}
add_action('init', 'remove_page_block_editor');

// ---------------------------------------------------------------------
// shop_detail PDFファイル表示関係
function enqueue_shop_detail_script()
{
    if (is_singular('shop_detail')) {
        // pdf.jsのスクリプトをエンキュー
        wp_enqueue_script('pdfjs-lib', get_template_directory_uri() . '/script/pdf.js', array(), null, true);

        // インラインスクリプトでworkerSrcを設定
        wp_add_inline_script('pdfjs-lib', "pdfjsLib.GlobalWorkerOptions.workerSrc = '" . get_template_directory_uri() . "/script/pdf.worker.js';");

        // カスタムスクリプトをインラインで追加
        $custom_script = "
            document.addEventListener('DOMContentLoaded', function () {
                const pdfViewer = document.querySelector('.pdf-viewer');
                const pdfCanvas = pdfViewer.querySelector('.pdf-canvas');
                const menuPdf = document.querySelectorAll('.shop-detail__menu-pdf');
                const pdfModal = document.querySelector('.pdf-modal');
                const closeButton = document.querySelector('.close-button');

                function openPdfInModal(pdfUrl) {
                    pdfjsLib.getDocument(pdfUrl).promise.then(function (pdfDoc) {
                        pdfCanvas.innerHTML = ''; 
                        for (let pageNum = 1; pageNum <= pdfDoc.numPages; pageNum++) {
                            pdfDoc.getPage(pageNum).then(function (page) {
                                const canvas = document.createElement('canvas');
                                pdfCanvas.appendChild(canvas);
                                const viewport = page.getViewport({ scale: 1.5 });
                                canvas.height = viewport.height;
                                canvas.width = viewport.width;
                                const renderContext = {
                                    canvasContext: canvas.getContext('2d'),
                                    viewport: viewport,
                                };
                                page.render(renderContext);
                            });
                        }
                    });
                }
                function closeModal() {
                    pdfCanvas.innerHTML = ''; 
                    pdfModal.classList.remove('open');
                    closeButton.classList.remove('open');
                }
                menuPdf.forEach(function (link) {
                    link.addEventListener('click', function (e) {
                        e.preventDefault();
                        const pdfLink = this.getAttribute('data-pdf-link');
                        pdfModal.classList.add('open');
                        closeButton.classList.add('open');
                        openPdfInModal(pdfLink);
                    });
                });
                closeButton.addEventListener('click', closeModal);
                pdfModal.addEventListener('click', closeModal);
                pdfViewer.addEventListener('click', function (event) {
                    event.stopPropagation();
                });
            });
        ";

        wp_add_inline_script('pdfjs-lib', $custom_script);
    }
}
add_action('wp_enqueue_scripts', 'enqueue_shop_detail_script');
