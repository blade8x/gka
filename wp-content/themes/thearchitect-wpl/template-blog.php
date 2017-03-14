<?php
/**
 * Template Name: Blog
 *
 * @package WordPress
 * @subpackage The Architect
 * @since The Architect 1.0
 */
?>

<?php get_header(); ?>
<?php
	$pid = $post->ID;
	$post_columns = get_post_meta( $pid, 'wpl_post_columns', true);
	$post_number = get_post_meta( $pid, 'wpl_post_number', true);
?>	
<section id="main" class="wrap cf" role="main">

	<div class="m-all t-all d-all">

		<div id="inner-content" class="blog_content cf">

			<?php $args = array( 'post_type' => 'post','post_status' => 'publish', 'posts_per_page' => get_option( 'posts_per_page' ), 'paged'=> $paged ); ?>
			<?php $wp_query = null; ?>
			<?php $wp_query = new WP_Query( $args ); ?>
			<?php if ( $wp_query->have_posts() ) : while ( $wp_query->have_posts() ) : $wp_query->the_post(); ?>

					<?php get_template_part( 'content', get_post_format() ); ?>

				<?php endwhile; else : ?>

					<?php get_template_part( 'content', 'none' ); ?>

				<?php endif; ?>


			<?php bones_page_navi() ?>
		</div>

	</div>

</section>

<?php get_footer(); ?>