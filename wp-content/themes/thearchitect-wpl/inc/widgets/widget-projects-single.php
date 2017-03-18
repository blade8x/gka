<?php
/**
 * Widget for adding info about the current project to the single project page
 *
 * @package WPlook
 * @subpackage The Architect
 * @since The Architect 1.0
 */

add_action('widgets_init', create_function('', 'return register_widget("wplook_project_single_widget");'));
class wplook_project_single_widget extends WP_Widget {

	/*-----------------------------------------------------------------------------------*/
	/*	Widget actual processes
	/*-----------------------------------------------------------------------------------*/

	public function __construct() {
		parent::__construct(
	 		'wplook_project_single_widget',
			__( 'WPlook Project Info', 'thearchitect-wpl' ),
			array( 'description' => __( 'Add info about the current project to the single project page', 'thearchitect-wpl' ), )
		);
	}


	/*-----------------------------------------------------------------------------------*/
	/*	Outputs the options form on admin
	/*-----------------------------------------------------------------------------------*/

	public function form( $instance ) {
		$title = ( $instance ? esc_attr( $instance[ 'title' ] ) : '' );
		$display_case_study = ( $instance ? esc_attr( $instance[ 'display_case_study' ] ) : 'on' );
		$display_sectors = ( $instance ? esc_attr( $instance[ 'display_sectors' ] ) : 'on' );
		$display_clients = ( $instance ? esc_attr( $instance[ 'display_clients' ] ) : 'on' );
		$display_location = ( $instance ? esc_attr( $instance[ 'display_location' ] ) : 'on' );
		$display_cost = ( $instance ? esc_attr( $instance[ 'display_cost' ] ) : 'on' );
		$display_status = ( $instance ? esc_attr( $instance[ 'display_status' ] ) : 'on' );
		?>

			<p>
				<label for="<?php echo $this->get_field_id('title'); ?>"> <?php _e('Title:', 'thearchitect-wpl'); ?> </label>
				<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
			</p>

			<p>
				<input type="checkbox" class="widefat" id="<?php echo $this->get_field_id('display_case_study'); ?>" name="<?php echo $this->get_field_name('display_case_study'); ?>" <?php checked( $instance['display_case_study'], 'on'); ?>> <label for="<?php echo $this->get_field_id('display_case_study'); ?>"> <?php _e('Display case study', 'thearchitect-wpl'); ?></label>
			</p>

			<p>
				<input type="checkbox" class="widefat" id="<?php echo $this->get_field_id('display_sectors'); ?>" name="<?php echo $this->get_field_name('display_sectors'); ?>" <?php checked( $instance['display_sectors'], 'on'); ?>> <label for="<?php echo $this->get_field_id('display_sectors'); ?>"> <?php _e('Display sectors', 'thearchitect-wpl'); ?></label>
			</p>

			<p>
				<input type="checkbox" class="widefat" id="<?php echo $this->get_field_id('display_clients'); ?>" name="<?php echo $this->get_field_name('display_clients'); ?>" <?php checked( $instance['display_clients'], 'on'); ?>> <label for="<?php echo $this->get_field_id('display_clients'); ?>"> <?php _e('Display clients', 'thearchitect-wpl'); ?></label>
			</p>

			<p>
				<input type="checkbox" class="widefat" id="<?php echo $this->get_field_id('display_location'); ?>" name="<?php echo $this->get_field_name('display_location'); ?>" <?php checked( $instance['display_location'], 'on'); ?>> <label for="<?php echo $this->get_field_id('display_location'); ?>"> <?php _e('Display location', 'thearchitect-wpl'); ?></label>
			</p>

			<p>
				<input type="checkbox" class="widefat" id="<?php echo $this->get_field_id('display_cost'); ?>" name="<?php echo $this->get_field_name('display_cost'); ?>" <?php checked( $instance['display_cost'], 'on'); ?>> <label for="<?php echo $this->get_field_id('display_cost'); ?>"> <?php _e('Display cost', 'thearchitect-wpl'); ?></label>
			</p>

			<p>
				<input type="checkbox" class="widefat" id="<?php echo $this->get_field_id('display_status'); ?>" name="<?php echo $this->get_field_name('display_status'); ?>" <?php checked( $instance['display_status'], 'on'); ?>> <label for="<?php echo $this->get_field_id('display_status'); ?>"> <?php _e('Display status', 'thearchitect-wpl'); ?></label>
			</p>

		<?php
	}


	/*-----------------------------------------------------------------------------------*/
	/*	Processes widget options to be saved
	/*-----------------------------------------------------------------------------------*/

	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = sanitize_text_field($new_instance['title']);
		$instance['display_case_study'] = sanitize_text_field($new_instance['display_case_study']);
		$instance['display_sectors'] = sanitize_text_field($new_instance['display_sectors']);
		$instance['display_clients'] = sanitize_text_field($new_instance['display_clients']);
		$instance['display_location'] = sanitize_text_field($new_instance['display_location']);
		$instance['display_cost'] = sanitize_text_field($new_instance['display_cost']);
		$instance['display_status'] = sanitize_text_field($new_instance['display_status']);
		return $instance;
	}


	/*-----------------------------------------------------------------------------------*/
	/*	Outputs the content of the widget
	/*-----------------------------------------------------------------------------------*/

	public function widget( $args, $instance ) {
		global $post;
		$pid = $post->ID;
		extract( $args );
		$title = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
		$display_case_study = isset( $instance['display_case_study'] ) ? esc_attr( $instance['display_case_study'] ) : '';
		$display_sectors = isset( $instance['display_sectors'] ) ? esc_attr( $instance['display_sectors'] ) : '';
		$display_clients = isset( $instance['display_clients'] ) ? esc_attr( $instance['display_clients'] ) : '';
		$display_location = isset( $instance['display_location'] ) ? esc_attr( $instance['display_location'] ) : '';
		$display_cost = isset( $instance['display_cost'] ) ? esc_attr( $instance['display_cost'] ) : '';
		$display_status = isset( $instance['display_status'] ) ? esc_attr( $instance['display_status'] ) : '';

		$project_terms = get_the_terms( $pid, 'projects_cat' );
		$project_terms_count = count( $project_terms );
		$project_client = get_post_meta($post->ID, 'wpl_project_client', true);
		$project_location = get_post_meta(get_the_ID(), 'wpl_project_location', true);
		$project_cost = get_post_meta($post->ID, 'wpl_project_cost', true);
		$project_status = get_post_meta($post->ID, 'wpl_project_status', true);

		if( ( $display_sectors == 'on' && $project_terms_count > 0 ) ||
		( $display_clients == 'on' && !empty( $project_client ) ) ||
		( $display_location == 'on' && !empty( $display_location ) ) ||
		( $display_cost == 'on' && !empty( $display_cost ) ) ||
		( $display_status == 'on' && !empty( $display_status ) ) ) {
			$second_part = true;
		} else {
			$second_part = false;
		}

		if( $post->post_type == 'projects' ) { ?>

			<!-- Single project info -->
			<?php echo $before_widget; ?>

			<div class="wplook-widget-projects-single">
				<?php if( !empty( $title ) ) : ?>
					<?php echo $before_title . $title . $after_title; ?>
				<?php endif; ?>

				<?php if( $display_case_study == 'on' ) : ?>
					<div class="case-study">
						<h4><?php _e( 'Case Study', 'thearchitect-wpl' ); ?></h4>
						<?php $project_case_study = get_post_meta( $pid, 'wpl_project_case_study', true ); ?>
						<?php echo wpautop( $project_case_study ); ?>
					</div>

					<?php if( $second_part ) : ?>
						<!--<span class="line black"></span>-->
					<?php endif; ?>
				<?php endif; ?>

				<?php if( $second_part ) : ?>
					<ul class="project-meta">
						<?php if( $display_sectors == 'on' && $project_terms_count > 0 ) : ?>
							<li class="project-meta-sectors">
								<h4><?php echo _n( 'Sector', 'Sectors', $project_terms_count, 'thearchitect-wpl' ); ?></h4>
								<?php
									$i = 1;
									foreach( $project_terms as $term ) {
										echo $term->name;
										echo ( $i < $project_terms_count ? '<br>' : '' );
										$i++;
									}
								?>
							</li>
						<?php endif; ?>

						<?php if( $display_clients == 'on' && !empty( $project_client ) ) : ?>
							<li class="project-meta-clients">
								<h4><?php _e( 'Clients', 'thearchitect-wpl' ); ?></h4>
								<?php echo $project_client; ?>
							</li>
						<?php endif; ?>

						<?php if( $display_location == 'on' && !empty( $project_location ) ) : ?>
							<li class="project-meta-location">
								<h4><?php _e( 'Location', 'thearchitect-wpl' ); ?></h4>
								<?php echo $project_location; ?>
							</li>
						<?php endif; ?>

						<?php if( $display_cost == 'on' && !empty( $project_cost ) ) : ?>
							<li class="project-meta-cost">
								<h4><?php _e( 'Cost', 'thearchitect-wpl' ); ?></h4>
								<?php echo $project_cost; ?>
							</li>
						<?php endif; ?>

						<?php if( $display_status == 'on' && !empty( $project_status ) ) : ?>
							<li class="project-meta-status">
								<h4><?php _e( 'Status', 'thearchitect-wpl' ); ?></h4>
								<?php echo $project_status; ?>
							</li>
						<?php endif; ?>
					</ul>
				<?php endif; ?>
			</div>

			<?php echo $after_widget; ?>

		<?php }

	}
}
?>
