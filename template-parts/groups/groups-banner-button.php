<?php
/**
 * Βanner Section
 */
?>

<?php if( have_rows('banner_with_button') ): ?>
	<?php while( have_rows('banner_with_button') ): the_row(); 

		$image = get_sub_field('image');
		$title = get_sub_field('title');
		$text = get_sub_field('text');
		$button = get_sub_field('button');
        if ( empty($image) && empty($title) && empty($text) && empty($button) ) {
            continue;
        }
	?>
		<section class="section section--banner section--banner-big  background-image" style="background-image: url('<?php echo $image['url']; ?>');">
			<div class="container">
				<div class="banner">
					<div class="banner__content">
						<?php if( $title) : ?>
							<h2> <?= $title ?></h2>
						<?php endif; ?>
						<?php if( $text) : ?>
							<span> <?= $text ?></span>
						<?php endif; ?>
						<?php if( $button) : ?>
							<a href="<?= $button['url'] ?>" class="btn btn--200"> <span><?= $button['title'] ?></span></a>
						<?php endif; ?>				
					</div>
				</div>
			</div>
		</section>
	<?php endwhile; ?>
<?php endif; ?>