<?php 
//breadcrump function

if( !function_exists('infruit_breadcrumb') ):
    function infruit_breadcrumb() { ?>
    <!-- Start page section -->
     <section class="page-section">
        <div class="page-title">
			<div class="overlay"></div>
			<div class="container">
				<?php if(is_home()): ?>
                        <h3><?php bloginfo('name'); ?></h3>
                        <?php else: ?>
                          <h3><?php if ( is_archive() ) {
                            echo esc_html(the_archive_title( '<h3>', '</h3>' ));
                          }
                           elseif(is_search()){

                          echo  esc_html__('Search Results For ', 'infruit') . ' " ' . get_search_query() . ' "';

                           }elseif ( is_404() ) {
                            echo  esc_html__('Nothing Found ', 'infruit');
                           }
                           else{
                            
                              echo esc_html( get_the_title() );
                              
                            } 
                           ?></h3>
                           <?php endif; ?>
				<ul class="breadcrumb">
					<?php breadcrumb_trail(); ?>
				</ul>
			</div>
		</div>
	 </section>
    <!-- End page section -->
		<?php 
    }
endif ; 
?>