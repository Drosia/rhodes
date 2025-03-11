<?php
/**
 * Crew Section
 */
?>

<?php if( have_rows('meet_the_crew') ): ?>
    <?php while( have_rows('meet_the_crew') ): the_row(); 

            $background_image = get_sub_field('background_image');
            $crew_image = get_sub_field('crew_image');
            $title = get_sub_field('title');
            $text = get_sub_field('text');
            $button = get_sub_field('button');
            
            // Check if the content is empty before rendering
            if (empty($title) && empty($text) && empty($button) && empty($crew_image) && empty($background_image)) {
                // Skip rendering if all necessary fields are empty
                continue;
            }

        ?>
        
        <section class="section section--crew background-image" style="background-image: url('<?php echo $background_image['url']; ?>');">
            <div class="container">
                <div class="crew--wrapper">
                    <?php if ( ! empty($crew_image) ) : ?>
                        <div class="crew__left">
                            <div class="crew__image">
                                <?php echo wp_get_attachment_image( $crew_image, 'crew_image', false, array( 'class' => 'crew_image' ) ); ?>
                            </div>
                        </div>
                    <?php endif; ?>
                    <div class="crew__right">
                        <?php if( $title) : ?>
                            <h2> <?= $title ?></h2>
                        <?php endif; ?>
                        <?php if( $text) : ?>
                            <p> <?= $text ?></p>
                        <?php endif; ?>
                        <?php if( !empty($button) ): ?>
                            <a href="<?php echo esc_url($button['url']); ?>" class="btn btn--200 btn--blue"><span><?php echo esc_html($button['title']); ?></span></a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </section>
    <?php endwhile; ?>
<?php endif; ?>