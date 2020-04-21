<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package Infruit
 */
?>

    <?php 


    $hidefooter = get_theme_mod('hide_footer',false);    

    //Set widget areas classes based on user choice
		$widget_areas = get_theme_mod('footer_widget_areas', '3');
		if ($widget_areas == '3') {
			$cols = 'col-md-4';
		} elseif ($widget_areas == '4') {
			$cols = 'col-md-3';
		} elseif ($widget_areas == '2') {
			$cols = 'col-md-6';
		} else {
			$cols = 'col-md-12';
		}
	?>

<?php
  if($hidefooter == ''){   ?>

    <footer class="pTBM-120">
        <div class="container">
            <div class="row">
                <?php if ( is_active_sidebar( 'footer-1' ) ) : ?>
                    <div class="<?php echo esc_attr($cols); ?>">
                       <?php dynamic_sidebar( 'footer-1'); ?>
                    </div>
                <?php endif; ?>
                <?php if ( is_active_sidebar( 'footer-2' ) ) : ?>
                    <div class="<?php echo esc_attr($cols); ?>">
                       <?php dynamic_sidebar( 'footer-2'); ?>
                    </div>
                <?php endif; ?>
                <?php if ( is_active_sidebar( 'footer-3' ) ) : ?>
                    <div class="<?php echo esc_attr($cols); ?>">
                        <?php dynamic_sidebar( 'footer-3'); ?>
                    </div>
                <?php endif; ?>
                <?php if ( is_active_sidebar( 'footer-4' ) ) : ?>
                    <div class="<?php echo esc_attr($cols); ?>">
                        <?php dynamic_sidebar( 'footer-4'); ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </footer>
<?php } ?>


    <div class="copyright pTB-30">
        <span class="wow animated fadeInUp" data-wow-delay=".2s">&copy; <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>  <?php echo esc_html(date_i18n(__( 'Y', 'infruit' ) )); ?>. <?php echo esc_html__('Proudly Powered by WordPress','infruit'); ?></span>
    </div>       
<?php wp_footer(); ?>

</body>
</html>