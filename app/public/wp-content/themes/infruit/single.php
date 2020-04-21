<?php
/**
 * The Template for displaying all single posts.
 *
 * @package Infruit
 */

get_header(); ?>


<!-- page section -->
    <section class="page-section" id="content">
        <?php infruit_breadcrumb(); ?>
        <div class="pages">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 col-sm-8 col-lg-9">
                         <?php while ( have_posts() ) : the_post(); ?>
                             <?php get_template_part( 'content', 'single' );  
                             // Previous/next post navigation.
								the_post_navigation( array(
									'next_text' => '<span class="meta-nav">' . __( 'NEXT POST - ', 'infruit' ) . '</span> <span class="post-title">%title</span>',
									'prev_text' => '<span class="meta-nav">' . __( 'PREVIOUS POST - ', 'infruit' ) . '</span> <span class="post-title">%title</span>',
								) );
                            // If comments are open or we have at least one comment, load up the comment template
                            if ( comments_open() || '0' != get_comments_number() )
                               comments_template();
                        ?>
                        <?php endwhile; // end of the loop. ?>
                    </div>
                    
                    <div class="col-md-4 col-sm-4 col-lg-3">
                       <?php get_sidebar();?>     
                     </div>
                </div>
            </div>
        </div>
    </section>

<?php get_footer(); ?>