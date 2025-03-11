<?php
/**
 * The template for displaying the footer.
 */
?>
<?php if ( have_rows('footer_column_1', 'options') || have_rows('footer_column_2', 'options') || have_rows('footer_column_3', 'options') ) : ?>
    <footer class="site-footer">
		<div class="container">
			<div class="footer--content">
				<?php 
				$footer_columns = [
					'footer_column_1' => 'footer--col-1',
					'footer_column_2' => 'footer--col-2',
					'footer_column_3' => 'footer--col-3'
				];

				foreach ( $footer_columns as $column_key => $column_class ) : 
					if ( have_rows($column_key, 'options') ) : ?>
						<?php while ( have_rows($column_key, 'options') ) : the_row(); 
							$title = get_sub_field('title');
							$links = get_sub_field('links');
							$address = get_sub_field('address');
						?>
						<div class="<?= esc_attr($column_class); ?>">
							<?php if ( !empty($title) ) : ?>
								<h3><?= esc_html($title); ?></h3>
							<?php endif; ?>

							<?php if ( !empty($links) || !empty($address) ) : ?>
								<ul>
									<?php if ( !empty($links) ) : ?>
										<?php foreach ( $links as $link_item ) : 
											$link = isset($link_item['link']) ? $link_item['link'] : null;
											if ( $link && !empty($link['url']) && !empty($link['title']) ) : ?>
												<li>
													<a href="<?= esc_url($link['url']); ?>">
														<?= esc_html($link['title']); ?>
													</a>
												</li>
											<?php endif; ?>
										<?php endforeach; ?>
									<?php endif; ?>

									<?php if ( !empty($address) ) : ?>
										<li><?= $address; ?></li>
									<?php endif; ?>
								</ul>
							<?php endif; ?>
						</div>
						<?php endwhile; ?>
					<?php endif; 
				endforeach; ?>
			</div>
			<?php if ( have_rows('outer_footer', 'options') ) : ?>
				<?php while ( have_rows('outer_footer', 'options') ) : the_row(); ?>
					<?php
						$copyright = get_sub_field('copyright');
						$designed_by = get_sub_field('designed_by');
					?>
					<div class="footer--outer">
						<div class="footer--logo">
							<?php if ( have_rows('logos') ) : // Check if the logos repeater has data ?>
								<?php while ( have_rows('logos') ) : the_row(); ?>
									<?php 
										$logo_id = get_sub_field('logo'); // Assuming 'image' stores the image ID
										if ( !empty($logo_id) ) :
											echo wp_get_attachment_image($logo_id, 'full', false, ['alt' => 'Footer Logo']);
										endif;
									?>
								<?php endwhile; ?>
							<?php endif; ?>
						</div>
						<div class="footer--txt">
							<?php if ( !empty($copyright) ) : ?>
								<div class="footer__copyright"><?= esc_html($copyright); ?></div>
							<?php endif; ?>
							<?php if ( !empty($designed_by) ) : ?>
								<div class="footer__designed_by"><?= esc_html($designed_by); ?></div>
							<?php endif; ?>
						</div>
					</div>
				<?php endwhile; ?>
			<?php endif; ?>	
		</div>
    </footer>
<?php endif; ?>

	</div>

	<?php wp_footer(); ?>
</body>

</html>
