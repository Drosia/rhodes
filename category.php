<?php
/**
 * The template for displaying Category Archive pages.
 */

get_header(); ?>

<h1 class="page-title">
<?php
	// phpcs:ignore WordPress.WP.I18n.MissingTranslatorsComment
	printf( esc_html__( 'Category Archives: %s', 'psdtheme' ), '<span>' . single_cat_title( '', false ) . '</span>' );
?>
</h1>
<?php
	$category_description = category_description();
if ( ! empty( $category_description ) ) {
	echo '<div class="archive-meta">' . esc_html( $category_description ) . '</div>';
}

?>

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
