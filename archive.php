<?php

/**
 * The template for displaying Archive pages.
 */

get_header(); ?>


<?php

	/* Queue the first post, that way we know
	 * what date we're dealing with (if that is the case).
	 *
	 * We reset this later so we can run the loop
	 * properly with a call to rewind_posts().
	 */

if ( have_posts() ) {
	the_post();
}
?>

	<h1 class="page-title">
		<?php if ( is_day() ) : ?>
			<?php
				// phpcs:ignore WordPress.WP.I18n.MissingTranslatorsComment
				printf( esc_html__( 'Daily Archives: <span>%s</span>', 'psdtheme' ), get_the_date() );
			?>
		<?php elseif ( is_month() ) : ?>
			<?php
				// phpcs:ignore WordPress.WP.I18n.MissingTranslatorsComment
				printf( esc_html__( 'Monthly Archives: <span>%s</span>', 'psdtheme' ), get_the_date( _x( 'F Y', 'monthly archives date format', 'psdtheme' ) ) );
			?>
		<?php elseif ( is_year() ) : ?>
			<?php
				// phpcs:ignore WordPress.WP.I18n.MissingTranslatorsComment
				printf( esc_html__( 'Yearly Archives: <span>%s</span>', 'psdtheme' ), get_the_date( _x( 'Y', 'yearly archives date format', 'psdtheme' ) ) );
			?>
		<?php else : ?>
			<?php echo esc_html__( 'Blog Archives', 'psdtheme' ); ?>
		<?php endif; ?>
	</h1>

	<?php rewind_posts(); ?>

<?php
if ( have_posts() ) {

	// Load posts loop.
	while ( have_posts() ) {
		the_post();
		get_template_part( 'template-parts/content/content', 'post' );
	}
} else {

	// If no content, include the "No posts found" template.
	get_template_part( 'template-parts/content/content', 'none' );

}
?>



<?php get_footer(); ?>
