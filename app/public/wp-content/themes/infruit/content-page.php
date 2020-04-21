<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package Infruit
 */
?>

<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
   <div class="col-md-12">
        <div class="abt-pic wow animated fadeInRight hover-box" data-wow-delay="0.3s">
            <figure>
                <?php the_post_thumbnail(); ?>
            </figure>
        </div>
    </div>
    <div class="col-md-12">
        <div class="abt-content">
            <?php the_content(); ?>
                <?php
                    wp_link_pages( array(
                        'before' => '<div class="page-links">' . __( 'Pages:', 'infruit' ),
                        'after'  => '</div>',
                ) );
            ?>
        </div>
    </div>
    
</div>