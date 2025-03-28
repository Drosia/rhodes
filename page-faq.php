<?php
/**
 * Template Name: FAQ Page
 */

get_header(); ?>

<section class="section section--faq">
    <div class="container">
        <div class="faq-header" data-aos="fade-up" data-aos-duration="1000">
            <h1 class="faq-title"><?php the_title(); ?></h1>
            <?php if ( get_field( 'message' ) ) : ?>
                <h2 class="faq-subtitle" data-aos="fade-up" data-aos-delay="200" data-aos-duration="1000"><?php echo get_field( 'message' ) ?></h2>
            <?php endif; ?>
        </div>

        <?php if( have_rows('faq_items') ): ?>
            <div class="faq-items">
                <?php 
                $index = 0;
                while( have_rows('faq_items') ): the_row(); 
                    $question = get_sub_field('question');
                    $answer = get_sub_field('answer');
                ?>
                    <div class="faq-item" data-aos="fade-up" data-aos-delay="<?= 400 + ($index * 100) ?>" data-aos-duration="1000">
                        <button class="faq-question" aria-expanded="false">
                            <span><?php echo esc_html($question); ?></span>
                            <svg class="icon-arrow" width="24" height="24" viewBox="0 0 24 24">
                                <path d="M7 10l5 5 5-5" stroke="currentColor" fill="none" stroke-width="2"/>
                            </svg>
                        </button>
                        <div class="faq-answer">
                            <div class="faq-answer__content">
                                <?php echo wp_kses_post($answer); ?>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
        <?php endif; ?>
    </div>
</section>
<?php get_template_part( 'template-parts/groups/groups', 'pre-footer' ); ?>
<?php get_footer(); ?> 