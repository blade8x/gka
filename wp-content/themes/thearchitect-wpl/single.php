<?php 
/**
 * The default template for displaying Single posts
 *
 * @package WPlook
 * @subpackage The Architect
 * @since The Architect 1.0
 */
 ?>

 <?php get_header(); ?>

	<div id="content">

		<div id="inner-content" class="cf">

			<section id="main" class="m-all t-all d-all cf" role="main">

				<div class="blog_content">
				<?php if (have_posts()) : while (have_posts()) : the_post();

					get_template_part( 'content', get_post_format() );

				endwhile;

				else : ?>

				<article id="post-not-found" class="hentry cf">
						<header class="article-header">
							<h1><?php _e( 'Oops, Post Not Found!', 'thearchitect-wpl' ); ?></h1>
						</header>
				</article>

				<?php endif; ?>
				</div>

			</section>

			<?php //comments_template(); ?>

		</div>

	</div>

<?php get_footer(); ?>
