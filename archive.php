<?php
/*
Template Name: お知らせ一覧
*/

get_header(); ?>
<main>
    <section class="announcements__sec">
        <div class="announcements-background">
            <div class="announcements__wrapper wrapper">
                <h2 class="announcements__title"><?php echo get_field('title') ?></h2>
                <ul class="announcements__inner">
                    <?php
                    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
                    $args = array(
                        'post_type' => 'post',
                        'posts_per_page' => 5, // 1ページに表示する投稿数を指定
                        'paged' => $paged,
                        'orderby' => 'date',
                        'order' => 'DESC',
                    );
                    $query = new WP_Query($args);
                    if ($query->have_posts()) :
                        while ($query->have_posts()) :
                            $query->the_post();
                    ?>
                            <li class="announcements__content">
                                <a href="<?php the_permalink(); ?>">
                                    <div class="announcements__content--left">
                                        <?php
                                        if (has_post_thumbnail()) {
                                            the_post_thumbnail('full'); // アイキャッチ画像がある場合
                                        } else {
                                            echo '<img decoding=”async” src="' . esc_url(get_template_directory_uri()) . '/images/logo-pin.jpg" alt="default image">'; // アイキャッチ画像がない場合
                                        }
                                        ?>
                                    </div>
                                    <div class="announcements__content--right">
                                        <div class="announcements__content--time">投稿日：<?php the_time('Y年n月j日'); ?>
                                            <br class="sp-newline">
                                            <?php
                                            $categories = get_the_category();
                                            if (!empty($categories)) {
                                                foreach ($categories as $category) {
                                                    $category_class = 'category-' . esc_html($category->slug);
                                                    echo '<span class="announcements__content--category ' . esc_attr($category_class) . '">' . esc_html($category->name) . '</span> ';
                                                }
                                            }
                                            ?>
                                        </div>
                                        <div class="announcements__content--title"> <?php
                                                                                    $title = get_the_title();
                                                                                    if (mb_strlen($title) > 30) {
                                                                                        $title = mb_substr($title, 0, 30) . '・・・';
                                                                                    }
                                                                                    echo esc_html($title);
                                                                                    ?></div>
                                        <p class="announcements__content--sentence"><?php
                                                                                    // 投稿のテキストを取得し、HTMLタグやコメントを取り除く
                                                                                    $content = wp_strip_all_tags(get_the_content(), true);
                                                                                    // テキストの長さを確認して、120文字以上の場合に省略する
                                                                                    if (mb_strlen($content) > 120) {
                                                                                        $content = mb_substr($content, 0, 120) . '・・・';
                                                                                    }
                                                                                    // テキストを表示
                                                                                    echo esc_html($content);
                                                                                    ?></p>
                                    </div>
                                </a>
                            </li>
                    <?php
                        endwhile;
                        wp_reset_postdata();
                    else :
                        echo '投稿はありません。';
                    endif;
                    ?>
                    <div class="pagination-wrapper">
                        <?php
                        // ページネーションを表示
                        echo paginate_links(array(
                            'total' => $query->max_num_pages,
                            'current' => $paged,
                            'prev_text' =>  get_field('prev'),
                            'next_text' => get_field('next'),
                            'end_size' => 1, // 両端に常に表示するページ数
                            'mid_size' => 1, // 現在のページの前後に表示するページ数
                            'type' => 'plain',
                            'add_args' => false,
                        ));
                        ?>
                    </div>
                </ul>
            </div>
        </div>
    </section>
</main>
<?php get_footer(); ?>