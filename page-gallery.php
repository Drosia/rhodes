<?php 
/* Template Name: Gallery */

get_header(); ?>



<?php
if ( have_posts() ) {

	// Load posts loop.
	while ( have_posts() ) {
		the_post();
        ?>
        <?php 
        $title = get_field('title');
        $subtitle = get_field('subtitle');

        if ($title || $subtitle): ?>
            <section class="archive-destinations">
                <div class="container">
                    <h1><?= esc_html($title); ?></h1>
                    <h2><?= esc_html($subtitle); ?></h2>
                </div>
            </section>
        <?php endif; ?>

        <section class="section-image-gallery">
            <div class="container">
                <div class="cruise--image-gallery">
                    <?php 
                    $cruice_gallery = get_field('cruise_gallery');
                    $size = 'full'; // (thumbnail, medium, large, full or custom size)
                    $post_title = get_the_title(); // Get the current post title
                    if( $cruice_gallery ): ?>
                        <div class="grid">
                            <?php foreach( $cruice_gallery as $image_id ): ?>
                                <div class="grid-item">
                                    <?php 
                                        $image_src = wp_get_attachment_image_src($image_id, $size);

                                        if ($image_src) :
                                        ?>
                                            <a href="<?php echo esc_url($image_src[0]); ?>" 
                                                data-lightbox="gallery" 
                                                data-title="<?php echo esc_attr($post_title); ?>"
                                                data-lightbox="roadtrip"
                                                data-alwaysShowNavOnTouchDevices="true"
                                            >
                                                <?php echo wp_get_attachment_image($image_id, $size); ?>
                                            </a>
                                        <?php endif; ?>

                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>                    
                </div>
            </div>
        </section>
<?php 
	}
} else {

	// If no content, include the "No posts found" template.
	get_template_part( 'template-parts/content/content', 'none' );

}
?>



<?php get_template_part( 'template-parts/groups/groups', 'pre-footer' ); ?>
<?php
get_footer();
