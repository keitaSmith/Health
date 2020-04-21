<?php
 $infruit_about_read_link = get_theme_mod('about_read_link');
 $infruit_about_text = get_theme_mod('about_text');
 $infruit_hideabout = get_theme_mod('hide_about', false);
 if($infruit_hideabout == ''){   
 $infruit_pages = array();
    $mod = absint( get_theme_mod('infruit_about_page'));
      $infruit_pages[] = $mod;

    if( !empty($infruit_pages) ) :
        $args = array(
          'posts_per_page' => 1,
          'post_type' => 'page',
          'post__in' => $infruit_pages,
          'orderby' => 'post__in'
        );
        $infruit_about_query = new WP_Query( $args );
        if ( $infruit_about_query->have_posts() ) :
            $infruit_about_query->the_post(); 
            $aid = 1;
            ?>

            <!-- about section  -->
            <main class="about pTBM-120 bg-white" id="about-section">
                <div class="container of-hide">
                    <div class="title-container">
                        <h3 class=" cmn-title-pic abt-title mTB-50"><?php the_title(); ?></h3>
                        <div class="title-icon">
                            <span></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-sm-4 col-md-push-6">
                            <div class="abt-pic wow animated fadeInRight " data-wow-delay="0.3s">
                                <figure>
                                    <?php the_post_thumbnail(); ?>
                                </figure>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-8 col-md-pull-6">
                            <div class="abt-content">
                                <?php the_content(); ?>
                                
                            </div>
                            <?php if(!empty($infruit_about_text && $infruit_about_read_link)) : ?>
                            <a class="btn-custom read-more slide-effect gTransition wow animated slideInUp" data-animation="animated fadeInUp" href="<?php echo esc_url($infruit_about_read_link ); ?>" target="_blank">
                                <?php echo esc_html($infruit_about_text);?>
                            </a>
                           <?php endif; ?>
                        </div>
                    </div>
                </div>
            </main>
            <!-- about section  ends -->
        <?php 
        wp_reset_postdata();
        endif; 
endif;
} ?>

<!-- About Ends  -->