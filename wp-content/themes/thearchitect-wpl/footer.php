<?php
/**
 * The footer template
 *
 * @package WordPress
 * @subpackage The Architect
 * @since The Architect 1.0
 */
?>
			<footer class="footer" role="contentinfo">
				<div id="inner-footer" class="wrap">
					<?php if ( is_active_sidebar( 'footer' ) ) : ?>

						<?php dynamic_sidebar( 'footer' ); ?>

					<?php endif; ?>

					<div class="cf"></div>
				</div>
			</footer>

		</div><!-- /#container -->

		<!--<div class="copy">
			<?php if ( ot_get_option('wpl_copyright') ) { 
				echo ot_get_option('wpl_copyright'); 
			} ?>
		</div>-->

		<?php if ( ot_get_option('wpl_google_analytics_tracking_code') ) {
			// Google Analytics Tracking Code
			echo ot_get_option('wpl_google_analytics_tracking_code');
		} ?>
		<?php wp_footer(); ?>
	</body>
</html>
