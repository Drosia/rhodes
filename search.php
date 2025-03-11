<?php

/**
 * The template for displaying Search Results pages.
 */

get_header(); ?>

	<?php if ( have_posts() ) { ?>

		<?php // phpcs:ignore WordPress.WP.I18n.MissingTranslatorsComment ?>
		<h1 class="page-title"><?php printf( esc_html__( 'Search Results for: %s', 'psdtheme' ), '<span>' . get_search_query() . '</span>' ); ?></h1>

		<?php
		while ( have_posts() ) {
			the_post();
			get_template_part( 'template-parts/content/content', 'post' );
		}
	} else {

		// If no content, include the "No posts found" template.
		get_template_part( 'template-parts/content/content', 'none' );

	}
	?>

<?php get_sidebar(); ?>
<?php get_footer(); ?>
