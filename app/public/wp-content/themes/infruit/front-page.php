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


<!-- Service Section  -->
<?php get_template_part( 'front-parts/front-services' ); ?>

<!-- Callout Starts  -->
<?php get_template_part( 'front-parts/front-callout' ); ?>


<!-- Blog Starts  -->
<?php get_template_part( 'front-parts/front-content' );?>
<?php get_template_part( 'front-parts/front-blog' ); 


}
get_footer(); ?>