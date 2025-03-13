<?php 

get_header(); ?>

<?php 
        $title = get_field('title_destination', 'options');
        $subtitle = get_field('subtitle_destination', 'options');

        if ($title || $subtitle): ?>
            <section class="archive-destinations">
                <div class="container">
                    <h1><?= esc_html($title); ?></h1>
                    <h2><?= esc_html($subtitle); ?></h2>
                </div>
            </section>
        <?php endif; ?>

    <section class="section section--location">
        <div class="container">
            <?php
            // Custom WP_Query to fetch Destinations (Location CPT)
            $args = array(
                'post_type'      => 'destination', // Ensure correct CPT slug
                'posts_per_page' => 6, // Number of posts to display
                'orderby'        => 'date',
                'order'          => 'DESC',
            );
            $destination_query = new WP_Query($args);
            ?>

            <?php if ($destination_query->have_posts()) : ?>
                <div class="location">
                    <div class="location--container">
                        <?php while ($destination_query->have_posts()) : $destination_query->the_post(); ?>
                            <div class="location--item archive--items">
                                <a href="<?php the_permalink(); ?>" class="location-link">
                                    <?php if (has_post_thumbnail()) : ?>
                                        <div class="location-image background-image" style="background-image:url('<?php echo get_the_post_thumbnail_url(get_the_ID(), 'full'); ?>')">
                                            <h3 class="location-title"><?php the_title(); ?></h3>
                                            <?php if (has_excerpt()) : ?>
                                                <span class="location-excerpt"><?php the_excerpt(); ?></span>
                                            <?php endif; ?>
                                        </div>
                                    <?php endif; ?>
                                </a>
                            </div>
                        <?php endwhile; ?>
                    </div>
                    <?php 
                    // Check if a 'link' field is set in ACF (if so, show the "See more" link)
                    $link = get_field('link'); // Or use get_sub_field if you are within a repeater
                    if ($link) : ?>
                        <a class="see-more" href="<?= esc_url($link['url']); ?>"><?= esc_html($link['title']); ?></a>
                    <?php endif; ?>
                </div>
            <?php else : ?>
                <p>No destinations found.</p>
            <?php endif; ?>

            <?php wp_reset_postdata(); // Reset query ?>
        </div>
    </section>

<?php get_template_part('template-parts/groups/groups', 'pre-footer'); ?>

<?php get_footer(); ?>
