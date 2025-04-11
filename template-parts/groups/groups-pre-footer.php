<?php
/**
 * Pre Footer Section
 */
?>

<?php if( have_rows( 'pre_footer', 'options' ) ): ?>
    <?php while( have_rows('pre_footer', 'options') ): the_row(); 

            $title = get_sub_field('title');
            $message = get_sub_field('message');
            $contact_form_shortcode = get_sub_field('contact_form');
    ?> 
        <section class="section section-pre_footer">
            <div class="container">
                <div class="pre_footer">
                    <div class="pre_footer--left">
                        <?php if( $title) : ?>
                            <h2> <?= $title ?></h2>
                        <?php endif; ?>
                        <?php if( $message) : ?>
                            <p> <?= $message ?></p>
                        <?php endif; ?>
                    </div>
                    <div class="pre_footer--right">
                        <?php if( !empty($contact_form_shortcode) && shortcode_exists('contact-form-7') ): ?>
                            <div class="form-wrapper"> <?= do_shortcode($contact_form_shortcode); ?></div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </section>
    <?php endwhile; ?>
<?php endif; ?>