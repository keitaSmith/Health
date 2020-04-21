<?php
/**
 * @package Infruit
 */
?>
<!-- post -->
<div class="blog-page">
	<article class="blogg" id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<div class="featured-pic">
			<?php the_post_thumbnail(); ?>
				<div class="date">
					<?php the_category( __( ', ', 'infruit' ));?>
				</div>
		</div>
		<div class="blog-inner-box">
			<h4>
				<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
			</h4>
			<ul class="meta clearfix">
				<li class="author">
					<i class="fa fa-user"></i> <a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>"><?php echo esc_html__( 'By', 'infruit' ); ?> <?php the_author() ; ?></a>
				</li>
				<li class="author">
					<i class="fa fa-clock-o"></i> <?php echo esc_html(get_the_date()); ?>
				</li>
			</ul>
			<?php the_excerpt(); ?>
				<?php
					wp_link_pages( array(
						'before' => '<div class="page-links">' . __( 'Pages:', 'infruit' ),
						'after'  => '</div>',
					) );
				?>
			<a class="read-more gTransition" href="<?php the_permalink(); ?>"><?php echo esc_html__('Read More','infruit'); ?></a>
		</div>
	</article>
</div>
<!-- post end -->