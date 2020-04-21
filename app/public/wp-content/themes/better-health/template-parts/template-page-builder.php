<?php
/**
 * Template Name: Page Template For Page Builder 
 *
 * @link https://developer.wordpress.org/themes/template-files-section/page-template-files/
 *
 * @package Canyon Themes
 * @subpackage Better Health
 */
get_header();

while ( have_posts() ) : the_post();

    the_content();

endwhile; // End of the loop.

get_footer();