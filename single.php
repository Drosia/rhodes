<?php

/**
 * The Template for displaying all single posts.
 */

get_header(); ?>

<main class="single-post">
    <div class="container">
        <div class="single-post__content">
            <?php while (have_posts()) : the_post(); ?>
                <article class="post">
                    <header class="post__header">
                        <!-- Categories -->
                        <div class="post__categories">
                            <?php the_category(' '); ?>
                        </div>

                        <h1 class="post__title"><?php the_title(); ?></h1>
                        
                        <div class="post__meta">
                            <span class="post__date">
                                <i class="fa fa-calendar"></i>
                                <?php echo get_the_date(); ?>
                            </span>
                            <span class="post__author">
                                <i class="fa fa-user"></i>
                                <?php the_author(); ?>
                            </span>
                        </div>
                    </header>

                    <?php if (has_post_thumbnail()) : ?>
                        <div class="post__featured-image">
                            <?php the_post_thumbnail('full'); ?>
                        </div>
                    <?php endif; ?>

                    <div class="post__content">
                        <?php the_content(); ?>
                    </div>

                    <footer class="post__footer">
                        <?php if (has_tag()) : ?>
                            <div class="post__tags">
                                <i class="fa fa-tags"></i>
                                <?php the_tags('<span class="tags-label">Tags:</span> ', ', '); ?>
                            </div>
                        <?php endif; ?>

                        <!-- Social Share Buttons -->
                        <div class="post__share">
                            <h4>Share this post</h4>
                            <div class="share-buttons">
                                <a href="https://facebook.com/sharer/sharer.php?u=<?php echo urlencode(get_permalink()); ?>" target="_blank" class="share-facebook">
                                    <!-- Facebook SVG Icon -->
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-facebook" viewBox="0 0 16 16">
                                        <path d="M15.117 0H.883C.396 0 0 .396 0 .883v14.234C0 15.604.396 16  .883 16h14.234c.487 0 .883-.396 .883-.883V.883C16 .396 15.604 0 15.117 0zM8 15.5V9.5H6.5V7h1.5V5.5c0-1.5.5-2.5 2.5-2.5H12v2.5h-1.5c-.5 0-.5.5-.5 1V7h2.5l-.5 2.5H10v6.5H8z"/>
                                    </svg>
                                </a>
                                <a href="https://twitter.com/intent/tweet?url=<?php echo urlencode(get_permalink()); ?>&text=<?php echo urlencode(get_the_title()); ?>" target="_blank" class="share-twitter">
                                    <!-- Twitter SVG Icon -->
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-twitter" viewBox="0 0 16 16">
                                        <path d="M5.026 15c6.038 0 9.34-5 9.34-9.34 0-.142 0-.283-.01-.423A6.693 6.693 0 0 0 16 3.542a6.56 6.56 0 0 1-1.889.517A3.293 3.293 0 0 0 15.557 2a6.57 6.57 0 0 1-2.084.793A3.281 3.281 0 0 0 7.875 6.5a9.325 9.325 0 0 1-6.75-3.415 3.28 3.28 0 0 0 1.016 4.375A3.276 3.276 0 0 1 .64 7.5v.041a3.283 3.283 0 0 0 2.628 3.215 3.28 3.28 0 0 1-.865.115c-.211 0-.417-.021-.617-.059a3.283 3.283 0 0 0 3.065 2.281A6.577 6.577 0 0 1 0 13.29a9.305 9.305 0 0 0 5.026 1.476"/>
                                    </svg>
                                </a>
                                <a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo urlencode(get_permalink()); ?>" target="_blank" class="share-linkedin">
                                    <!-- LinkedIn SVG Icon -->
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-linkedin" viewBox="0 0 16 16">
                                        <path d="M1.146 0A.5.5 0 0 0 .646.354v15.292a.5.5 0 0 0 .5.5h15.708a.5.5 0 0 0 .5-.5V.354a.5.5 0 0 0-.5-.5H1.146zM4.5 14H2V6h2.5v8zm-1.25-9.5A1.5 1.5 0 1 1 4.5 3a1.5 1.5 0 0 1-1.25 1.5zM14 14h-2.5v-4.5c0-1.125-.025-2.5-1.5-2.5-1.5 0-1.75 1.125-1.75 2.25V14H8V6h2.5v1.125c.5-.75 1.5-1.125 2.5-1.125 2 0 2.5 1.5 2.5 3.5V14z"/>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </footer>

                    <!-- Related Posts -->
                    <?php
                    $categories = get_the_category();
                    if ($categories) {
                        $category_ids = array();
                        foreach ($categories as $category) {
                            $category_ids[] = $category->term_id;
                        }
                        
                        $related_posts = new WP_Query(array(
                            'category__in' => $category_ids,
                            'post__not_in' => array(get_the_ID()),
                            'posts_per_page' => 3,
                            'orderby' => 'rand'
                        ));

                        if ($related_posts->have_posts()) : ?>
                            <div class="related-locations">
                                <div class="related-locations__container">
                                    <?php while ($related_posts->have_posts()) : $related_posts->the_post(); ?>
                                        <div class="related-locations__item">
                                            <a href="<?php the_permalink(); ?>" class="related-location-link">
                                                <div class="related-location-image" style="background-image:url('<?php echo get_the_post_thumbnail_url(get_the_ID(), 'full'); ?>')">
                                                    <h3 class="related-location-title"><?php the_title(); ?></h3>
                                                    <span class="related-location-excerpt"><?php echo wp_trim_words(get_the_excerpt(), 15, '...'); ?></span>
                                                    <!-- SVG Icon for Destination -->
                                                    <div class="destination-icon">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-geo-alt" viewBox="0 0 16 16">
                                                            <path d="M8 0a4 4 0 0 1 4 4c0 2.5-4 8-4 8s-4-5.5-4-8a4 4 0 0 1 8 0zM8 10a2 2 0 1 0 0-4 2 2 0 0 0 0 4z"/>
                                                        </svg>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    <?php endwhile; ?>
                                </div>
                            </div>
                        <?php endif;
                        wp_reset_postdata();
                    }
                    ?>
                </article>
            <?php endwhile; ?>
        </div>
    </div>
</main>

<?php get_footer(); ?>
