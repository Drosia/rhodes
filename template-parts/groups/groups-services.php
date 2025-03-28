<?php
/**
 * Services Section
 */
?>

<?php if( have_rows('services') ): ?>
	<?php while( have_rows('services') ): the_row(); 

		$services = get_sub_field('service'); // Assuming 'service' is a sub-field repeater inside 'services'
		$icon = get_sub_field('icon');
		$button = get_sub_field('button');
        
        // If there's no 'service', 'icon', or 'button', skip this row
        if ( empty($services) && empty($icon) && empty($button) ) {
            continue;
        }
	?>
		<section class="section section--services">
			<div class="container">
				<div class="service--wrapper">
					<?php 
					// Using foreach to loop through the services (the nested repeater)
					foreach ($services as $index => $service) :
						$service_title = isset($service['title']) ? $service['title'] : ''; // Get title
						$service_text = isset($service['text']) ? $service['text'] : ''; // Get text description
					?>
						<div class="service" data-aos="fade-up" data-aos-delay="<?= $index * 200 ?>" data-aos-duration="1000">
                            <?php if( !empty($icon) ): ?>
                                <div class="service-icon">
                                    <?php 
                                    // Get the image HTML using wp_get_attachment_image() based on the image ID
                                    echo wp_get_attachment_image( $icon, 'full', false, array('alt' => 'Service Icon') );
                                    ?>
                                </div>
                            <?php endif; ?>

                            <div class="service-content">
                                <?php if( !empty($service_title) ): ?>
                                    <h3 class="service-title"><?php echo esc_html($service_title); ?></h3>
                                <?php endif; ?>
                                
                                <?php if( !empty($service_text) ): ?>
                                    <p class="service-description"><?php echo esc_html($service_text); ?></p>
                                <?php endif; ?>
                            </div>
                        </div>
					<?php endforeach; ?>
				</div>
				<?php if( !empty($button) ): ?>
						<div class="service-button" data-aos="fade-up" data-aos-delay="400" data-aos-duration="1000">
							<a href="<?php echo esc_url($button['url']); ?>" class="btn btn--200"><span><?php echo esc_html($button['title']); ?></span></a>
						</div>
                <?php endif; ?>
			</div>
		</section>
	<?php endwhile; ?>
<?php endif; ?>
