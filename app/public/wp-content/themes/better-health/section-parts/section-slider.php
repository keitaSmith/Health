<?php
/**
 * The template for displaying all pages.
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Canyon Themes
 * @subpackage Better Health
 */
$better_health_slider_section_option = better_health_get_option('better_health_homepage_slider_option');
if ($better_health_slider_section_option != 'hide') {

    $better_health_slider_section_cat_id = better_health_get_option('better_health_slider_cat_id');
    $better_health_slider_view_more_txt = better_health_get_option('better_health_slider_view_more_txt');
    $better_health_get_started_text = better_health_get_option('better_health_slider_get_started_txt');
    $better_health_get_started_text_link = better_health_get_option('better_health_slider_get_started_link');

    $better_health_slider_category = get_category($better_health_slider_section_cat_id);

    //if polylang active
    if ( ! empty( $active_plugins ) && in_array( 'polylang/polylang.php', $active_plugins ) ) { 
        $better_health_slider_view_more_txt = pll__('Slider View More Text');
        $better_health_get_started_text = pll__('Get Started Text');
    }

    if(!empty($better_health_slider_section_cat_id))
    {
        
        $no_of_slider = better_health_get_option('better_health_no_of_slider');
        if ($no_of_slider > 0) {
            ?>
            <section id="slider" class="slider">
                <div id="main-slide" class="carousel slide" data-ride="carousel">

                    <!-- Wrapper for carousel items -->
                    <div class="carousel-inner">
                        <!--1st item start-->
                        <?php
                        $i = 0;
                        if (!empty($better_health_slider_section_cat_id)) {
                            $better_health_home_slider_section = array('cat' => $better_health_slider_section_cat_id, 'posts_per_page' => $no_of_slider);
                            $better_health_home_slider_section_query = new WP_Query($better_health_home_slider_section);
                            if ($better_health_home_slider_section_query->have_posts()) {

                                while ($better_health_home_slider_section_query->have_posts()) {
                                    $better_health_home_slider_section_query->the_post();
                                    ?>
                                    <div class="item <?php if ($i == 0) {
                                        echo "active";
                                    } ?>" style="background-image: url(<?php echo get_the_post_thumbnail_url( $post->ID, 'full' ); ?>);">
                                    
                                    
                                    <div class="slider-content text-center">
                                        <div class="col-md-12">
                                            <h3 class="slide-sub-title effect7"><?php the_title() ?></h3>
                                            <p class="slider-description lead effect7"><?php echo esc_html( wp_trim_words(get_the_content(), 10) ); ?> </p>
                                            <?php
                                            if (!empty($better_health_get_started_text)) {
                                                ?>
                                                <p class="effect3">
                                                    <a href="<?php echo esc_url($better_health_get_started_text_link); ?>" class="slider btn btn-primary">
                                                        <?php echo esc_html($better_health_get_started_text) ?>
                                                    </a>
                                                <?php } ?>
                                                <?php if(!empty($better_health_slider_view_more_txt)){ ?>
                                                <a href="<?php the_permalink(); ?>" class="slider btn btn-secondary">
                                                    <?php  
                                                        echo esc_html($better_health_slider_view_more_txt); ?>
                                                </a>
                                                <?php    } ?>
                                            </p>
                                        </div>
                                        <div class="over-bg"></div>
                                    </div>
                                </div>
                                <?php
                                $i++;
                            }
                        }
                        wp_reset_postdata();
                    }
                    ?>

                    <!--1st item end-->
                </div>
                <!-- Carousel controls -->

                <?php
                if ($no_of_slider > 1) {
                    ?>
                    <a class="carousel-control left" href="#main-slide" data-slide="prev">
                        <span class="carousel-arrow">
                            <i class="fa fa-angle-left fa-2x"></i>
                        </span>
                    </a>
                    <a class="carousel-control right" href="#main-slide" data-slide="next">
                        <span class="carousel-arrow">
                            <i class="fa fa-angle-right fa-2x"></i>
                        </span>
                    </a>

                <?php } ?>
            </div>
        </section>
    <?php } }
} ?>