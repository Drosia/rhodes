<?php 
/* Template Name: Homepage */

get_header(); ?>

<?php get_template_part( 'template-parts/groups/groups', 'hero' ); ?>
<?php get_template_part( 'template-parts/groups/groups', 'cruise' ); ?>
<?php get_template_part( 'template-parts/groups/groups', 'banner' ); ?>
<?php get_template_part( 'template-parts/groups/groups', 'locations' ); ?>
<?php get_template_part( 'template-parts/groups/groups', 'simple-text' ); ?>
<?php get_template_part( 'template-parts/groups/groups', 'banner-button' ); ?>
<?php get_template_part( 'template-parts/groups/groups', 'pre-footer' ); ?>


<?php
get_footer();
