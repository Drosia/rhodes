<?php
/**
 * Simple Text Section
 */
?>

<?php if( have_rows('simple_text') ): ?>
    <?php while( have_rows('simple_text') ): the_row(); 
        $title = get_sub_field('title');
        $subtitle = get_sub_field('subtitle');
        $text = get_sub_field('text');
        $button = get_sub_field('button');

        if ( empty($subtitle) && empty($title) && empty($text) && empty($button) ) {
            continue;
        }
		
        ?>
        
    <section class="section section--simple-text">
        <div class="container">
			<div class="simple-text">
				<?php if( $title) : ?>
					<h2> <?= $title ?></h2>
				<?php endif; ?>
				<?php if( $subtitle) : ?>
					<span> <?= $subtitle ?></span>
				<?php endif; ?>
				<?php if( $text) : ?>
					<p> <?= $text ?></p>
				<?php endif; ?>
				<?php if( $button) : ?>
					<a href="<?= $button['url'] ?>" class="btn btn--blue btn--200"> <span><?= $button['title'] ?></span></a>
				<?php endif; ?>				
			</div>
        </div>
    </section>
    <?php endwhile; ?>
<?php endif; ?>
