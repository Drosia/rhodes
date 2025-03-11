<?php echo get_template_directory_uri(); ?>



<?php bloginfo( 'url' ); ?>
<?php bloginfo( 'name' ); ?>



<?php
wp_nav_menu(
	array(
		'theme_location' => 'primary',
		'menu_class'     => 'main-menu',
		'container'      => false,
	)
);
?>



<?php
if ( have_posts() ) :
	while ( have_posts() ) :
		the_post();
		?>

		<?php
	endwhile;
endif;
?>



<?php echo wp_get_attachment_image( get_sub_field( 'image' ), 'slider-thumb', false, array( 'class' => 'test' ) ); ?>
<?php echo wp_get_attachment_image_url( get_sub_field( 'image' ), 'slider-thumb' ); ?>




<?php
// check if the flexible content field has rows of data
if ( have_rows( 'sections' ) ) :

	// loop through the rows of data
	while ( have_rows( 'sections' ) ) :
		the_row();

		if ( get_row_layout() == 'section_two_columns_gray' ) :

			get_template_part( 'sections/section-two-cols-gray' );

		elseif ( get_row_layout() == 'section_image_text' ) :

			get_template_part( 'sections/section-img-text' );

		endif;

	endwhile;

endif;

?>



<?php

	$args = array(
		'post_type'      => 'post',
		'posts_per_page' => 4,
	);

	// query
	$query = new WP_Query( $args );

	// loop
	while ( $wp_query->have_posts() ) {
		$wp_query->the_post();

		get_template_part( 'content', 'post' );

	}
	wp_reset_postdata();
	?>




<?php
while ( have_rows( 'tabs_list' ) ) :
	the_row();
	?>


	<?php
endwhile;
