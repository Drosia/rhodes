<?php
/**
 * Page content
 */
?>

<section class="section section--default">
	<div class="container">
        <?php the_title( '<h1 data-aos="fade-up" data-aos-duration="1000">', '</h1>' ); ?>

        <div data-aos="fade-up" data-aos-delay="200" data-aos-duration="1000">
            <?php the_content(); ?>
        </div>
    </div>
</section>
