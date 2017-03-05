<?php
/**
 * Custom Functions
 *
 * @package WordPress
 * @subpackage Library
 * @since Library 1.0
 */


global $sbwp_options;

// Comment Layout
function wpl_comments( $comment, $args, $depth ) {
   $GLOBALS['comment'] = $comment; ?>
  <div id="comment-<?php comment_ID(); ?>" <?php comment_class('cf'); ?>>
    <article  class="cf">
      <header class="comment-author vcard">
        <?php echo get_avatar( get_the_author_meta('ID'), '72' ); ?>
        <?php printf(__( '<h4 class="fn">%1$s</h4>', 'thearchitect-wpl' ), get_comment_author_link() ) ?>
        <time datetime="<?php echo comment_time('Y-m-j'); ?>"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>"><?php comment_time(__( 'F jS, Y', 'thearchitect-wpl' )); ?> </a></time>

      </header>
      <?php if ($comment->comment_approved == '0') : ?>
        <div class="alert alert-info">
          <p><?php _e( 'Your comment is awaiting moderation.', 'thearchitect-wpl' ) ?></p>
        </div>
      <?php endif; ?>
      <section class="comment_content cf">
        <?php comment_text() ?>
        <?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
      </section>
    </article>
  <?php // </li> is added by WordPress automatically ?>
<?php
} // don't remove this bracket!

/*-----------------------------------------------------------------------------------*/
/*  Remove colour from Google Web Fonts options for body and headings
/*-----------------------------------------------------------------------------------*/

if( !function_exists( 'wplook_optiontree_typography_colours_filter' ) ) {

	function wplook_optiontree_typography_colours_filter( $array, $field_id ) {

		if( $field_id == 'wpl_fonts_body' || $field_id == 'wpl_fonts_heading' ) {

			$array = array_diff( $array, array( 'font-color', 'font-style', 'font-size' ) );

		}

		return $array;

	}

	add_filter( 'ot_recognized_typography_fields', 'wplook_optiontree_typography_colours_filter', 10, 2 );

}


/*-----------------------------------------------------------------------------------*/
/*  Echo CSS for custom fonts function
/*
/*  This function is used to enter the correct CSS for typography elements defined
/*  in OptionTree. It takes a CSS selector as $selector and an OT ID as $ot_option_id.
/*  Every option must also be accompanied by an option with the same name, but ending
/*  in _bool.
/*-----------------------------------------------------------------------------------*/

if( !function_exists( 'wplook_optiontree_typography_echo_font' ) ) {

	function wplook_optiontree_typography_echo_font( $selector, $ot_option_id ) {

		$font = ot_get_option( $ot_option_id );

		if( ot_get_option( $ot_option_id . '_bool' ) == 'on' ) : ?>

			<style id="<?php echo $ot_option_id . '_style'; ?>">

				<?php echo $selector; ?> {

					<?php foreach( $font as $attribute => $value ) {

						// Correct the attribute name
						if( $attribute == 'font-color' ) {
							$attribute = 'color';
						}

						if( $attribute == 'font-family' ) {
							$google_fonts = get_theme_mod( 'ot_google_fonts', array() ); // Get list of all available Google Fonts

							if( array_key_exists( $value, $google_fonts ) ) {
								echo 'font-family: "' . $google_fonts[$value]['family'] . '", sans-serif; '; // Find the correct font-family name in said list
							} else {
								echo 'font-family: ' . $value . ', sans-serif; '; // Output the font name as is
							}
						} elseif( !empty( $value ) ) {
							echo $attribute . ': ' . $value . '; '; // Echo all other attributes
						}

					} ?>

				}

			</style>

		<?php endif;

	}

}


/*-----------------------------------------------------------------------------------*/
/*  Echo CSS for defined custom fonts
/*
/*  This is where the above function is used to actually output the CSS
/*  based on the function variables entered here
/*-----------------------------------------------------------------------------------*/

if( !function_exists( 'wplook_optiontree_typography_echo_fonts' ) ) {

	function wplook_optiontree_typography_echo_fonts() {

		wplook_optiontree_typography_echo_font( 'html, body, p, cite', 'wpl_fonts_body' );
		wplook_optiontree_typography_echo_font( 'h1, .h1, h2, .h2, h3, .h3, h4, .h4, h5, .h5, .nav li a', 'wpl_fonts_heading' );

	}

	add_action( 'wp_head', 'wplook_optiontree_typography_echo_fonts', 100 );

}


/*-----------------------------------------------------------------------------------*/
/*  Page Navi - Numeric pagination
/*-----------------------------------------------------------------------------------*/

if ( ! function_exists( 'bones_page_navi' ) ) {
	function bones_page_navi() {

	global $wp_query;

	$big = 999999999; // need an unlikely integer

	echo '<nav class="pagination">';

		echo paginate_links( array(
			'base'         => str_replace( $big, '%#%', esc_url( get_pagenum_link($big) ) ),
			'format'       => '',
			'current'      => max( 1, get_query_var('paged') ),
			'total'        => $wp_query->max_num_pages,
			'prev_text'    => '&larr;',
			'next_text'    => '&rarr;',
			'type'         => 'list',
			'end_size'     => 3,
			'mid_size'     => 3
		) );
	echo '</nav>';
	}
}

/*-----------------------------------------------------------------------------------*/
/*  Gallery
/*-----------------------------------------------------------------------------------*/

if ( ! function_exists( 'wpl_post_gallery' ) ) {

	function wpl_post_gallery( $output, $attr) {
		global $post, $wp_locale;

		static $instance = 0;
		$instance++;

		// We're trusting author input, so let's at least make sure it looks like a valid orderby statement
		if ( isset( $attr['orderby'] ) ) {
			$attr['orderby'] = sanitize_sql_orderby( $attr['orderby'] );
			if ( !$attr['orderby'] )
				unset( $attr['orderby'] );
		}

		extract(shortcode_atts(array(
			'order'      => 'ASC',
			'orderby'    => 'menu_order ID',
			'id'         => $post->ID,
			'itemtag'    => 'dl',
			'icontag'    => 'dt',
			'captiontag' => 'dd',
			'columns'    => '3',
			'size'       => 'small',
			'include'    => '',
			'exclude'    => ''
		), $attr));

		$id = intval($id);
		if ( 'RAND' == $order )
			$orderby = 'none';

		if ( !empty($include) ) {
			$include = preg_replace( '/[^0-9,]+/', '', $include );
			$_attachments = get_posts( array('include' => $include, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );

			$attachments = array();
			foreach ( $_attachments as $key => $val ) {
				$attachments[$val->ID] = $_attachments[$key];
			}
		} elseif ( !empty($exclude) ) {
			$exclude = preg_replace( '/[^0-9,]+/', '', $exclude );
			$attachments = get_children( array('post_parent' => $id, 'exclude' => $exclude, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
		} else {
			$attachments = get_children( array('post_parent' => $id, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
		}

		if ( empty($attachments) )
			return '';

		if ( is_feed() ) {
			$output = "\n";
			foreach ( $attachments as $att_id => $attachment )
				$output .= wp_get_attachment_link($att_id, $size, true) . "\n";
			return $output;
		}

		$itemtag = tag_escape($itemtag);
		$captiontag = tag_escape($captiontag);
		$columns = intval($columns);
		$itemwidth = $columns > 0 ? floor(100/$columns) : 100;
		$float = is_rtl() ? 'right' : 'left';

			$output = "<div id=\"mygallery\" class='gallery-columns-$columns cf'>\n";
			$i = 0;
			foreach ( $attachments as $id => $attachment ) {
				$link = isset($attr['link']) && 'file' == $attr['link'] ? wp_get_attachment_link($id, $size, false, false) : wp_get_attachment_link($id, $size, true, false);
				$output .= "<{$itemtag} class='gallery-item cf'>";
				$output .= "
					<{$icontag} class='gallery-icon'>
						$link
					</{$icontag}>";
				if ( $captiontag && trim($attachment->post_excerpt) ) {
					$output .= "<{$captiontag} class='gallery-caption'>" . wptexturize($attachment->post_excerpt) . "</{$captiontag}>";
				}
				$output .= "</{$itemtag}>";

				}

			$output .= "</div>\n";

			return $output;
		}
	add_filter( 'post_gallery', 'wpl_post_gallery', 10, 2 );
}


/*-----------------------------------------------------------------------------------*/
/*  Remove the p from aroun dimages
/*-----------------------------------------------------------------------------------*/

if (!function_exists('wpl_filter_ptags_on_images')) {

	function wpl_filter_ptags_on_images($content){
		return preg_replace('/<p>\s*(<a .*>)?\s*(<img .* \/>)\s*(<\/a>)?\s*<\/p>/iU', '\1\2\3', $content);
	}
}

/*-----------------------------------------------------------------------------------*/
/*  This removes the annoying […] to a Read More link
/*-----------------------------------------------------------------------------------*/

if (!function_exists('wpl_excerpt_more')) {
	function wpl_excerpt_more($more) {
		global $post;
		// edit here if you like
		return '...  <a class="excerpt-read-more" href="'. get_permalink($post->ID) . '" title="'. __( 'Read ', 'thearchitect-wpl' ) . get_the_title($post->ID).'">'. __( 'Read more &raquo;', 'thearchitect-wpl' ) .'</a>';
	}
}


/*-----------------------------------------------------------------------------------*/
/*  Allow shortcodes to text widget
/*-----------------------------------------------------------------------------------*/

add_filter('widget_text', 'do_shortcode');


/*-----------------------------------------------------------------------------------*/
/*  Add a container for video
/*-----------------------------------------------------------------------------------*/

if ( ! function_exists( 'wpl_custom_oembed_filter' ) ) {

	add_filter( 'embed_oembed_html', 'wpl_custom_oembed_filter', 10, 4 ) ;

	function wpl_custom_oembed_filter($html, $url, $attr, $post_ID) {
		$return = '<div class="video-container">'.$html.'</div>';
		return $return;
	}
}



/*-----------------------------------------------------------
	Custom Tag cloud Widget
-----------------------------------------------------------*/

if ( ! function_exists( 'wplook_tag_cloud_widget' ) ) {

	function wplook_tag_cloud_widget($args) {
		$args['largest'] = 14;
		$args['smallest'] = 14;
		$args['unit'] = 'px';
		return $args;
	}
	add_filter( 'widget_tag_cloud_args', 'wplook_tag_cloud_widget' );

}


/*-----------------------------------------------------------
	Get Date
-----------------------------------------------------------*/

if ( ! function_exists( 'wplook_get_date' ) ) {

	function wplook_get_date() {
		the_time(get_option('date_format'));
	}

}


/*-----------------------------------------------------------
	Get Time
-----------------------------------------------------------*/

if ( ! function_exists( 'wplook_get_time' ) ) {

	function wplook_get_time() {
		the_time(get_option('time_format'));
	}

}


/*-----------------------------------------------------------
	Get Date and Time
-----------------------------------------------------------*/

if ( ! function_exists( 'wplook_get_date_time' ) ) {

	function wplook_get_date_time() {
		the_time(get_option('date_format'));
		_e( ' at ', 'thearchitect-wpl');
		the_time(get_option('time_format'));
	}

}


/*-----------------------------------------------------------------------------------*/
/*	Trim excerpt
/*-----------------------------------------------------------------------------------*/

if ( ! function_exists( 'wplook_short_excerpt' ) ) {

	function wplook_short_excerpt($limit) {
		$excerpt = explode(' ', get_the_excerpt(), $limit);
		if (count($excerpt)>=$limit) {
			array_pop($excerpt);
			$excerpt = implode(" ",$excerpt).'...';
		} else {
			$excerpt = implode(" ",$excerpt);
		}
		$excerpt = preg_replace('`\[[^\]]*\]`','',$excerpt);
		return $excerpt;
	}

}


/*-----------------------------------------------------------
	Display Navigation for post, pages, search
-----------------------------------------------------------*/

if ( ! function_exists( 'wplook_content_navigation' ) ) {

	function wplook_content_navigation( $nav_id ) {
		global $wp_query;
		if ( $wp_query->max_num_pages > 1 ) : ?>
			<section id="<?php echo $nav_id; ?>">
				<?php if ( get_previous_posts_link() ) { ?>
					<div class="col-sm-6 col-md-6 text-left"><?php previous_posts_link( __( '<span class="mobile-nav">Previous</span>', 'thearchitect-wpl' ) ); ?></div>
				<?php } ?>

				<?php if ( get_next_posts_link() ) { ?>
					<div class="col-sm-6 col-md-6 text-right"><?php next_posts_link( __( '<span class="mobile-nav">Next</span>', 'thearchitect-wpl' ) ); ?></div>
				<?php } ?>
					<div class="clear"></div>
			</section><!-- #nav -->
		<?php endif;
	}

}


/*-----------------------------------------------------------------------------------*/
/*	Page Title for WordPress < 4.1
/*-----------------------------------------------------------------------------------*/

if ( ! function_exists( '_wp_render_title_tag' ) ) {
	function theme_slug_render_title() {
		?>
		<title><?php wp_title( '|', false, 'right' ); ?></title>
		<?php
	}
	add_action( 'wp_head', 'theme_slug_render_title' );
}


/*-----------------------------------------------------------------------------------*/
/*	Doctitle
/*-----------------------------------------------------------------------------------*/

if ( ! function_exists( 'wplook_doctitle' ) ) {
	function wplook_doctitle() {

		if ( is_search() ) {
		  $content = __('Search Results for:', 'thearchitect-wpl');
		  $content .= ' ' . esc_html(stripslashes(get_search_query()));
		}

		elseif ( is_category() ) {
			$content = __('', 'thearchitect-wpl');
			$content .= ' ' . single_cat_title("", false);
		}

		elseif ( is_day() ) {
			$content = __( '', 'thearchitect-wpl');
			$content .= ' ' . esc_html(stripslashes( get_the_date()));
		}

		elseif ( is_month() ) {
			$content = __( '', 'thearchitect-wpl');
			$content .= ' ' . esc_html(stripslashes( get_the_date( 'F Y' )));
		}
		elseif ( is_year()  ) {
			$content = __( '', 'thearchitect-wpl');
			$content .= ' ' . esc_html(stripslashes( get_the_date( 'Y' ) ));
		}

		elseif ( is_tag() ) {
			$content = __('', 'thearchitect-wpl');
			$content .= ' ' . single_tag_title( '', false );
		}

		elseif ( is_author() ) {
			$content = __("Author's Posts", 'thearchitect-wpl');

		}

		elseif ( is_404() ) {
			$content = __('Page Not Found', 'thearchitect-wpl');
		}


		else {
			$content = '';
		}

		$elements = array("content" => $content);

		// Filters should return an array
		$elements = apply_filters('wplook_doctitle', $elements);

		// But if they don't, it won't try to implode
			if(is_array($elements)) {
			  $doctitle = implode(' ', $elements);
			} else {
			  $doctitle = $elements;
			}

			if ( is_search() || is_day() || is_month() || is_year() || is_404() || is_author() ) {
				$doctitle = $doctitle;
			}

		echo $doctitle;

	}
}


/*-----------------------------------------------------------
	Add custom Colors to the theme
-----------------------------------------------------------*/

add_action( 'customize_register', 'hg_customize_register' );
function hg_customize_register($wp_customize) {

	$colors = array();
	$colors[] = array( 'slug'=>'wpl_link_color', 'default' => '#bb3e3e', 'label' => __( 'Link color', 'thearchitect-wpl' ), 'sanitize_callback' => 'sanitize_hex_color' );
	$colors[] = array( 'slug'=>'wpl_hover_link_color', 'default' => '#bb3e3e', 'label' => __( 'Hover link color', 'thearchitect-wpl' ), 'sanitize_callback' => 'sanitize_hex_color' );
	$colors[] = array( 'slug'=>'wpl_accent_color', 'default' => '#bb3e3e', 'label' => __( 'Accent color', 'thearchitect-wpl' ), 'sanitize_callback' => 'sanitize_hex_color' );
	$colors[] = array( 'slug'=>'wpl_header_color', 'default' => '#353535', 'label' => __( 'Header color', 'thearchitect-wpl' ), 'sanitize_callback' => 'sanitize_hex_color' );
	$colors[] = array( 'slug'=>'wpl_footer_color', 'default' => '#353535', 'label' => __( 'Footer color', 'thearchitect-wpl' ), 'sanitize_callback' => 'sanitize_hex_color' );


	foreach($colors as $color) {
		add_option( $color['slug'], $color['default'] );
		// SETTINGS
		$wp_customize->add_setting( $color['slug'], array( 'default' => $color['default'], 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'sanitize_hex_color', ));

		// CONTROLS
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, $color['slug'], array( 'label' => $color['label'], 'section' => 'colors', 'settings' => $color['slug'] )));
	}
}


/*-----------------------------------------------------------------------------------*/
/*	Print Custom Color Styles
/*-----------------------------------------------------------------------------------*/

if ( ! function_exists( 'wplook_print_custom_color_style' ) ) {

	function wplook_print_custom_color_style() { ?>
		<?php
			$link_color = get_option('wpl_link_color');
			$hover_link_color = get_option('wpl_hover_link_color');
			$accent_color = get_option('wpl_accent_color');
			$header_color = get_option('wpl_header_color');
			$footer_color = get_option('wpl_footer_color');
		?>
		<style>
			a, a:visited { color: <?php echo $link_color; ?>;}

			header.header { background-color: <?php echo $header_color; ?>; }
			.footer { background-color: <?php echo $footer_color; ?>; }

			a:hover, a:focus, a:visited:hover, a:visited:focus { color: <?php echo $hover_link_color; ?>;}

			.accent, .shortcode_icon_with_title .icon_with_title_link,
			.shortcode_icon_with_title.left .icon_holder .font_awsome_icon i:hover,
			.fa_icon_stack .fa-circle, .shortcode_icon_with_title.boxed .icon_holder .fa-stack,
			.shortcode_team .team_description .team_social_holder .shortcode_social_icon_holder:hover i.simple_social,
			.shortcode_social_icon_holder:hover i.simple_social, .shortcode_service_table_inner li.title_holder i, .blog_content .entry-header span.sep,
			.blog_content .entry-header span.type, .blog_content .post_meta span a:hover,
			.widget ul li a:hover, .widget ul li.current-menu-item > a,
			.footer .footer-bottom .textwidget a:hover .fa { color: <?php echo $accent_color; ?>; }

			.line.accent { border-top: 3px solid <?php echo $accent_color; ?>;}

			.shortcode_icon_with_title.boxed .icon_holder .fa-stack,
			.fa_icon_square, .shortcode_icon_with_title.square .icon_holder .fa-stack:hover,
			.circle .icon_holder .fa-stack:hover, .shortcode_social_icon_holder.circle_social .fa-stack:hover,
			.shortcode_price_table .active_price_table, .btn:hover, .btn:focus, .accent-btn:hover, input[type="submit"]:hover, .comment-respond #submit:hover, .accent-btn:focus, input[type="submit"]:focus, .comment-respond #submit:focus,
			.btn.black:hover, .black.accent-btn:hover, input.black[type="submit"]:hover, .comment-respond .black#submit:hover,
			.accent-btn, input[type="submit"], .comment-respond #submit,
			input[type="submit"]:hover, input[type="submit"]:focus { background-color: <?php echo $accent_color; ?>; }

			.nav > li ul.sub-menu, .nav > li ul.children,
			.block-title, .filter ul li:hover, .filter ul li ul.sectors, .filter ul li ul.locations,
			.filter ul li ul.sectors li a, .filter ul li ul.locations li a, 
                        .filter ul li ul.sectors li a:visited, .filter ul li ul.locations li a:visited, 
                        .flex-button a:hover { background: <?php echo $accent_color; ?>; }

			.btn.black:hover, .black.accent-btn:hover, input.black[type="submit"]:hover, .comment-respond .black#submit:hover,
			.btn.accent, .accent.accent-btn, input.accent[type="submit"], .comment-respond .accent#submit,
			.accent-btn, input[type="submit"], .comment-respond #submit,
			input[type="submit"]:hover, input[type="submit"]:focus {border-color: <?php echo $accent_color; ?>; }

			.nav > li > a:hover, .nav > li > a.active, .nav > li.current_page_item a { border-bottom: 4px solid <?php echo $accent_color; ?>; }
		</style>
	<?php }
	if (get_option('wpl_link_color')) {
		add_action( 'wp_head', 'wplook_print_custom_color_style' );
	}
}


/*-----------------------------------------------------------------------------------*/
/*	Custom CSS
/*-----------------------------------------------------------------------------------*/

if ( ! function_exists( 'wpl_custom_css' ) ) {

	function wpl_custom_css() {
		$wpl_css = ot_get_option('wpl_css');
		echo "<style>";
		echo $wpl_css;
		echo "</style>";
	}
	add_action( 'wp_head', 'wpl_custom_css' );

}


/*-----------------------------------------------------------------------------------*/
/*	BE Dashbord Widget
/*-----------------------------------------------------------------------------------*/

if ( ! function_exists( 'wplook_dashboard_widgets' ) ) {

	function wplook_dashboard_widgets() {
		global $wp_meta_boxes;
		unset(
			$wp_meta_boxes['dashboard']['normal']['core']['dashboard_plugins'],
			$wp_meta_boxes['dashboard']['side']['core']['dashboard_secondary'],
			$wp_meta_boxes['dashboard']['side']['core']['dashboard_primary']
		);
			wp_add_dashboard_widget( 'dashboard_custom_feed', '<a href="https://wplook.com?utm_source=Our-Themes&utm_medium=rss&utm_campaign=The-Architect">WPlook News</a>' , 'dashboard_custom_feed_output' );
	}
	add_action('wp_dashboard_setup', 'wplook_dashboard_widgets');
}


if ( ! function_exists( 'dashboard_custom_feed_output' ) ) {

	function dashboard_custom_feed_output() {
		echo '<div class="rss-widget rss-wplook">';
		wp_widget_rss_output(array(
			'url' => 'http://feeds.feedburner.com/wplook',
			'title' => '',
			'items' => 5,
			'show_summary' => 1,
			'show_author' => 0,
			'show_date' => 1
			));
		echo '</div>';
	}
}

if ( ! function_exists( 'wplook_bar_menu' ) ):

	function wplook_bar_menu() {
		global $wp_admin_bar;
		if ( !is_super_admin() || !is_admin_bar_showing() )
			return;
		$admin_dir = get_admin_url();

		$wp_admin_bar->add_menu(
			array(
				'id' => 'custom_menu',
				'title' => __( 'WPlook Panel', 'thearchitect-wpl' ),
				'href' => FALSE,
				'meta' => array('title' => 'WPlook Options Panel', 'class' => 'wplookpanel')
			)
		);

		$wp_admin_bar->add_menu(
			array(
				'id' => 'wpl_to',
				'parent' => 'custom_menu',
				'title' => __( 'Theme Options', 'thearchitect-wpl' ),
				'href' => $admin_dir .'themes.php?page=ot-theme-options',
				'meta' => array('title' => 'Theme Option')
			)
		);

		$wp_admin_bar->add_menu(
			array(
				'id' => 'wpl_sp',
				'parent' => 'custom_menu',
				'title' => __( 'Support', 'thearchitect-wpl' ),
				'href' => 'https://wplook.com/help/?utm_source=Support&utm_medium=link&utm_campaign=The-Architect',
				'meta' => array('title' => 'Support')
			)
		);


		$wp_admin_bar->add_menu(
			array(
				'id' => 'wpl_wt',
				'parent' => 'custom_menu',
				'title' => __( 'Our Themes', 'thearchitect-wpl' ),
				'href' => 'https://wplook.com/wordpress/themes/?utm_source=Our-Themes&utm_medium=link&utm_campaign=The-Architect',
				'meta' => array('title' => 'Our Themes')
				)
		);

		$wp_admin_bar->add_menu(
			array(
				'id' => 'wpl_fb',
				'parent' => 'custom_menu',
				'title' => __( 'Become our fan on Facebook', 'thearchitect-wpl' ),
				'href' => 'http://www.facebook.com/wplookthemes',
				'meta' => array('target' => 'blank', 'title' => 'Become our fan on Facebook')
			)
		);

		$wp_admin_bar->add_menu(
			array(
				'id' => 'wpl_tw',
				'parent' => 'custom_menu',
				'title' => __( 'Follow us on Twitter', 'thearchitect-wpl' ),
				'href' => 'http://twitter.com/#!/wplook',
				'meta' => array('target' => 'blank', 'title' => 'Follow us on Twitter')
			)
		);
	}
	add_action('admin_bar_menu', 'wplook_bar_menu', '1000');
endif;


/*-----------------------------------------------------------------------------------*/
/*	Manage columns for Payments
/*-----------------------------------------------------------------------------------*/

if ( ! function_exists( 'add_new_pledge_columns' ) ) {

	function add_new_pledge_columns($columns) {
		$columns = array(
			'cb' => '<input type="checkbox" />',
			'title' => __( 'Tranzaction ID', 'thearchitect-wpl' ),
			'wpl_pledge_ticket' => __( 'Ticket', 'thearchitect-wpl' ),
			'wpl_pledge_first_name' => __( 'First Name', 'thearchitect-wpl' ),
			'wpl_pledge_last_name' => __( 'Last Name', 'thearchitect-wpl' ),
			'wpl_pledge_donation_amount' => __( 'Donation amount', 'thearchitect-wpl' ),
			'wpl_pledge_payment_source' => __( 'Payment Source', 'thearchitect-wpl' ),
			'wpl_pledge_payment_Status' => __( 'Payment Status', 'thearchitect-wpl' ),
			'date' => __( 'Date', 'thearchitect-wpl' )
		);

	return $columns;

	}
	add_filter("manage_edit-post_pledges_columns", "add_new_pledge_columns");
	// Add to admin_init function

}

 if ( ! function_exists( 'wpl_pledge_columns' ) ) {

	function wpl_pledge_columns( $column, $post_id ) {

		switch ($column) {


			/*-----------------------------------------------------------
				Case: First Name
			-----------------------------------------------------------*/
			case 'wpl_pledge_ticket' :

			$wpl_pledge_ticket = get_post_meta( $post_id, 'wpl_pledge_ticket', true );

			if ( empty( $wpl_pledge_ticket ) )
				echo __( 'Unknown', 'thearchitect-wpl' );

			else
				echo get_the_title( $wpl_pledge_ticket );
			break;


			/*-----------------------------------------------------------
				Case: First Name
			-----------------------------------------------------------*/
			case 'wpl_pledge_first_name' :

			$wpl_pledge_first_name = get_post_meta( $post_id, 'wpl_pledge_first_name', true );

			if ( empty( $wpl_pledge_first_name ) )
				echo __( 'Unknown', 'thearchitect-wpl' );

			else
				printf( __( '%s', 'thearchitect-wpl' ), $wpl_pledge_first_name );

			break;

			/*-----------------------------------------------------------
				Case: Last Name
			-----------------------------------------------------------*/
			case 'wpl_pledge_last_name' :

			$wpl_pledge_last_name = get_post_meta( $post_id, 'wpl_pledge_last_name', true );

			if ( empty( $wpl_pledge_last_name ) )
				echo __( 'Unknown', 'thearchitect-wpl' );

			else
				printf( __( '%s', 'thearchitect-wpl' ), $wpl_pledge_last_name );

			break;


			/*-----------------------------------------------------------
				Case: Donation amount
			-----------------------------------------------------------*/
			case 'wpl_pledge_donation_amount' :

			$wpl_pledge_donation_amount = get_post_meta( $post_id, 'wpl_pledge_donation_amount', true );

			if ( empty( $wpl_pledge_donation_amount ) )
				echo __( 'Unknown', 'thearchitect-wpl' );

			else
				printf( __( '%s', 'thearchitect-wpl' ), $wpl_pledge_donation_amount );

			break;


			/*-----------------------------------------------------------
				Case: Payment Source
			-----------------------------------------------------------*/
			case 'wpl_pledge_payment_source' :

			$wpl_pledge_payment_source = get_post_meta( $post_id, 'wpl_pledge_payment_source', true );

			if ( empty( $wpl_pledge_payment_source ) )
				echo __( 'Unknown', 'thearchitect-wpl' );

			else
				printf( __( '%s', 'thearchitect-wpl' ), $wpl_pledge_payment_source );

			break;


			/*-----------------------------------------------------------
				Case: Payment Status
			-----------------------------------------------------------*/
			case 'wpl_pledge_payment_Status' :

			$wpl_pledge_payment_Status = get_post_meta( $post_id, 'wpl_pledge_payment_Status', true );

			if ( empty( $wpl_pledge_payment_Status ) )
				echo __( 'Unknown', 'thearchitect-wpl' );

			else
				printf( __( '%s', 'thearchitect-wpl' ), $wpl_pledge_payment_Status );

			break;

		} // end switch
	}
	add_action('manage_post_pledges_posts_custom_column', 'wpl_pledge_columns', 10, 2);

}


/*-----------------------------------------------------------------------------------*/
/*	Manage columns for Staff
/*-----------------------------------------------------------------------------------*/

if ( ! function_exists( 'add_new_staff_columns' ) ) {

	function add_new_staff_columns($columns) {
		$columns = array(
			'cb' => '<input type="checkbox" />',
			'title' => __( 'Name', 'thearchitect-wpl' ),
			'wpl_candidate_position' => __( 'Position', 'thearchitect-wpl' ),
			'date' => __( 'Date', 'thearchitect-wpl' )
		);

	return $columns;

	}
	add_filter("manage_edit-post_staff_columns", "add_new_staff_columns");

}


if ( ! function_exists( 'wpl_staff_columns' ) ) {

	function wpl_staff_columns( $column, $post_id ) {

		switch ($column) {


			/*-----------------------------------------------------------
				Staff: Position
			-----------------------------------------------------------*/
			case 'wpl_candidate_position' :

			$wpl_candidate_position = get_post_meta( $post_id, 'wpl_candidate_position', true );

			if ( empty( $wpl_candidate_position ) )
				echo __( 'Unknown', 'thearchitect-wpl' );

			else
				printf( __( '%s', 'thearchitect-wpl' ), $wpl_candidate_position );

			break;

		} // end switch
	}
	add_action('manage_post_staff_posts_custom_column', 'wpl_staff_columns', 10, 2);

}



/*-----------------------------------------------------------------------------------*/
/*	Manage columns for Speakers
/*-----------------------------------------------------------------------------------*/

if ( ! function_exists( 'add_new_speaker_columns' ) ) {

	function add_new_speaker_columns($columns) {
		$columns = array(
			'cb' => '<input type="checkbox" />',
			'title' => __( 'Title', 'thearchitect-wpl' ),
			'wpl_speaker_company' => __( 'Company', 'thearchitect-wpl' ),
			'date' => __( 'Date', 'thearchitect-wpl' )
		);

	return $columns;

	}
	add_filter("manage_edit-post_speaker_columns", "add_new_speaker_columns");

}


if ( ! function_exists( 'wpl_speaker_columns' ) ) {

	function wpl_speaker_columns( $column, $post_id ) {

		switch ($column) {

			/*-----------------------------------------------------------
				Speakers: Company
			-----------------------------------------------------------*/
			case 'wpl_speaker_company' :

			$wpl_speaker_company = get_post_meta( $post_id, 'wpl_speaker_company', true );

			if ( empty( $wpl_speaker_company ) )
				echo __( 'Unknown', 'thearchitect-wpl' );

			else
				printf( __( '%s', 'thearchitect-wpl' ), $wpl_speaker_company );

			break;

		} // end switch
	}
	add_action('manage_post_speaker_posts_custom_column', 'wpl_speaker_columns', 10, 2);

}

/*-----------------------------------------------------------------------------------*/
/*  Site Icon customiser changes
/*-----------------------------------------------------------------------------------*/

if( !function_exists( 'wpl_customizer' ) ) {

	function wpl_customizer() {

		global $wp_customize;

		// Windows tile colour

		$wp_customize->add_setting(
		    'windows_tile_color',
		    array(
		        'default' => '#00a9c5',
		        'sanitize_callback' => 'sanitize_hex_color'
		    )
		);

		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'windows_tile_color',
				array(
					'label' => __( 'Windows tile background color', 'thearchitect-wpl' ),
					'description' => __( 'Users of Windows Phone 8+ and Windows 8+ can pin apps to their home screens as a tile. This is the color which will be used as the background of the tile.', 'thearchitect-wpl' ),
					'section' => 'title_tagline',
					'settings' => 'windows_tile_color',
					'priority' => 70 // After 'Site Icon', priority 60
				)
			)
		);

	}

	add_action( 'customize_register', 'wpl_customizer' );

}


/*-----------------------------------------------------------------------------------*/
/*  Windows site icon size
/*-----------------------------------------------------------------------------------*/

if( !function_exists( 'wpl_windows_site_icon_size' ) ) {

	function wpl_windows_site_icon_size() {

		$sizes[] = 144;

		return $sizes;

	}

	add_filter( 'site_icon_image_sizes', 'wpl_windows_site_icon_size' );

}

if( !function_exists( 'wpl_windows_site_icon_tag' ) ) {

	function wpl_windows_site_icon_tag( $meta_tags ) {

		$meta_tags[] = sprintf( '<meta name="msapplication-TileImage" content="%s">', esc_url( get_site_icon_url( 144 ) ) );

		$meta_tags[] = sprintf( '<meta name="msapplication-TileColor" content="%s">', esc_attr( get_theme_mod( 'windows_tile_color', '#00a9c5' ) ) );

		return $meta_tags;

	}

	add_filter( 'site_icon_meta_tags', 'wpl_windows_site_icon_tag' );

}

?>
