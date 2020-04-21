<?php
$infruit_hideservice = get_theme_mod('hide_service', false);
$service_title = get_theme_mod('service_title');
if($infruit_hideservice == ''){   
     $infruit_service_no        = 6;  
     $infruit_service_pages      = array();
        for( $i = 1; $i <= $infruit_service_no; $i++ ) {
        $infruit_service_pages[]    =  get_theme_mod( "infruit_service_page_$i", 1 );
        $infruit_service_page_icon[]    =  get_theme_mod( "infruit_service_page_icon_$i", 'fa-facebook' );

        }
        $infruit_service_args  = array(
        'post_type' => 'page',
        'post__in' => array_map( 'absint', $infruit_service_pages ),
        'posts_per_page' => absint($infruit_service_no),
        'orderby' => 'post__in'
        ); 
?>

        <!-- what we do section  -->
        <div class="we-do-section pTBM-120 bg-gray" id="work">
            <div class="container">
              <?php if(!empty($service_title)) { ?>
                <div class="title-container ">
                    <h3 class="cmn-title-pic cmn-title-pic we-do-title"> <?php echo esc_html($service_title);?></h3>
                    <div class="title-icon ">
                        <span></span>
                    </div>
                </div>
              <?php } ?>
                <div class="row">
                    <?php
                      $i = 0;
                      $infruit_service_query = new WP_Query( $infruit_service_args );
                      while ( $infruit_service_query->have_posts() ) : 
                        $infruit_service_query->the_post();
                      
                        ?>

                         <div class="col-sm-4">
                           
                            <div class="info-box pTB-30 fadeInUp animated wow gTransition " data-wow-delay="0.2s">
                                
                                    <div class="icon2"></div>
                                    <div class="icon">
                                      <i class="fa <?php echo esc_attr($infruit_service_page_icon[$i]); ?>" aria-hidden="true"></i>
                                    </div>
                                
                                      <h4><a href="<?php the_permalink(); ?>" target="_blank"><?php the_title(); ?></a></h4>
                                      <?php the_excerpt(); ?>
                               
                            </div>
                        </div>
                    <?php
                      $i++;
                       wp_reset_postdata();
                      endwhile;
                    ?> 
                       
                </div>
            </div>
        </div>
<!-- what we do section  ends -->

<?php 

} ?>

<!-- Service Ends  -->