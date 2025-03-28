<?php 
/* Template Name: Post Archive */

get_header();

// Get ACF fields
$featured_post = get_field('featured_post', 'option');
$archive_title = get_field('archive_title', 'option') ?: 'Places to Stay';
$archive_description = get_field('archive_description', 'option');
$secondary_posts_acf = get_field('secondary_featured_posts', 'option');
$posts_per_page = get_field('posts_per_page', 'option') ?: 6;
$show_filters = get_field('show_filters', 'option');

// Get secondary featured posts
if ($secondary_posts_acf && !empty($secondary_posts_acf)) {
    // Use the selected posts from ACF
    $secondary_posts = $secondary_posts_acf;
    $secondary_ids = array();
    foreach ($secondary_posts as $post) {
        $secondary_ids[] = $post->ID;
    }
} else {
    // Fallback to query if no posts selected in ACF
    $secondary_args = array(
        'post_type' => 'post',
        'posts_per_page' => 2,
        'orderby' => 'date',
        'order' => 'DESC',
        'post__not_in' => $featured_post ? array($featured_post->ID) : array()
    );
    $secondary_query = new WP_Query($secondary_args);
    $secondary_posts = $secondary_query->posts;
    $secondary_ids = wp_list_pluck($secondary_posts, 'ID');
}

// Get remaining posts for the grid
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
$exclude_ids = array();
if ($featured_post) {
    $exclude_ids[] = $featured_post->ID;
}
$exclude_ids = array_merge($exclude_ids, $secondary_ids);

$grid_args = array(
    'post_type' => 'post',
    'posts_per_page' => $posts_per_page,
    'paged' => $paged,
    'orderby' => 'date',
    'order' => 'DESC',
    'post__not_in' => $exclude_ids
);
$grid_posts = new WP_Query($grid_args);

// Get all categories for filters
$categories = get_categories(array(
    'orderby' => 'name',
    'order' => 'ASC',
    'hide_empty' => true
));
?>
<section class="section section-post-archive">
    <div class="container">
        <div class="archive-header" data-aos="fade-up" data-aos-duration="1000">
            <h1><?php echo esc_html($archive_title); ?></h1>
            <?php if ($archive_description): ?>
                <p data-aos="fade-up" data-aos-delay="200" data-aos-duration="1000"><?php echo esc_html($archive_description); ?></p>
            <?php endif; ?>
        </div>
        
        <?php if ($show_filters && !empty($categories)): ?>
        <div class="archive-filters" data-aos="fade-up" data-aos-delay="400" data-aos-duration="1000">
            <button class="filter-button active" data-category="all">All</button>
            <?php foreach ($categories as $category): ?>
                <button class="filter-button" data-category="<?php echo esc_attr($category->slug); ?>">
                    <?php echo esc_html($category->name); ?>
                </button>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>
        
        <div class="archive-grid">
            <?php if ($featured_post): ?>
                <article class="archive-grid__featured" data-aos="fade-up" data-aos-duration="1000">
                    <?php if (has_post_thumbnail($featured_post->ID)): ?>
                        <img src="<?php echo get_the_post_thumbnail_url($featured_post->ID, 'large'); ?>" 
                            alt="<?php echo esc_attr($featured_post->post_title); ?>" 
                            class="archive-grid__featured-image">
                    <?php endif; ?>
                    
                    <div class="archive-grid__featured-content">
                        <?php
                        $categories = get_the_category($featured_post->ID);
                        if ($categories): ?>
                            <div class="category">
                                <?php echo esc_html($categories[0]->name); ?>
                            </div>
                        <?php endif; ?>

                        <h2 class="title">
                            <a href="<?php echo get_permalink($featured_post->ID); ?>">
                                <?php echo esc_html($featured_post->post_title); ?>
                            </a>
                        </h2>
                        
                        <div class="excerpt">
                            <?php echo wp_trim_words($featured_post->post_excerpt ?: $featured_post->post_content, 20); ?>
                        </div>
                        
                        <div class="date">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                                <line x1="16" y1="2" x2="16" y2="6"></line>
                                <line x1="8" y1="2" x2="8" y2="6"></line>
                                <line x1="3" y1="10" x2="21" y2="10"></line>
                            </svg>
                            <?php echo get_the_date('M d, Y', $featured_post->ID); ?>
                        </div>
                    </div>
                    
                    <a href="<?php echo get_permalink($featured_post->ID); ?>" class="view-all">View Post</a>
                </article>
            <?php endif; ?>

            <?php
            // Display secondary featured posts (2-column layout)
            if (!empty($secondary_posts)): 
                $index = 0;
                foreach ($secondary_posts as $post):
                    setup_postdata($GLOBALS['post'] =& $post);
            ?>
                <article class="archive-grid__secondary" data-aos="fade-up" data-aos-delay="<?= 600 + ($index * 200) ?>" data-aos-duration="1000">
                    <?php if (has_post_thumbnail()): ?>
                        <img src="<?php echo get_the_post_thumbnail_url(null, 'medium_large'); ?>" 
                            alt="<?php echo esc_attr(get_the_title()); ?>" 
                            class="archive-grid__secondary-image">
                    <?php endif; ?>
                    
                    <div class="archive-grid__secondary-content">
                        <?php
                        $categories = get_the_category();
                        if ($categories): ?>
                            <div class="category">
                                <?php echo esc_html($categories[0]->name); ?>
                            </div>
                        <?php endif; ?>

                        <h2 class="title">
                            <a href="<?php the_permalink(); ?>">
                                <?php the_title(); ?>
                            </a>
                        </h2>
                        
                        <div class="date">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                                <line x1="16" y1="2" x2="16" y2="6"></line>
                                <line x1="8" y1="2" x2="8" y2="6"></line>
                                <line x1="3" y1="10" x2="21" y2="10"></line>
                            </svg>
                            <?php echo get_the_date('M d, Y'); ?>
                        </div>
                    </div>
                    
                    <a href="<?php the_permalink(); ?>" class="archive-grid__item-link" aria-label="Read more about <?php echo esc_attr(get_the_title()); ?>"></a>
                </article>
            <?php 
                    $index++;
                endforeach;
                wp_reset_postdata();
            endif; 
            ?>

            <!-- Small posts (3-column layout) -->
            <div class="archive-grid__small">
                <?php
                if ($grid_posts->have_posts()):
                    $index = 0;
                    while ($grid_posts->have_posts()): $grid_posts->the_post();
                        // Get post categories for filtering
                        $post_categories = get_the_category();
                        $category_classes = '';
                        foreach ($post_categories as $category) {
                            $category_classes .= ' category-' . $category->slug;
                        }
                ?>
                    <article class="archive-grid__small-item <?php echo esc_attr($category_classes); ?>" data-aos="fade-up" data-aos-delay="<?= 800 + ($index * 100) ?>" data-aos-duration="1000">
                        <div class="archive-grid__small-item-image-container">
                            <?php if (has_post_thumbnail()): ?>
                                <img src="<?php echo get_the_post_thumbnail_url(null, 'medium'); ?>" 
                                    alt="<?php echo esc_attr(get_the_title()); ?>" 
                                    class="archive-grid__small-image">
                            <?php endif; ?>
                        </div>
                        
                        <div class="archive-grid__small-item-content">
                            <?php
                            $categories = get_the_category();
                            if ($categories): ?>
                                <div class="category">
                                    <?php echo esc_html($categories[0]->name); ?>
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
                                <?php echo get_the_date('M d, Y'); ?>
                            </div>
                        </div>
                        
                        <a href="<?php the_permalink(); ?>" class="archive-grid__item-link" aria-label="Read more about <?php echo esc_attr(get_the_title()); ?>"></a>
                    </article>
                <?php 
                    $index++;
                    endwhile;
                    wp_reset_postdata();
                endif; 
                ?>
            </div>
        </div>

        <div class="loading-spinner"></div>

        <div class="pagination">
            <?php
            echo paginate_links(array(
                'total' => $grid_posts->max_num_pages,
                'current' => $paged,
                'prev_text' => __('&laquo; Previous'),
                'next_text' => __('Next &raquo;')
            ));
            ?>
        </div>
    </div>
</section>
<script>
    // Category filtering
    document.addEventListener('DOMContentLoaded', function() {
        const filterButtons = document.querySelectorAll('.filter-button');
        const items = document.querySelectorAll('.archive-grid__small-item');
        
        filterButtons.forEach(button => {
            button.addEventListener('click', function() {
                const category = this.getAttribute('data-category');
                
                // Update active button
                filterButtons.forEach(btn => btn.classList.remove('active'));
                this.classList.add('active');
                
                // Filter items
                items.forEach(item => {
                    if (category === 'all') {
                        item.style.display = 'block';
                    } else {
                        if (item.classList.contains('category-' + category)) {
                            item.style.display = 'block';
                        } else {
                            item.style.display = 'none';
                        }
                    }
                });
            });
        });
        
        // Animation on scroll
        const animateElements = document.querySelectorAll('.fade-in, .slide-up');
        
        function checkScroll() {
            animateElements.forEach(element => {
                const elementTop = element.getBoundingClientRect().top;
                const windowHeight = window.innerHeight;
                
                if (elementTop < windowHeight * 0.9) {
                    element.style.opacity = '1';
                    element.style.transform = 'translateY(0)';
                }
            });
        }
        
        // Initial check
        checkScroll();
        
        // Check on scroll
        window.addEventListener('scroll', checkScroll);
    });
</script>
<?php get_template_part( 'template-parts/groups/groups', 'pre-footer' ); ?>
<?php get_footer(); ?>
