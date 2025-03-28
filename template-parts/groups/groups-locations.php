<?php
/**
 * Locations Section
 */
?>

<?php if( have_rows('locations') ): ?>
	<?php while( have_rows('locations') ): the_row(); 

		$location = get_sub_field('location');
		$link = get_sub_field('link');
        
        if ( empty($link) && empty($location) ) {
            continue;
        }
	?>
		<section class="section section--location">
			<div class="container">
				<div class="location">
                    <?php if ($location) : ?>
                        <div class="location--container">
                            <?php foreach ($location as $index => $location_id) : 
                                $location_title   = get_the_title($location_id);
                                $location_permalink = get_permalink($location_id);
                                $location_thumb   = get_the_post_thumbnail_url($location_id, 'full');
                                $location_excerpt = get_the_excerpt($location_id);
                            ?>
                                <div class="location--item" data-aos="fade-up" data-aos-delay="<?= $index * 200 ?>" data-aos-duration="1000">
                                    <a href="<?= esc_url($location_permalink); ?>" class="location-link">
                                        <?php if ($location_thumb) : ?>
                                            <div class="location-image background-image" style="background-image:url('<?= $location_thumb ?>')">
												<h3 class="location-title"><?= esc_html($location_title); ?></h3>
												<?php if ($location_excerpt) : ?>
													<span class="location-excerpt"><?= esc_html($location_excerpt); ?></span>
												<?php endif; ?>
                                            </div>
                                        <?php endif; ?>
                                    </a>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
					<?php if ($link) : ?>
						<a class="see-more" href="<?= esc_url($link['url']); ?>" data-aos="fade-up" data-aos-delay="400" data-aos-duration="1000"><?= $link['title'] ?></a>
					<?php endif; ?>
				</div>
			</div>
		</section>
	<?php endwhile; ?>
<?php endif; ?>