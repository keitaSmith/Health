<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package Infruit
 */

get_header(); ?>

  <section class="error-page pTBM-120">
        <div class="container">
            <div class="row">
                <div class="error-box text-center">
                    <h1><?php echo esc_html__( '404', 'infruit' ); ?></h1>
                    <h2><span><?php echo esc_html__('Oops!','infruit') ?></span><?php echo esc_html__( 'That page can not be found', 'infruit' ); ?> </h2>
                    <p><?php echo esc_html__( 'Sorry, but the page you are looking for does not exist', 'infruit' ); ?></p>
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn-custom abt-read-btn"> <?php echo esc_html__( 'Back To Home', 'infruit' ); ?></a>
                </div>
            </div>
        </div>
   </section>

<?php get_footer(); ?>