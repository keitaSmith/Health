<?php
/**
 * @package Infruit
**/ ?>

<!-- post -->
<div id="post-<?php the_ID(); ?>" <?php post_class('blog-page'); ?>>
	<div class="blog-lg border-none">
		<div class="featured-pic">
			<?php if (has_post_thumbnail() ){
				the_post_thumbnail();
			} ?>
			<div class="date">
				<span>
					<a href="<?php echo esc_url( get_day_link( get_the_time('Y'), get_the_time('m'), get_the_time('d') ) ) ; ?>"><?php echo esc_html(get_the_date()); ?></a>
				</span>
			</div>
		</div>
		<h3 class="blog-title">
			<?php the_title(); ?> 
		</h3>
		<ul class="meta">
			<li>
				<i class="fa fa-user"></i>
				<span><?php echo esc_html__( 'By', 'infruit' ); ?>
					<a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>"><?php the_author() ; ?></a>
				</span>
			</li>
			<?php if(has_category()){ ?>
			<li>
				<i class="fa fa-folder-open"></i>
				<span>
					<?php the_category( __( ', ', 'infruit' ));?>
				</span>
			</li>
			<?php } ?>
			<li>
				<i class="fa fa-comment-o"></i>
				<span>
					<?php comments_popup_link(); ?>
				</span>
			</li>
		</ul>
		<div class="content">
			<?php the_content(); ?>
			<?php
			 wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'infruit' ),
				'after'  => '</div>',
			) );
			?>

			<div class="row">
				<div class="col-md-7">
					<?php if (has_tag()) : ?>
					<ul class="d-tags">                                                
						<li>
							<?php the_tags(__('Tags: ','infruit'), ' ', '<br />'); ?>
						</li>
					</ul>
					<?php endif ; ?>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- post end -->