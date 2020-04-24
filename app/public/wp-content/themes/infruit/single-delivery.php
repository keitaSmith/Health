<?php

/**
 * The Template for displaying all single service posts.
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
                    <?php while (have_posts()) : the_post(); ?>
                        <div id="post-<?php the_ID(); ?>" <?php post_class('blog-page'); ?>>
                            <div class="blog-lg border-none">
                                <h3 class="blog-title">
                                    <?php the_title(); ?>
                                </h3>
                                <?php if (get_field('image')) {
                                    $image = get_field('image') ?>
                                    <div class="featured-pic">
                                        <a target="_blank" href="<?php echo $image['url']; ?>"><img class="helpImage" src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" /></a>
                                    </div>
                                <?php } ?>
                                <div class="content">
                                    <?php the_content(); 
                                        if(get_field('facebook_page')){
                                            echo "<h4>Facebook Page</h4> <a href=".get_field('facebook_page') .">". get_field('facebook_page') . "</a><br>";
                                        }
                                        if(get_field('contact')){
                                            echo "<h4>Contact</h4> ".get_field('contact') . "<br>";
                                        }
                                    ?>
                                    <?php
                                    wp_link_pages(array(
                                        'before' => '<div class="page-links">' . __('Pages:', 'infruit'),
                                        'after'  => '</div>',
                                    ));
                                    ?>

                                    <div class="row">
                                        <div class="col-md-7">
                                            <?php if (has_tag()) : ?>
                                                <ul class="d-tags">
                                                    <li>
                                                        <?php the_tags(__('Tags: ', 'infruit'), ' ', '<br />'); ?>
                                                    </li>
                                                </ul>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                        // Previous/next post navigation.

                        the_post_navigation(array(
                            'next_text' => '<span class="meta-nav">' . __('NEXT POST - ', 'infruit') . '</span> <span class="post-title">%title</span>',
                            'prev_text' => '<span class="meta-nav">' . __('PREVIOUS POST - ', 'infruit') . '</span> <span class="post-title">%title</span>',
                        ));
                        // If comments are open or we have at least one comment, load up the comment template
                        if (comments_open() || '0' != get_comments_number())
                            comments_template();
                        ?>
                    <?php endwhile; // end of the loop. 
                    ?>
                </div>

                <div class="col-md-4 col-sm-4 col-lg-3">
                    <?php get_sidebar(); ?>
                </div>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>