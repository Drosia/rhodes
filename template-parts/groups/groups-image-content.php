<?php
/**
 * Image Banner Section
 */
?>

<?php if( have_rows('destination_content') ): ?>

        <section class="section section--destination-content">
            <div class="container">
				<?php 
					$row_index = 0; // Counter for alternating layout
					while( have_rows('destination_content') ): the_row(); 

						$image_id = get_sub_field('image'); // Image stored as an ID
						$subtitle = get_sub_field('subtitle');
						$title = get_sub_field('title');
						$text = get_sub_field('text');
						$button = get_sub_field('button');

						// If all fields are empty, skip this iteration
						if (empty($image_id) && empty($title) && empty($text)) {
							continue;
						}

						// Determine if this is an odd or even row
						$layout_class = ($row_index % 2 == 0) ? 'image-left' : 'image-right';
						// Add no-image class if there's no image
						if (empty($image_id)) {
							$layout_class .= ' no-image';
						}
						?>

						<div class="destination-content <?= esc_attr($layout_class); ?>">
							<div class="destination-content__image">
								<?php if( !empty($image_id) ): ?>
									<?= wp_get_attachment_image($image_id, 'full', false, ['class' => 'img-responsive']); ?>
								<?php endif; ?>
							</div>
							<div class="destination-content__text">
								<?php if( !empty($subtitle) ): ?>
									<h3><?= esc_html($subtitle); ?></h3>
								<?php endif; ?>
								<?php if( !empty($title) ): ?>
									<h2><?= esc_html($title); ?></h2>
								<?php endif; ?>
								<?php if( !empty($text) ): ?>
									<p><?= esc_html($text); ?></p>
								<?php endif; ?>
								<?php if( !empty($button) ): ?>
									<a href="<?= esc_url($button['url']); ?>" class="btn btn--blue btn--200"><span><?= esc_html($button['title']); ?></span></a>
								<?php endif; ?>
							</div>
						</div>
						<?php 
    					$row_index++; // Increment the counter
    				endwhile; 
    				?>
            </div>
        </section>
<?php endif; ?>
