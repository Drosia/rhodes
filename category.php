<?php

/**
 * The template for displaying Archive pages.
 */

get_header();

$featured_post = get_field('featured_post', 'option');
$archive_title = get_field('archive_title', 'option');
$archive_description = get_field('archive_description', 'option');
?>
<section class="section section--archive">
	<div class="container">
		<div class="archive-header fade-in">
			<h1><?php echo esc_html($archive_title); ?></h1>
			<?php if ($archive_description): ?>
				<p><?php echo esc_html($archive_description); ?></p>
			<?php endif; ?>
		</div>
		
		<div class="archive-grid">
			<?php if ($featured_post): ?>
				<article class="archive-grid__featured">
					<?php if (has_post_thumbnail($featured_post->ID)): ?>
						<img src="<?php echo get_the_post_thumbnail_url($featured_post->ID, 'large'); ?>" 
							alt="<?php echo esc_attr($featured_post->post_title); ?>" 
							class="archive-grid__featured-image">
					<?php endif; ?>
					
					<div class="archive-grid__featured-content">
						<?php
						$categories = get_the_category($featured_post->ID);
						if ($categories): ?>
							<div class="category">
								<?php echo esc_html($categories[0]->name); ?>
							</div>
						<?php endif; ?>

						<h2 class="title"><?php echo esc_html($featured_post->post_title); ?></h2>
						
						<div class="excerpt">
							<?php echo wp_trim_words($featured_post->post_excerpt ?: $featured_post->post_content, 20); ?>
						</div>
						
						<div class="date">
							<?php echo get_the_date('', $featured_post->ID); ?>
						</div>
					</div>
					
					<a href="<?php echo get_permalink($featured_post->ID); ?>" class="view-all">View Post</a>
				</article>
			<?php endif; ?>

			<?php
			if (have_posts()):
				while (have_posts()): the_post();
					// Skip if this is the featured post
					if ($featured_post && $featured_post->ID === get_the_ID()) continue;
					?>
					
					<article class="archive-grid__item">
						<?php if (has_post_thumbnail()): ?>
							<img src="<?php echo get_the_post_thumbnail_url(null, 'medium_large'); ?>" 
								alt="<?php echo esc_attr(get_the_title()); ?>" 
								class="archive-grid__item-image">
						<?php endif; ?>
						
						<div class="archive-grid__item-content">
							<?php
							$categories = get_the_category();
							if ($categories): ?>
								<div class="category">
									<?php echo esc_html($categories[0]->name); ?>
								</div>
							<?php endif; ?>

							<h2 class="title"><?php the_title(); ?></h2>
							
							<div class="date">
								<?php echo get_the_date(); ?>
							</div>
						</div>
						
						<a href="<?php the_permalink(); ?>" class="archive-grid__item-link" aria-label="Read more about <?php echo esc_attr(get_the_title()); ?>"></a>
					</article>
					
				<?php endwhile;
			endif;
			?>
		</div>

		<?php the_posts_pagination(); ?>
	</div>
</section>
<?php get_template_part( 'template-parts/groups/groups', 'pre-footer' ); ?>
<?php get_footer(); ?>
