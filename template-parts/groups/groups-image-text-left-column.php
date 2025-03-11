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
        if ( empty($image) && empty($title) && empty($text) ) {
            continue;
        }
	?>
		<section class="section section--banner section--banner-472  background-image" style="background-image: url('<?php echo $image; ?>');">
			<div class="container">
				<div class="banner">
					<div class="banner__content">
						<?php if( $title) : ?>
							<h2> <?= $title ?></h2>
						<?php endif; ?>
						<?php if( $text) : ?>
							<span> <?= $text ?></span>
						<?php endif; ?>
					</div>
				</div>
			</div>
		</section>
	<?php endwhile; ?>
<?php endif; ?>