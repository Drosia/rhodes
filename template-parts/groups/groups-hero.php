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
						<button-widget class="form-container" widget-id="0d84e3f0-c44e-419b-aaf0-95ace468f594"></button-widget>
						<!-- <form class="form-container">
							<div class="form-column">
								<label for="date">Date</label>
								<input type="date" class="js-date" id="date" name="date" required>
								<span class="arrow-down js-date"></span>
							</div>
							<div class="form-column">
								<label for="guests">Guest</label>
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
								<label for="cruise_type">Type</label>
								<select id="cruise_type" name="cruise_type">
									<option value="1">Morning Cruise</option>
									<option value="2">Sunset Cruise</option>
									<option value="3">Private Cruise</option>
									<option value="4">Full Day Cruise</option>
								</select>	
								<span class="arrow-down js-select-arrow"></span>
							</div>
							<div class="form-column form-column--submit">
								<button type="submit">Check Availability</button>
							</div>
						</form> -->
					<?php endif; ?>
				</div>
			</div>
		</section>
	<?php endwhile; ?>
<?php endif; ?>
