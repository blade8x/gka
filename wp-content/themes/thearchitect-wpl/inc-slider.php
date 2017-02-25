<?php
/**
 * The default template for displaying Flexslider
 *
 * @package WordPress
 * @subpackage The Architect
 * @since The Architect 1.0.1
 */
?>

<?php 
	$wpl_sliders = ot_get_option( 'wpl_sliders', array() );
	$header_image = get_header_image();
	$page_featured_content = get_post_meta($post->ID, 'wpl_page_featured_content', true);
	$page_featured_height = get_post_meta($post->ID, 'wpl_page_featured_height', true);
?>

<?php if ( is_front_page() ){ ?>

	<?php // Display FlexSlider
	if ( ! empty( $wpl_sliders ) && ot_get_option('wpl_slider_revolution') == '' ) { ?>
		<div class="flexslider loading">
			<ul class="slides">
				<?php foreach( $wpl_sliders as $item ) : ?>
					<li style="background-image: url('<?php echo esc_url( $item['wpl_slider_item_image'] ); ?>');">
						<div class="flex-caption ">
							<div class="flex-content container_16">
								<div class="grid_16">
									<?php if ( $item['wpl_slider_item_title'] != "") { ?>
										<h1 class="huge-title" <?php if ( $item['wpl_slider_item_title_color'] != "") { ?> style="color: <?php echo $item['wpl_slider_item_title_color']; ?>;" <?php } ?>><?php echo $item['wpl_slider_item_title']; ?></h1>
									<?php } ?>
									
									<?php if ( $item['wpl_slider_item_description'] != "") { ?>
										<p class="lead" <?php if ( $item['wpl_slider_item_description_color'] != "") { ?> style="color: <?php echo $item['wpl_slider_item_description_color']; ?>;" <?php } ?>><?php echo $item['wpl_slider_item_description']; ?></p>
									<?php } ?>

									<?php if ( $item['wpl_slider_item_url'] != "") { ?>
										<div class="flex-button"><a href="<?php echo $item['wpl_slider_item_url']; ?>"><?php echo $item['wpl_slider_item_button_text']; ?></a></div>
									<?php } ?>
								</div>	
							</div>
						</div>
					</li>
				<?php endforeach; ?>
			</ul>
		</div>
	<?php

	} elseif ( ot_get_option( 'wpl_slider_revolution') != '' ){ ?>
		<div class="revolution-slider">
			<?php putRevSlider( ot_get_option( 'wpl_slider_revolution') ); ?>
		</div>
		<?php 
	} elseif ( has_post_thumbnail() ) { ?>
			
		<div class="entry-header cf" style="height: <?php echo $page_featured_height; ?>">
			
			<?php if($page_featured_content) { ?>
				<div class="inner">
					<div class="wrap">
						<?php echo $page_featured_content; ?>
					</div>
				</div>
			<?php } ?>

			<?php the_post_thumbnail('full'); ?>
		</div>

	<?php } else {
		if (! empty( $header_image ) ) { ?>

			<div class="entry-header cf" style="height: <?php echo $page_featured_height; ?>">
				
				<?php if($page_featured_content) { ?>
					<div class="inner">
						<div class="wrap">
							<?php echo $page_featured_content; ?>
						</div>
					</div>
				<?php } ?>

				<img class="header-image" src="<?php header_image(); ?>" height="<?php echo get_custom_header()->height; ?>" width="<?php echo get_custom_header()->width; ?>" alt="" />

			</div>

		<?php }
	} ?>

<?php } elseif ( has_post_thumbnail() ) { ?>
			
	<div class="entry-header cf" style="height: <?php echo $page_featured_height; ?>; margin-top:10px;">
		
		<?php if($page_featured_content) { ?>
			<div class="inner">
				<div class="wrap">
					<?php echo $page_featured_content; ?>
				</div>
			</div>
		<?php } ?>

		<?php the_post_thumbnail('full'); ?>
	</div>

<?php }
