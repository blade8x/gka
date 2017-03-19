<?php
/**
 * The default template for displaying content
 *
 * @package WordPress
 * @subpackage The Architect
 * @since The Architect 1.0
 */

?>


<?php if ( is_single() ) { ?>
        <div class="entry-header cf" style="height: auto;">		
            <?php if ( has_post_thumbnail() ) { ?>
		<?php the_post_thumbnail('full'); ?>
                <div class="news_title">
                <time datetime="<?php echo get_the_date( 'c' ) ?>"><?php wplook_get_date(); ?></time>
                <h5 class="entry-title"><?php the_title(); ?></h5>
                </div>
            <?php }?>
        </div>

    <div class="wrap">
        <div class="m-all t-2of3 d-5of7">
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

		<div class="post_text entry-content">
			<?php the_content(); ?>
			<?php wp_link_pages(); ?>
			<?php if( has_tag()) { ?>
				<span><i class="fa fa-tags fa-fw"></i>&nbsp;<?php the_tags('', ', ', ''); ?> </span>
			<?php } ?>
		</div>

		<?php if( ot_get_option('wpl_blog_author_info')  != "off") { ?>
			<div class="author_description">
				<div class="author_description_inner">
					<div class="image">
						<?php echo get_avatar(get_the_author_meta( 'ID' ), 72); ?>
					</div>
					<div class="author_text_holder">
						<h4>
						<?php
							if(get_the_author_meta('first_name') != "" || get_the_author_meta('last_name') != "") {
								echo get_the_author_meta('first_name') . " " . get_the_author_meta('last_name');
							} else {
								echo get_the_author_meta('display_name');
							}
						?>
						</h4>
						<?php if(get_the_author_meta('description') != "") { ?>
							<div class="author_text">
								<p><?php echo get_the_author_meta('description') ?></p>
							</div>
						<?php } ?>
					</div>
				</div>
			</div>
		<?php } ?>
	</article>
        </div>
        <div id="sidebar1" class="sidebar m-all t-1of3 d-2of7 cf" role="complementary">
                <?php get_sidebar(); ?>
        </div>
    </div>

<?php } else { 
        // Get current page URL 
        $newsURL = urlencode(get_permalink());
        $facebookShareUrl = 'https://www.facebook.com/sharer/sharer.php?u='.$newsURL;
?>
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> ">
                <?php if ( has_post_thumbnail() ) { ?>
                <div class="post_image one_half">
                        <a href="<?php the_permalink(); ?>" target="_self" title="<?php the_title_attribute(); ?>">
                                <?php the_post_thumbnail('blog'); ?>
                        </a>
                </div>
		<?php } ?>
                <div class="one_half last" style="<?php echo (!has_post_thumbnail())?'width:100%;':'' ?>">
                    <div class="entry-content news_list">
                            <?php if( is_sticky() ) { ?> 
                            <span class="sticky"><?php _e( 'Sticky Post', 'thearchitect-wpl' ); ?></span> &nbsp; <?php } ?>
                            <?php //the_category(', '); ?> 
                            <!--<span class="sep">/</span>--> 
                            <time datetime="<?php echo get_the_date( 'c' ) ?>"><?php wplook_get_date(); ?></time>
                            <h3 class="entry-title"><a href="<?php the_permalink(); ?>" target="_self" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>
                            <div class="fb-like" data-href="<?php echo $facebookShareUrl?>" data-layout="button" data-action="like" data-size="small" data-show-faces="true" data-share="true"></div><br>
                            <?php the_content(); ?>
                    </div>
<!--                    <div class="post_text entry-content">
                            <?php //the_content(); ?>
                    </div>-->
                </div>
	</article>
<?php } ?>
