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
	// Start of Selection
	$button = get_sub_field('button');
	$show_form_on_hero_section = get_sub_field('show_form_on_hero_section');
	if ( $title === '<Title>') {
		$title = get_the_title(get_queried_object_id());
	}

	?>
		<section class="section section--hero background-image__full background-image" style="background-image: url('<?php echo $image; ?>');">
			<div class="container<?= $show_form_on_hero_section ? ' container--header' : ''; ?>">
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
									<label for="guests"><?= esc_html__('Guests', 'psdtheme'); ?></label>
									<select id="guests" name="guests">
										<option value="1"><?= esc_html__('1 Guest', 'psdtheme'); ?></option>
										<option value="2"><?= esc_html__('2 Guests', 'psdtheme'); ?></option>
										<option value="3"><?= esc_html__('3 Guests', 'psdtheme'); ?></option>
										<option value="4"><?= esc_html__('4 Guests', 'psdtheme'); ?></option>
										<option value="5"><?= esc_html__('5 Guests', 'psdtheme'); ?></option>
										<option value="6"><?= esc_html__('6 Guests', 'psdtheme'); ?></option>
										<option value="7"><?= esc_html__('7 Guests', 'psdtheme'); ?></option>
										<option value="8"><?= esc_html__('8 Guests', 'psdtheme'); ?></option>
										<option value="9"><?= esc_html__('9 Guests', 'psdtheme'); ?></option>
										<option value="10"><?= esc_html__('10 Guests', 'psdtheme'); ?></option>
									</select>	
									<span class="arrow-down js-select-arrow"></span>
								</div>
    							<div class="form-column">
    								<label for="category"><?= esc_html__('Category', 'psdtheme'); ?></label>
    								<select id="category" name="category" class="js-category-select">
    									<option value="" disabled selected><?= esc_html__('Select Category', 'psdtheme'); ?></option>
    									<option value="semi-private"><?= esc_html__('Semi-Private', 'psdtheme'); ?></option>
    									<option value="private"><?= esc_html__('Private', 'psdtheme'); ?></option>
    								</select>	
    								<span class="arrow-down js-select-arrow"></span>
    							</div>
    							<div class="form-column">
    								<label for="cruise_type"><?= esc_html__('Cruise', 'psdtheme'); ?></label>
    								<select id="cruise_type" name="cruise_type" class="js-cruise-select">
    									<option value="" disabled selected><?= esc_html__('Select Category First', 'psdtheme'); ?></option>
    								</select>	
    								<span class="arrow-down js-select-arrow"></span>
    							</div>
    							<div class="form-column form-column--submit">
    								<button type="submit"><?= esc_html__('Check Availability', 'psdtheme'); ?></button>
    							</div>
    						</form>
					<?php endif; ?>
					
					<?php 
					// Check if cruise_hero_extra field exists and has rows
					if( have_rows('cruise_hero_extra') ): ?>
						<div class="cruise-hero-extra">
							<?php while( have_rows('cruise_hero_extra') ): the_row(); 
								$icon = get_sub_field('icon');
								$title = get_sub_field('title');
								$message = get_sub_field('message');
							?>
								<div class="cruise-hero-extra__item">
									<?php if($icon): ?>
										<div class="cruise-hero-extra__icon">
											<img src="<?php echo esc_url($icon['url']); ?>" alt="<?php echo esc_attr($icon['alt']); ?>">
										</div>
									<?php endif; ?>
									<?php if($title): ?>
										<div class="cruise-hero-extra__title">
											<?php echo esc_html($title); ?>
										</div>
									<?php endif; ?>
									<?php if($message): ?>
										<div class="cruise-hero-extra__message">
											<?php echo $message; ?>
										</div>
									<?php endif; ?>
								</div>
							<?php endwhile; ?>
						</div>
					<?php endif; ?>
				</div>
			</div>
		</section>
	<?php endwhile; ?>
<?php endif; ?>
