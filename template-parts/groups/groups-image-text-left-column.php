<?php
/**
 * Image Text Left Column Section
 */
?>

<?php if( have_rows('image_text_left_column') ): ?>
	<?php while( have_rows('image_text_left_column') ): the_row(); 

		$image = get_sub_field('background_image');
		$title = get_sub_field('title');
		$text = get_sub_field('text');
		$button = get_sub_field('button');
        if ( empty($image) && empty($title) && empty($text) && empty($button) ) {
            continue;
        }
	?>
		<section class="section section--banner section--banner-472  background-image no-shadow" style="background-image: url('<?php echo $image; ?>');">
			<div class="container">
				<div class="banner">
					<div class="banner__content">
						<?php if( $title) : ?>
							<h2 data-aos="fade-right" data-aos-duration="1000"> <?= $title ?></h2>
						<?php endif; ?>
						<?php if( $text) : ?>
							<span data-aos="fade-right" data-aos-delay="200" data-aos-duration="1000"> <?= $text ?></span>
						<?php endif; ?>
						<?php if( $button) : ?>
							<a href="<?= $button['url'] ?>" class="btn btn--blue btn--200" data-aos="fade-right" data-aos-delay="400" data-aos-duration="1000"> <span><?= $button['title'] ?></span></a>
						<?php endif; ?>	
					</div>
				</div>
			</div>
		</section>
	<?php endwhile; ?>
<?php endif; ?>