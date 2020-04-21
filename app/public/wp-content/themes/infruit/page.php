<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package Infruit
 */

get_header(); ?>

    <?php infruit_breadcrumb(); ?>
    
   <!-- Page section  -->
    <main class="about p-same bg-white" id="content">
        <div class="container of-hide">

            <div class="row">
                <div class="col-md-8 col-sm-8 col-lg-9">
                    <?php while ( have_posts() ) : the_post(); ?>
                <?php get_template_part( 'content', 'page' ); ?>
                <?php
                //If comments are open or we have at least one comment, load up the comment template
                    if ( comments_open() || '0' != get_comments_number() )
                        comments_template();
                ?>
            <?php endwhile; // end of the loop. ?>
                </div>
                <div class="col-md-4 col-sm-4 col-lg-3">
                    <?php get_sidebar(); ?>
                </div>
            </div>
        </div>
    </main>
    <!-- Page section  ends -->
<?php get_footer(); ?>