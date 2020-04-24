<?php

/**
 * Template Name: Delivery Services
 * 
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
                $delivery_posts = new WP_Query(
                    array(
                        //'posts_per_page' => 3,
                        'post_type' => 'delivery'
                    )
                );
                //echo $latest_blog_posts->the_post();
                if ($delivery_posts->have_posts()) :
                    while ($delivery_posts->have_posts()) :
                        $delivery_posts->the_post();
                        $image = get_field('image');
                ?>
                        <div class="blog-page">
                            <article class="blogg" id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                                <div class="blog-inner-box">
                                    <h4>
                                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                    </h4>
                                    <?php if (!empty($image)) { ?>
                                        <div class="featured-pic">
                                        <a target="_blank" href="<?php echo $image['url']; ?>"><img class="helpImage" src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" /></a>
                                        </div>
                                    <?php } ?>
                                    <?php the_excerpt(); ?>
                                    <?php
                                    wp_link_pages(array(
                                        'before' => '<div class="page-links">' . __('Pages:', 'infruit'),
                                        'after'  => '</div>',
                                    ));
                                    ?>
                                    <a class="read-more gTransition" href="<?php the_permalink(); ?>"><?php echo esc_html__('Read More', 'infruit'); ?></a>
                                </div>
                            </article>
                        </div>
                <?php
                    endwhile;
                    // Previous/next post navigation.
                    the_posts_pagination();

                else :
                    // If no content, include the "No posts found" template.
                    get_template_part('no-results');

                endif;
                ?>
            </div>
            <div class="col-md-4 col-sm-4 col-lg-3">
                <?php get_sidebar(); ?>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>