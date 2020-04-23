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
                    <?php while (have_posts()) : the_post(); ?>
                        <div id="post-<?php the_ID(); ?>" <?php post_class('blog-page'); ?>>
                            <div class="blog-lg border-none">
                                <!--                                 
                                    <div class="date">
                                        <span>
                                            <a href="<?php echo esc_url(get_day_link(get_the_time('Y'), get_the_time('m'), get_the_time('d'))); ?>"><?php echo esc_html(get_the_date()); ?></a>
                                        </span>
                                     -->
                                <!-- </div> -->
                                <h3 class="blog-title">
                                    <?php the_title(); ?>
                                </h3>

                                <ul class="meta clearfix">
                                    <li class="author">
                                        <i class="fa fa-user"></i> <a href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>"><?php echo esc_html__('By', 'infruit'); ?> <?php the_author(); ?></a>
                                    </li>
                                    <li class="author">
                                        <i class="fa fa-clock-o"></i> <?php echo esc_html(get_the_date()); ?>
                                    </li>
                                    <?php if (has_category()) { ?>
                                        <li>
                                            <i class="fa fa-folder-open"></i>
                                            <span>
                                                <?php the_category(__(', ', 'infruit')); ?>
                                            </span>
                                        </li>
                                    <?php } ?>

                                </ul>

                                <?php if (get_field('image')) {
                                    $image = get_field('image') ?>
                                    <div class="featured-pic">
                                        <a target="_blank" href="<?php echo $image['url']; ?>"><img class="helpImage" src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" /></a>

                                    </div>
                                <?php } ?>
                                <div class="content">
                                    <?php the_content(); 
                                        if(get_field('desired_items')){
                                            echo "Desired Items: ". get_field('desired_items') . "<br>";
                                        }
                                        if(get_field('address')){
                                            echo "Address: ". get_field('address') ."<br>";
                                        }
                                        if(get_field('contact')){
                                            echo "Contact: ".get_field('contact') . "<br>";
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