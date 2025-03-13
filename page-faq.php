<?php
/**
 * Template Name: FAQ Page
 */

get_header(); ?>

<main class="main">
    <section class="section section--faq">
        <div class="container">
            <div class="faq-header">
                <h1 class="faq-title"><?php the_title(); ?></h1>
                <h2 class="faq-subtitle">Answers to our most frequently asked questions</h2>
            </div>

            <?php if( have_rows('faq_items') ): ?>
                <div class="faq-items">
                    <?php while( have_rows('faq_items') ): the_row(); 
                        $question = get_sub_field('question');
                        $answer = get_sub_field('answer');
                    ?>
                        <div class="faq-item">
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
</main>

<?php get_footer(); ?> 