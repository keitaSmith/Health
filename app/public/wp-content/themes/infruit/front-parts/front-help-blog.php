<?php
$infruit_hideblog = get_theme_mod('hide_blog', false);
$infruit_blog_title = get_theme_mod('blog_title', 'Those in Need During The Covid-19 Pandemic');
if ($infruit_hideblog == '') {

?>
    <!-- blog posts  -->
    <section class="posts-section pTBM-120" id="blog">
        <div class="title-container">
            <h3 class="cmn-title-pic blog-head"><?php echo esc_html($infruit_blog_title); ?></h3>
            <div class="title-icon">
                <span></span>
            </div>
        </div>
        <div class="blogs">
            <div class="container">
                <div class="row">
                    <?php
                    $latest_blog_posts = new WP_Query(
                        array(
                            'posts_per_page' => 3,
                            'post_type' => 'help'
                        )
                    );
                    if ($latest_blog_posts->have_posts()) :
                        while ($latest_blog_posts->have_posts()) :
                            $latest_blog_posts->the_post();  ?>
                            <!-- post -->
                            <div class="col-md-4 col-sm-6">
                                <article class="blog">
                                    <?php if (has_post_thumbnail()) { ?>
                                        <div class="featured-pic">
                                            <?php the_post_thumbnail(); ?>
                                            <div class="date">
                                                <span><?php the_category(__(', ', 'infruit')); ?></span>
                                            </div>
                                        </div>
                                    <?php } ?>
                                    <div class="blog-inner-box">
                                        <h4>
                                            <a href="<?php echo esc_url(get_permalink()); ?>"><?php the_title(); ?></a>
                                        </h4>
                                        <ul class="meta clearfix">
                                            <li class="author">
                                                <i class="fa fa-user"></i> <a href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>"><?php echo esc_html__('By', 'infruit'); ?> <?php the_author(); ?></a>
                                            </li>
                                            <li class="author">
                                                <i class="fa fa-clock-o"></i> <?php echo esc_html(get_the_date()); ?>
                                            </li>
                                        </ul>
                                        <p class="content"><?php the_excerpt(); ?></p>
                                        <a class="read-more gTransition" href="<?php echo esc_url(get_permalink()); ?>" target="_blank">
                                            <?php echo esc_html__('Read More', 'infruit'); ?>
                                        </a>
                                    </div>
                                </article>
                            </div>
                            <!-- post end -->

                    <?php
                            wp_reset_postdata();
                        endwhile;
                    endif;
                    ?>
                </div>
            </div>
    </section>
    <!-- blog post ends  -->
<?php }
?>