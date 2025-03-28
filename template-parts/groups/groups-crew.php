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
            $subtitle = get_sub_field('subtitle');
            $text = get_sub_field('text');
            $button = get_sub_field('button');
            $section_title = get_sub_field('section_title');
            
            // Check if the content is empty before rendering
            if (empty($title) && empty($text) && empty($button) && empty($crew_image) && empty($background_image)) {
                // Skip rendering if all necessary fields are empty
                continue;
            }

        ?>
        
        <section class="section section--crew background-image no-shadow" style="background-image: url('<?php echo $background_image['url']; ?>');">
            <div class="container">
                <div class="crew--wrapper">
                    <?php if ( ! empty($crew_image) ) : ?>
                        <div class="crew__left" data-aos="fade-right" data-aos-duration="1000">
                            <div class="crew__image">
                                <?php echo wp_get_attachment_image( $crew_image, 'crew_image', false, array( 'class' => 'crew_image' ) ); ?>
                            </div>
                        </div>
                    <?php endif; ?>
                    <div class="crew__right">
                        <?php if( $subtitle) : ?>
                            <h3 data-aos="fade-up" data-aos-duration="1000"> <?= $subtitle ?></h3>
                        <?php endif; ?>
                        <?php if( $title) : ?>
                            <h2 data-aos="fade-up" data-aos-delay="200" data-aos-duration="1000"> <?= $title ?></h2>
                        <?php endif; ?>
                        <?php if( $text) : ?>
                            <p data-aos="fade-up" data-aos-delay="400" data-aos-duration="1000"> <?= $text ?></p>
                        <?php endif; ?>
                        <?php if( !empty($button) ): ?>
                            <a href="<?php echo esc_url($button['url']); ?>" class="btn btn--200 btn--blue" data-aos="fade-up" data-aos-delay="600" data-aos-duration="1000"><span><?php echo esc_html($button['title']); ?></span></a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </section>
    <?php endwhile; ?>
<?php endif; ?>