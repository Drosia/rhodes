<?php
/**
 * Simple Text Section
 */
?>
<?php 
$title_of_news = get_field('title_of_news');
$link_to_all_blog = get_field('link_to_all_blog');
$news_related = get_field('news_related');

if ($news_related): ?>
    <section class="section section--news">
        <div class="container">
            <?php if ($title_of_news): ?>
                <h2><?= esc_html($title_of_news); ?></h2>
            <?php endif; ?>
            
            <div class="archive-grid__small">
                <?php 
                $delay = 0.4;
                foreach ($news_related as $post):
                    setup_postdata($post);
                    $delay += 0.1;
                    
                    // Get post categories for filtering
                    $post_categories = get_the_category();
                    $category_classes = '';
                    foreach ($post_categories as $category) {
                        $category_classes .= ' category-' . $category->slug;
                    }
                ?>
                    <article class="archive-grid__small-item slide-up<?php echo esc_attr($category_classes); ?>" style="animation-delay: <?php echo esc_attr($delay); ?>s;">
                        <div class="archive-grid__small-item-image-container">
                            <?php if (has_post_thumbnail()): ?>
                                <img src="<?php echo esc_url(get_the_post_thumbnail_url(null, 'medium_large')); ?>" 
                                    alt="<?php echo esc_attr(get_the_title()); ?>" 
                                    class="archive-grid__small-image">
                            <?php endif; ?>
                        </div>
                        
                        <div class="archive-grid__small-item-content">
                            <?php if ($post_categories): ?>
                                <div class="category">
                                    <?php echo esc_html($post_categories[0]->name); ?>
                                </div>
                            <?php endif; ?>

                            <h3 class="title">
                                <a href="<?php the_permalink(); ?>">
                                    <?php the_title(); ?>
                                </a>
                            </h3>
                            <div class="excerpt">
                                <?php echo wp_trim_words(get_the_excerpt(), 15); ?>
                            </div>
                            <div class="date">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                                    <line x1="16" y1="2" x2="16" y2="6"></line>
                                    <line x1="8" y1="2" x2="8" y2="6"></line>
                                    <line x1="3" y1="10" x2="21" y2="10"></line>
                                </svg>
                                <?php echo esc_html(get_the_date('M d, Y')); ?>
                            </div>
                        </div>
                        
                        <a href="<?php the_permalink(); ?>" class="archive-grid__item-link" aria-label="Read more about <?php echo esc_attr(get_the_title()); ?>"></a>
                    </article>
                <?php endforeach; ?>
                <?php wp_reset_postdata(); ?>
            </div>
            
            <?php if ($link_to_all_blog): ?>
                <a class="see-more" href="<?= esc_url($link_to_all_blog['url']); ?>">
                    <?= esc_html($link_to_all_blog['title']); ?>
                </a>
            <?php endif; ?>
        </div>
    </section>
<?php endif; ?>
