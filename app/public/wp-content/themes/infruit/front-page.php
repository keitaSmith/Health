<?php
/**
 *
 * @package Infruit
 */

get_header();

            
if (!is_home() && is_front_page()) {
 ?>
<!-- Slider Section  -->
<?php get_template_part( 'front-parts/front-slider' ); ?>
<!-- About Section  -->
<?php get_template_part( 'front-parts/front-about' ); ?>
<?php get_template_part( 'front-parts/front-content' );?>
<!-- Blog Starts  -->
<?php get_template_part( 'front-parts/front-help-blog' );



}
get_footer(); ?>