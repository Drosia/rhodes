<?php
/**
 * Βanner Section
 */
?>

<?php if( have_rows('banner') ): ?>
	<?php while( have_rows('banner') ): the_row(); 

		$image = get_sub_field('image');
		$title = get_sub_field('title');
		$text = get_sub_field('text');
		$button = get_sub_field('button');
        // If all fields are empty, skip this iteration
        if (empty($image) && empty($title) && empty($text)) {
            continue;
        }
	?>
		<section class="section section--banner  background-image" style="background-image: url('<?php echo $image['url']; ?>');">
			<div class="container">
				<div class="banner">
					<div class="banner__content">
						<?php if( $title) : ?>
							<h2 data-aos="fade-up" data-aos-duration="1000"> <?= $title ?></h2>
						<?php endif; ?>
						<?php if( $text) : ?>
							<span data-aos="fade-up" data-aos-delay="200" data-aos-duration="1000"> <?= $text ?></span>
						<?php endif; ?>
						<?php if( $button) : ?>
							<a href="<?= $button['url'] ?>" class="btn btn--200" data-aos="fade-up" data-aos-delay="400" data-aos-duration="1000"> <span><?= $button['title'] ?></span></a>
						<?php endif; ?>	
					</div>
				</div>
			</div>
		</section>
	<?php endwhile; ?>
<?php endif; ?>