<?php 
/* Template Name: Contact */

get_header(); ?>

<?php get_template_part( 'template-parts/groups/groups', 'hero' ); ?>

<?php if( have_rows( 'pre_footer', 'options' ) ): ?>
    <?php while( have_rows('pre_footer', 'options') ): the_row(); 

            $title = get_field('title');
            $message = get_field('message');
            $contact_form_shortcode = get_sub_field('contact_form');
            $telephone = get_field('telephone', 'options');
            $email = get_field('email', 'options');
            $address = get_field('address', 'options');
    ?> 
        <section class="section section-pre_footer section-pre_footer-page-tpl">
            <div class="container">
                <div class="pre_footer">
                    <div class="pre_footer--left" data-aos="fade-right" data-aos-duration="1000">
                        <?php if( $title) : ?>
                            <h2 data-aos="fade-up" data-aos-duration="1000"> <?= $title ?></h2>
                        <?php endif; ?>
                        <?php if( $message) : ?>
                            <p data-aos="fade-up" data-aos-delay="200" data-aos-duration="1000"> <?= $message ?></p>
                        <?php endif; ?>
                        <!-- Add Contact Details Below Header -->
                        <div class="contact-details" data-aos="fade-up" data-aos-delay="400" data-aos-duration="1000">
                            <ul>
                                <?php if( !empty($telephone) ) : ?>
                                    <li><strong>Telephone:</strong> <a href="tel:<?= $telephone['url']; ?>"><?= $telephone['title'] ?></a></li>
                                <?php endif; ?>
                                <?php if( !empty($email) ) : ?>
                                    <li><strong>Email:</strong> <a href="mailto:<?= $email['url'] ?>"><?= $email['title'] ?></a></li>
                                <?php endif; ?>
                                <?php if( !empty($address) ) : ?>
                                    <li><strong>Address:</strong> <a href="https://www.google.com/maps/search/?q=<?= urlencode($address) ?>" target="_blank"><?= $address ?></a></li>
                                <?php endif; ?>
                            </ul>
                        </div>
                        <?php if ( get_field('map_iframe') ) : ?>
                            <div class="map-container">
                                <?= get_field('map_iframe') ?>
                            </div>
                        <?php endif;?>                        
                    </div>
                    <div class="pre_footer--right" data-aos="fade-left" data-aos-duration="1000">
                        <?php if( !empty($contact_form_shortcode) && shortcode_exists('contact-form-7') ): ?>
                            <div class="form-wrapper" data-aos="fade-up" data-aos-delay="200" data-aos-duration="1000"> <?= do_shortcode($contact_form_shortcode); ?></div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </section>
    <?php endwhile; ?>
<?php endif; ?>


<?php
get_footer();
