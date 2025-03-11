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
                    <div class="pre_footer--left">
                        <?php if( $title) : ?>
                            <h2> <?= $title ?></h2>
                        <?php endif; ?>
                        <?php if( $message) : ?>
                            <p> <?= $message ?></p>
                        <?php endif; ?>
                        <!-- Add Contact Details Below Header -->
                        <div class="contact-details">
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


<?php
get_footer();
