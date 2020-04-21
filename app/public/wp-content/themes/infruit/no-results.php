<?php
/**
 * The template part for displaying a message that posts cannot be found.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Infruit
 */
?>


	
<header>
	<h1 class="entry-title"><?php __( 'Nothing Found', 'infruit' ); ?></h1>
</header>

<?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>

	<p><?php printf(__('Ready to publish your first post?', 'infruit') . ' <a href="%1$s">' . __('Get started here', 'infruit') . '</a>', esc_url(admin_url('post-new.php'))); ?></p> 

<?php elseif ( is_search() ) : ?>

	<p><?php echo esc_html__( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'infruit' ); ?></p><br />
	<?php get_search_form(); ?>

<?php else : ?>

	<p><?php echo esc_html__( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'infruit' ); ?></p><br />
	<?php get_search_form(); ?>

<?php endif; ?>