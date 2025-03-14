<?php
/**
 * Hero Section
 */
?>

<?php if( have_rows('hero') ): ?>
	<?php while( have_rows('hero') ): the_row(); 

		$image = get_sub_field('background_image');
		$title = get_sub_field('title');
		$text = get_sub_field('text');
		$button = get_sub_field('button');
		$show_form_on_hero_section = get_sub_field('show_form_on_hero_section');
		if ( $title === '<Title>') {
			$title = get_the_title(get_queried_object_id());
		}

	?>
		<section class="section section--hero background-image__full background-image" style="background-image: url('<?php echo $image; ?>');">
			<div class="container">
				<div class="hero">
					<div class="hero__content <?= !$show_form_on_hero_section ? 'mb-auto' : ''; ?>">
						<?php if( $title) : ?>
							<h1> <?= $title ?></h1>
						<?php endif; ?>
						<?php if( $text) : ?>
							<p> <?= $text ?></p>
						<?php endif; ?>
						<?php if( $button) : ?>
							<a href="<?= $button['url'] ?>" class="btn btn--white"> <span><?= $button['title'] ?></span></a>
						<?php endif; ?>
					</div>
					<?php if ( $show_form_on_hero_section ) : ?>
						<form class="form-container">
							<div class="form-column">
								<label for="guests">Guests</label>
								<select id="guests" name="guests">
									<option value="1">1 Guest</option>
									<option value="2">2 Guests</option>
									<option value="3">3 Guests</option>
									<option value="4">4 Guests</option>
									<option value="5">5 Guests</option>
									<option value="6">6 Guests</option>
									<option value="7">7 Guests</option>
									<option value="8">8 Guests</option>
									<option value="9">9 Guests</option>
									<option value="10">10 Guests</option>
									<option value="more">more than 10 Guests</option>
								</select>	
								<span class="arrow-down js-select-arrow"></span>
							</div>
							<div class="form-column">
								<label for="category">Category</label>
								<select id="category" name="category" class="js-category-select">
									<option value="" disabled selected>Select Category</option>
									<option value="semi-private">Semi-Private</option>
									<option value="private">Private</option>
								</select>	
								<span class="arrow-down js-select-arrow"></span>
							</div>
							<div class="form-column">
								<label for="cruise_type">Cruise</label>
								<select id="cruise_type" name="cruise_type" class="js-cruise-select">
									<option value="" disabled selected>Select Category First</option>
								</select>	
								<span class="arrow-down js-select-arrow"></span>
							</div>
							<div class="form-column form-column--submit">
								<button type="submit">Check Availability</button>
							</div>
						</form>
					<?php endif; ?>
				</div>
			</div>
		</section>
	<?php endwhile; ?>
<?php endif; ?>
