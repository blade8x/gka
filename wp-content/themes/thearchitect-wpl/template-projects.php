<?php
/**
 * Template Name: Template Projects
 *
 * @package WordPress
 * @subpackage The Architect
 * @since The Architect 1.0.0
 */
?>
<?php get_header(); ?>
<?php
	$pid = $post->ID;
	$layout = get_post_meta( $pid, 'wpl_project_columns', true);
	$projects_number = get_post_meta( $pid, 'wpl_projects_number', true);
	$page_excerpt = get_post_meta( $pid, 'wpl_page_excerpt', true);
?>	
<section id="main" class="cf" role="main">

	<div class="m-all t-all d-all">
		<?php $args = array( 'post_type' => 'projects','post_status' => 'publish', 'posts_per_page' => $projects_number, 'paged'=> $paged); ?>
		<?php $wp_query = null; ?>
		<?php $wp_query = new WP_Query( $args ); ?>
			<?php if ( $wp_query->have_posts() ) : ?>

			<div class="module-title wrap cf module-project-title" style="padding: 20px 0 20px 0;">
				<div class="two_third">
					<h2 class="uppercase"><?php the_title(); ?></h2>
					<?php if ( $page_excerpt != '') { ?>
						<p><?php echo $page_excerpt; ?></p>
					<?php } ?>
					
				</div>

				<div class="one_third last">
					<div class="filter right">
						<a class="btn medium black" href="<?php echo get_permalink( ot_get_option('wpl_projects_page')); ?>"><?php _e( 'All Projects', 'thearchitect-wpl' ); ?></a>
						<ul>
							<li><a href=""><?php _e('By sectors', 'thearchitect-wpl'); ?> <span>&rsaquo;</span></a>
								<ul class="sectors">
								<?php
									$terms = get_terms('projects_cat');
									foreach ($terms as $term) {
									echo "<li><a href=" . esc_attr(get_term_link($term, 'projects_cat')) . " title=" . sprintf( __( "View all projects in %s", 'thearchitect-wpl' ), $term->name ) . ">" . $term->name . "</a></li>";
									}
								?>
								</ul>
							</li>
						</ul>
                                                <?php
                                                // get meta location
                                                global $wpdb;
                                                $pr_locations = $wpdb->get_results( "SELECT * FROM `wp_postmeta` WHERE `meta_key` = 'sbwp_project_location' GROUP BY `meta_value`" );
                                                if(!empty($pr_locations)){
                                                ?>
                                                <ul>
                                                    <li><a href=""><?php _e('By locations', 'thearchitect-wpl'); ?> <span>&rsaquo;</span></a>
                                                    <ul class="locations">
                                                <?php
                                                    foreach($pr_locations as $pr_location){
                                                        echo "<li><a href='".esc_url( add_query_arg(['location'=>$pr_location->meta_value]) )."' title='" . sprintf( __( "View all projects in %s", 'thearchitect-wpl' ), $pr_location->meta_value ) . "'>" . $pr_location->meta_value . "</a></li>";
                                                    }
                                                ?>
                                                    </ul>
                                                </li>
                                                </ul>
                                                <?php
                                                }
                                                ?>
					</div>
				</div>
			</div>

			<div class="block-grid projects-listing <?php echo $layout; ?> cf">

				<?php while ( $wp_query->have_posts() ) : $wp_query->the_post();
					$terms = wp_get_post_terms(get_the_ID(), 'projects_cat');
					$project_text_color = get_post_meta(get_the_ID(), 'wpl_project_text_color', true);
					$project_location = get_post_meta(get_the_ID(), 'wpl_project_location', true);
					
					$post_featured_image = get_post_thumbnail_id(get_the_ID());
					if ($post_featured_image) {
						$project_thumbnail = wp_get_attachment_image_src( $post_featured_image, 'full', false);
						if ($project_thumbnail) (string)$project_thumbnail = $project_thumbnail[0];
					}
					?>

					<?php
						if($layout == "columns-2"){
							echo "<article class='block-item half-width half-height cf'>";
						} elseif($layout == "columns-3") {
							echo "<article class='block-item third-width third-height cf'>";
						} elseif($layout == "columns-4") {
							echo "<article class='block-item quarter-width quarter-height cf'>";
						} else {
							echo "<article class='block-item third-width third-height cf'>";
						}
					?>
							<a href="<?php the_permalink(); ?>" rel='bookmark' title="<?php the_title(); ?>">
								<div class="image" style="background-image: url(<?php echo $project_thumbnail; ?>);"></div>
								<div class="text <?php echo $project_text_color; ?>">
									<h1><?php the_title(); ?></h1>
									<span class="line medium <?php echo $project_text_color; ?>"></span>
									<p style='color: #f6921e !important;'>
									<?php
										if($terms) { $numTerms = count($terms); $i = 1;
											foreach($terms as $term) {
												echo "$term->name";
											if($i < $numTerms)
												echo ", ";
											$i++; }
										};
										if( $terms && $project_location ) {
											echo ", ";
										}
										if($project_location) {
											echo $project_location;
										}
									?>
									</p>
								</div>
							</a>
						</article>

				<?php endwhile; ?>

		</div>

		<?php else : ?>
		<div class="entry-content cf">
			<div class="inner">
				<div class="wrap">
					<article id="post-not-found" class="hentry cf">
						<header class="article-header">
							<h1><?php _e( 'Oops, Projects Not Found!', 'thearchitect-wpl' ); ?></h1>
						</header>
					</article>
				</div>	
			</div>
		</div>	
	<?php endif; ?>
	
	<?php bones_page_navi() ?>
	
	</div>

</div>


<?php get_footer(); ?>
