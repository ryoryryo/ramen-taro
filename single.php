<?php
/*
Template Name: お知らせ、ブログ
*/

get_header(); ?>
<main>
    <section>
        <div class="post-background">
            <div class="post__wrapper wrapper">
                <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                        <div class="post__time">投稿日：<?php the_time('Y年n月j日'); ?>
                            <br class="sp-newline">
                            <?php
                            $categories = get_the_category();
                            if (!empty($categories)) {
                                foreach ($categories as $category) {
                                    $category_class = 'category-' . esc_html($category->slug);
                                    echo '<span class="post__category ' . esc_attr($category_class) . '">' . esc_html($category->name) . '</span> ';
                                }
                            }
                            ?>
                        </div>
                        <h2 class="post__title">
                            <?php the_title(); ?></a>
                        </h2>
                        <div class="post__content"><?php the_content(); ?></div>
                <?php endwhile;
                endif; ?>
            </div>
    </section>
    <!-- ページネーションを表示 -->
    <div class="pagination">
        <?php
        the_posts_pagination(array(
            'mid_size'  => 2,
            'prev_text' => __('« prev'),
            'next_text' => __('next »'),
        ));
        ?>
    </div>

    </div>
</main>
<?php get_footer(); ?>