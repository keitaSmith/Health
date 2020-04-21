<?php
  $infruit_hideslide = get_theme_mod('hide_slider', true);
  if($infruit_hideslide == ''){ 
  $slider_text1=get_theme_mod("infruit_slider_btntxt1");
  $slider_link_1=get_theme_mod("infruit_slider_btnurl1");
  $slider_text2=get_theme_mod("infruit_slider_btntxt2");
  $slider_link_2=get_theme_mod("infruit_slider_btnurl2");
   $infruit_slider_no        = 3;  
    $infruit_slider_pages      = array();
        for( $i = 1; $i <= $infruit_slider_no; $i++ ) {
        $infruit_slider_pages[]    =  get_theme_mod( "infruit_slider_page_$i", 1 );
        }
        $infruit_slider_args  = array(
        'post_type' => 'page',
        'post__in' => array_map( 'absint', $infruit_slider_pages ),
        'posts_per_page' => absint($infruit_slider_no),
        'orderby' => 'post__in'
        ); 
      ?>
  
  <!-- slider  -->
  <div class="slider-main" id="home">
    <div class="carousel bs-slider fade  control-round indicators-line" data-interval="5000" data-pause="hover" data-ride="carousel" id="big-dream-slider">
      <!-- Indicators -->
      <ol class="carousel-indicators">
        <?php $i = 0; 
         $infruit_slider_query1 = new WP_Query( $infruit_slider_args );  
         while ( $infruit_slider_query1->have_posts() ) : 
          $infruit_slider_query1->the_post(); ?>
            <li data-slide-to="<?php echo $i; ?>" data-target="#big-dream-slider"></li>
        <?php $i++; endwhile; ?>
      </ol>

      <!-- Wrapper For Slides -->
      <div class="carousel-inner" role="listbox">
        <?php 
    		$j = 0;
        $infruit_slider_query2 = new WP_Query( $infruit_slider_args );
        while($infruit_slider_query2->have_posts()):
          $infruit_slider_query2->the_post();
          ?>
            

            <!-- Third Slide -->
            <div class="item <?php echo $j == 0  ? 'fade active' : '' ; ?>">
              <!-- Slide Background -->
              <?php the_post_thumbnail();?>
              <div class="bs-slider-overlay"></div>
              <div class="inner-slide-box">
                <div class="container">
                  <!-- Slide Text Layer -->
                  <div class="row">
                    <div class="col-md-10 col-md-offset-1 text-center">
                      <div class="slide-text slide_style_left">
                            <h2 data-animation="animated zoomInRight"><span class="light-font"><?php the_title();  ?></span></h2>
                            <?php the_excerpt(); ?>
                            <?php if(!empty($slider_text1 && $slider_link_1)) : ?>
                            <a class="btn btn-default active" data-animation="animated fadeInUp" href="<?php echo esc_url($slider_link_1); ?>" target="_blank">
                                <?php echo esc_html($slider_text1); ?>     
                            </a>
                           <?php endif;  if(!empty($slider_text2 && $slider_link_2)) :?>
                            <a class="btn btn-default" data-animation="animated fadeInUp" href="<?php echo esc_url($slider_link_2); ?>" target="_blank">
                               <?php echo esc_html($slider_text2); ?>
                            </a>
                          <?php endif; ?>
                        </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- End of Slide -->

        <?php $j++; 
		   wp_reset_postdata();
	   	endwhile; ?>
      </div>
      <!-- End of Wrapper For Slides -->
      <!-- Left Control -->
      <a class="left carousel-control" data-slide="prev" href="#big-dream-slider" role="button">
        <span aria-hidden="true" class="fa fa-angle-left"></span>
        <span class="sr-only"><?php echo esc_html__('Previous','infruit'); ?></span>
      </a>
      <!-- Right Control -->
      <a class="right carousel-control" data-slide="next" href="#big-dream-slider" role="button">
        <span aria-hidden="true" class="fa fa-angle-right"></span>
        <span class="sr-only"><?php echo esc_html__('Next','infruit'); ?></span>
      </a>
    </div>
    <!-- End  bootstrap-touch-slider Slider -->
  </div>
  <!-- slider ends  --> 

  <?php  
 } else{
   infruit_breadcrumb(); 
}?>
<!-- Slider Ends  -->