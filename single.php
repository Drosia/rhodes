<?php

/**
 * The Template for displaying all single posts.
 */

get_header(); ?>

<section class="single-post">
    <div class="container">
        <div class="single-post__content">
            <?php while (have_posts()) : the_post(); ?>
                <article class="post">
                    <header class="post__header" data-aos="fade-up" data-aos-duration="1000">
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
                            <span class="post__reading-time">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <circle cx="12" cy="12" r="10"/>
                                    <polyline points="12 6 12 12 16 14"/>
                                </svg>
                                <?php echo reading_time(); ?>
                            </span>
                        </div>
                    </header>

                    <!-- Featured Image -->
                    <?php if (has_post_thumbnail()) : ?>
                        <div class="post__featured-image" data-aos="fade-up" data-aos-delay="200" data-aos-duration="1000">
                            <?php the_post_thumbnail('full'); ?>
                        </div>
                    <?php endif; ?>

                    <!-- Post Content -->
                    <div class="post__content" data-aos="fade-up" data-aos-delay="400" data-aos-duration="1000">
                        <?php the_content(); ?>
                    </div>

                    <footer class="post__footer" data-aos="fade-up" data-aos-delay="600" data-aos-duration="1000">
                        <!-- Tags -->
                        <?php if (has_tag()) : ?>
                            <div class="post__tags">
                                <i class="fa fa-tags"></i>
                                <?php the_tags('<span class="tags-label">Tags:</span> ', ', '); ?>
                            </div>
                        <?php endif; ?>

                        <!-- Social Share Buttons -->
                        <div class="post__share">
                            <h4>Share This Article</h4>
                            <div class="share-buttons">
                                <a href="https://facebook.com/sharer/sharer.php?u=<?php echo urlencode(get_permalink()); ?>" target="_blank" class="share-button share-facebook" aria-label="Share on Facebook">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="currentColor">
                                        <path d="M12 2C6.477 2 2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.879V14.89h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.989C18.343 21.129 22 16.99 22 12c0-5.523-4.477-10-10-10z"/>
                                    </svg>
                                </a>
                                <a href="https://twitter.com/intent/tweet?url=<?php echo urlencode(get_permalink()); ?>&text=<?php echo urlencode(get_the_title()); ?>" target="_blank" class="share-button share-twitter" aria-label="Share on Twitter">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="currentColor">
                                        <path d="M22 5.8a8.49 8.49 0 0 1-2.36.64 4.13 4.13 0 0 0 1.81-2.27 8.21 8.21 0 0 1-2.61 1 4.1 4.1 0 0 0-7 3.74 11.64 11.64 0 0 1-8.45-4.29 4.16 4.16 0 0 0-.55 2.07 4.09 4.09 0 0 0 1.82 3.41 4.05 4.05 0 0 1-1.86-.51v.05a4.1 4.1 0 0 0 3.3 4 4.2 4.2 0 0 1-1.86.07 4.11 4.11 0 0 0 3.83 2.84A8.22 8.22 0 0 1 2 18.33a11.57 11.57 0 0 0 6.29 1.85A11.59 11.59 0 0 0 20 8.45v-.53a8.43 8.43 0 0 0 2-2.12Z"/>
                                    </svg>
                                </a>
                                <a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo urlencode(get_permalink()); ?>&title=<?php echo urlencode(get_the_title()); ?>" target="_blank" class="share-button share-linkedin" aria-label="Share on LinkedIn">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="currentColor">
                                        <path d="M20 2H4a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2zM8 19H5v-9h3zM6.5 8.25A1.75 1.75 0 1 1 8.3 6.5a1.78 1.78 0 0 1-1.8 1.75zM19 19h-3v-4.74c0-1.42-.6-1.93-1.38-1.93A1.74 1.74 0 0 0 13 14.19a.66.66 0 0 0 0 .14V19h-3v-9h2.9v1.3a3.11 3.11 0 0 1 2.7-1.4c1.55 0 3.36.86 3.36 3.66z"/>
                                    </svg>
                                </a>
                                <a href="mailto:?subject=<?php echo urlencode(get_the_title()); ?>&body=<?php echo urlencode(get_permalink()); ?>" class="share-button share-email" aria-label="Share via Email">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/>
                                        <polyline points="22,6 12,13 2,6"/>
                                    </svg>
                                </a>
                                <button class="share-button share-copy" aria-label="Copy Link" onclick="copyToClipboard('<?php echo esc_url(get_permalink()); ?>')">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71"/>
                                        <path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71"/>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </footer>

                    <!-- Related Articles -->
                    <?php
                    $categories = get_the_category();
                    if ($categories) {
                        $category_ids = array();
                        foreach ($categories as $category) {
                            $category_ids[] = $category->term_id;
                        }
                        
                        $related_articles = new WP_Query(array(
                            'category__in' => $category_ids,
                            'post__not_in' => array(get_the_ID()),
                            'posts_per_page' => 3,
                            'orderby' => 'rand'
                        ));

                        if ($related_articles->have_posts()) : ?>
                            <section class="section article-suggestions">
                                <div class="container">
                                    <h2 class="article-suggestions__heading" data-aos="fade-up" data-aos-duration="1000">You May Also Enjoy</h2>
                                    <div class="article-grid">
                                        <?php 
                                        $index = 0;
                                        while ($related_articles->have_posts()) : $related_articles->the_post(); 
                                            $article_id = get_the_ID();
                                            $article_title = get_the_title();
                                            $article_permalink = get_permalink();
                                            $article_thumb = get_the_post_thumbnail_url($article_id, 'full');
                                            $article_excerpt = wp_trim_words(get_the_excerpt(), 12, '...');
                                            $article_date = get_the_date('M d, Y');
                                        ?>
                                            <div class="article-card" data-aos="fade-up" data-aos-delay="<?= $index * 200 ?>" data-aos-duration="1000">
                                                <a href="<?= esc_url($article_permalink); ?>" class="article-card__link">
                                                    <?php if (!empty($article_thumb)): ?>
                                                        <div class="article-card__image" style="background-image:url('<?= esc_url($article_thumb) ?>')">
                                                            <div class="article-card__overlay">
                                                                <span class="article-card__date"><?= esc_html($article_date); ?></span>
                                                                <div class="article-card__icon">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                                        <path d="M5 12h14M12 5l7 7-7 7"/>
                                                                    </svg>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    <?php endif; ?>
                                                    <div class="article-card__content">
                                                        <h3 class="article-card__title"><?= esc_html($article_title); ?></h3>
                                                        <?php if (!empty($article_excerpt)): ?>
                                                            <p class="article-card__excerpt"><?= esc_html($article_excerpt); ?></p>
                                                        <?php endif; ?>
                                                    </div>
                                                </a>
                                            </div>
                                        <?php $index++; endwhile; ?>
                                    </div>
                                </div>
                            </section>
                        <?php endif;
                        wp_reset_postdata();
                    }
                    ?>

                    <!-- Author Bio -->
                    <div class="post__author-bio" data-aos="fade-up" data-aos-delay="800" data-aos-duration="1000">
                        <div class="author-avatar">
                            <?php echo get_avatar(get_the_author_meta('ID'), 80); ?>
                        </div>
                        <div class="author-info">
                            <h4 class="author-name"><?php the_author_posts_link(); ?></h4>
                            <p class="author-description"><?php the_author_meta('description'); ?></p>
                            <?php if (get_the_author_meta('user_url')) : ?>
                                <a href="<?php echo esc_url(get_the_author_meta('user_url')); ?>" class="author-website" target="_blank">Website</a>
                            <?php endif; ?>
                        </div>
                    </div>
                </article>
            <?php endwhile; ?>
        </div>
    </div>
</section>
<?php get_template_part( 'template-parts/groups/groups', 'pre-footer' ); ?>
<?php get_footer(); ?>

<?php
// Add schema markup for single post
function add_post_schema() {
    if (is_single() && !is_singular('cruise') && !is_singular('destination')) {
        $post_id = get_the_ID();
        $title = get_the_title($post_id);
        $permalink = get_permalink($post_id);
        $excerpt = get_the_excerpt($post_id);
        $date_published = get_the_date('c', $post_id);
        $date_modified = get_the_modified_date('c', $post_id);
        
        // Get author info
        $author_id = get_post_field('post_author', $post_id);
        $author_name = get_the_author_meta('display_name', $author_id);
        $author_url = get_author_posts_url($author_id);
        
        // Get featured image
        $image = '';
        if (has_post_thumbnail($post_id)) {
            $image_id = get_post_thumbnail_id($post_id);
            $image_url = wp_get_attachment_image_src($image_id, 'full');
            if ($image_url) {
                $image = $image_url[0];
            }
        }
        
        // Get logo for publisher
        $logo = '';
        if (function_exists('get_custom_logo')) {
            $custom_logo_id = get_theme_mod('custom_logo');
            $logo_image = wp_get_attachment_image_src($custom_logo_id, 'full');
            if ($logo_image) {
                $logo = $logo_image[0];
            }
        }
        
        // Build schema
        $schema = array(
            '@context' => 'https://schema.org',
            '@type' => 'BlogPosting',
            'mainEntityOfPage' => array(
                '@type' => 'WebPage',
                '@id' => $permalink
            ),
            'headline' => $title,
            'description' => $excerpt,
            'datePublished' => $date_published,
            'dateModified' => $date_modified,
            'author' => array(
                '@type' => 'Person',
                'name' => $author_name,
                'url' => $author_url
            ),
            'publisher' => array(
                '@type' => 'Organization',
                'name' => get_bloginfo('name'),
                'logo' => array(
                    '@type' => 'ImageObject',
                    'url' => $logo
                )
            )
        );
        
        // Add image if available
        if (!empty($image)) {
            $schema['image'] = array(
                '@type' => 'ImageObject',
                'url' => $image
            );
        }
        
        echo '<script type="application/ld+json">' . json_encode($schema) . '</script>';
    }
}
add_action('wp_head', 'add_post_schema');
?>

<?php
function reading_time() {
    $content = get_post_field('post_content', get_the_ID());
    $word_count = str_word_count(strip_tags($content));
    $reading_time = ceil($word_count / 200); // Assuming 200 words per minute
    
    return $reading_time . ' min read';
}
?>

<?php
function generate_table_of_contents($content) {
    if (!is_single()) return $content;
    
    $headings = array();
    preg_match_all('/<h([2-3]).*?>(.*?)<\/h[2-3]>/i', $content, $matches, PREG_SET_ORDER);
    
    if (empty($matches)) return $content;
    
    $toc = '<div class="post__toc"><h4>Table of Contents</h4><ul>';
    
    foreach ($matches as $match) {
        $level = $match[1];
        $title = strip_tags($match[2]);
        $anchor = sanitize_title($title);
        
        // Replace the heading with one that has an ID
        $content = str_replace($match[0], '<h' . $level . ' id="' . $anchor . '">' . $match[2] . '</h' . $level . '>', $content);
        
        $toc .= '<li class="toc-level-' . $level . '"><a href="#' . $anchor . '">' . $title . '</a></li>';
    }
    
    $toc .= '</ul></div>';
    
    return $toc . $content;
}
add_filter('the_content', 'generate_table_of_contents');
?>