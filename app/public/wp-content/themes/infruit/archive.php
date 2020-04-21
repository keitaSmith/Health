<?php
/**
 * The template for displaying Archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Infruit
 */

get_header(); 
infruit_breadcrumb(); ?>
    <!-- End page section -->
    <section class="pages">
        <div class="container">
            <div class="row">
                
                <div class="col-md-8 col-sm-8 col-lg-9">

                    <?php
                    // Start the Loop.
                        if ( have_posts() ) : ?>
                        
                            <?php while ( have_posts() ) : the_post();
                                get_template_part( 'content', get_post_format() );
                            endwhile;
                            // Previous/next post navigation.
                            the_posts_pagination();
                
                        else :
                        // If no content, include the "No posts found" template.
                           get_template_part( 'no-results' );
                
                        endif;
                     ?>
                </div>
                <div class="col-md-4 col-sm-4 col-lg-3">
                    <?php get_sidebar();?>
                </div>
            </div>
        </div>
    </section>

<?php get_footer(); ?>