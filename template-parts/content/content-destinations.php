<?php 
// Get the current post ID
$current_post_id = get_the_ID();
// Query locations CPT in random order
$locations_query = new WP_Query([
    'post_type'      => 'destination', // Replace with your actual CPT name
    'posts_per_page' => -1, // Get all locations
    'orderby'        => 'rand', // Randomize order
    'post__not_in'   => [$current_post_id],// Exclude the current post
]);
$related_location_title = get_field('related_location_title', 'options');
// Check if we have locations
if ($locations_query->have_posts()): ?>
    <section class="section section--location section--location__random">
        <div class="container">
            <?php if( $related_location_title ) : ?>
                <h2 class="location--title"><?= $related_location_title ?> </h2>
            <?php endif; ?>
            <div class="location">
                <div class="location--container">
                    <?php while ($locations_query->have_posts()): $locations_query->the_post(); 
                        $location_id      = get_the_ID();
                        $location_title   = get_the_title();
                        $location_permalink = get_permalink();
                        $location_thumb   = get_the_post_thumbnail_url($location_id, 'full');
                        $location_excerpt = get_the_excerpt();
                    ?>
                        <div class="location--item">
                            <a href="<?= esc_url($location_permalink); ?>" class="location-link">
                                <?php if (!empty($location_thumb)): ?>
                                    <div class="location-image background-image" style="background-image:url('<?= esc_url($location_thumb) ?>')">
                                        <h3 class="location-title"><?= esc_html($location_title); ?></h3>
                                        <?php if (!empty($location_excerpt)): ?>
                                            <span class="location-excerpt"><?= esc_html($location_excerpt); ?></span>
                                        <?php endif; ?>
                                    </div>
                                <?php endif; ?>
                            </a>
                        </div>
                    <?php endwhile; ?>
                </div>
            </div>
        </div>
    </section>
<?php endif; wp_reset_postdata(); // Reset post data after custom query ?>


