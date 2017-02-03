<?php

if ( ! defined( 'VWSPC_PAGE_TEMPLATE_SLUG' ) ) define( 'VWSPC_PAGE_TEMPLATE_SLUG', 'page_simple_composer.php' );
require_once 'meta-box-custom-fields.php';

/* -----------------------------------------------------------------------------
 * Init Composer
 * -------------------------------------------------------------------------- */
add_action( 'current_screen', 'vwspc_init' );
if ( ! function_exists( 'vwspc_init' ) ) {
	function vwspc_init() {
		global $current_screen;
		if( ! vwspc_is_supported_post_type( $current_screen->post_type ) ) return;

		// Enqueue scripts only on page edit
		add_action( 'admin_enqueue_scripts', 'vwspc_init_scripts' );
	}
}

/* -----------------------------------------------------------------------------
 * Init Scripts
 * -------------------------------------------------------------------------- */
if ( ! function_exists( 'vwspc_init_scripts' ) ) {
	function vwspc_init_scripts() {
		wp_enqueue_style( 'vwcss-icon-entypo' );
		wp_enqueue_style( 'vwspc-css-page-composer', get_template_directory_uri().'/components/simple-page-composer/css/simple-page-composer.css' );

		wp_enqueue_script( 'vwjs-bootstrap-dropdown' );
		wp_enqueue_script( 'vwspc-js-page-composer', get_template_directory_uri().'/components/simple-page-composer/js/simple-page-composer.js', array( 'jquery' ), VW_THEME_VERSION, true );
		wp_localize_script( 'vwspc-js-page-composer', 'vwspc_settings',
			apply_filters( 'vwspc_js_settings', array(
				'ajaxurl' => admin_url( 'admin-ajax.php' ),
				'page_template_slug' => VWSPC_PAGE_TEMPLATE_SLUG,
			)
		) );
		wp_localize_script( 'vwspc-js-page-composer', 'vwspc_sections', apply_filters( 'vwspc_filter_init_sections', array() ) );
	}
}

/* -----------------------------------------------------------------------------
 * Render Editor
 * -------------------------------------------------------------------------- */
add_action( 'edit_form_after_title', 'vwspc_render_editor' );
if ( ! function_exists( 'vwspc_render_editor' ) ) {
	function vwspc_render_editor() {
		// Show / Hide the editor on loading
		global $post;

		$current_screen = get_current_screen();
		if ( ! vwspc_is_supported_post_type( $current_screen->post_type ) ) return;

		if ( isset( $post->ID ) && ( 'page' != $current_screen->post_type || VWSPC_PAGE_TEMPLATE_SLUG == get_post_meta( $post->ID,'_wp_page_template',TRUE ) ) ) : ?>
			<style>#postdivrich{ display:none; }</style>
		<?php else : ?>
			<style>#vwspc-container{ display:none; }</style>
		<?php endif; ?>

		<div id="vwspc-container">
			<input type="hidden" name="vwspc_is_enabled" value="1">

			<div class="vwspc-toolbox">
				<div class="dropdown">
					<button class="button button-primary button-large dropdown-toggle" type="button" id="add-section-button" data-toggle="dropdown">
						<?php _e( 'Add Section', 'envirra' ) ?>
						<span class="caret"></span>
					</button>
					<ul class="dropdown-menu" role="menu" aria-labelledby="add-section-button"></ul>
				</div>
			</div>

			<div class="vwspc-sections">
				<div class="vwspc-section-empty"><?php _e( 'Click <strong>Add Section</strong> button to add new section.', 'envirra' ) ?></div>
				<div class="vwspc-section-loading"><i class="icon-entypo-arrows-ccw"></i> <?php _e( 'Loading ...', 'envirra' ) ?></div>
			</div>

			<!-- Section Template -->
			<script id="vwspc-template-section" type="text/template">
				<div class="vwspc-section">
					<input type="hidden" class="vwspc-section-order" name="vwspc_section_order[]">
					<input type="hidden" class="vwspc-section-type">
					<div class="vwspc-section-bar">
						<div class="vwspc-section-toolbox">
							<a class="vwspc-section-open-option" href="#"><i class="icon-entypo-cog"></i></a>
							<a class="vwspc-section-delete-section" href="#"><i class="icon-entypo-cancel"></i></a>
						</div>
						<i class="vwspc-section-handle icon-entypo-arrow-combo"></i>
						<div class="vwspc-section-label"></div>
					</div>
					<div class="vwspc-section-options"></div>
				</div>
			</script>

			<script id="vwspc-template-section-option" type="text/template">
				<div class="vwspc-section-option vwspc-section-option-2-columns">
					<div class="vwspc-section-option-label-wrapper">
						<label class="vwspc-section-option-label"></label>
						<div class="vwspc-section-option-description"></div>
					</div>
					<div class="vwspc-section-option-field-wrapper"></div>
				</div>
			</script>

			<!-- Fields Template -->
			<script id="vwspc-template-field-text" type="text/template">
				<input class="vwspc-field" type="text">
			</script>

			<script id="vwspc-template-field-number" type="text/template">
				<input class="vwspc-field" type="number" name="quantity" min="0">
			</script>

			<script id="vwspc-template-field-checkbox" type="text/template">
				<input class="vwspc-field" type="hidden">
				<label>
					<input class="vwspc-field" type="checkbox">
					<span></span>
				</label>
			</script>

			<script id="vwspc-template-field-select" type="text/template">
				<select class="vwspc-field"></select>
			</script>

			<script id="vwspc-template-field-page" type="text/template">
				<?php wp_dropdown_pages( array(
					'class' => 'vwspc-field' )
				); ?>
			</script>

			<script id="vwspc-template-field-category" type="text/template">
				<?php wp_dropdown_categories( array(
					'hide_empty' => 0,
					'class' => 'vwspc-field',
					'hierarchical' => true )
				); ?>
			</script>

			<script id="vwspc-template-field-category_with_all_option" type="text/template">
				<?php wp_dropdown_categories( array(
					'show_option_all' => __( 'All', 'envirra' ),
					'hide_empty' => 0,
					'class' => 'vwspc-field',
					'hierarchical' => true )
				); ?>
			</script>

			<script id="vwpc-template-field-categories" type="text/template">
				<ul class="vw-category-checklist vwpc-field wp-tab-panel">
					<input type="hidden" name="selected_cats" value="">
					<?php
					$walker = new Vw_Walker_Category_Checklist();
					$walker->set_field_name( 'selected_cats' );

					wp_category_checklist( 0, 0, array(), false, $walker );
					?>
				</ul>
			</script>

			<script id="vwspc-template-field-sidebar" type="text/template">
				<select>
					<option value="0"><?php echo __( 'None', 'envirra' ); ?></option>
				<?php foreach ( $GLOBALS['wp_registered_sidebars'] as $sidebar ) : ?>
					<option value="<?php echo esc_attr( ucwords( $sidebar['id'] ) ); ?>">
						<?php echo ucwords( $sidebar['name'] ); ?>
					</option>
				<?php endforeach; ?>
				</select>
			</script>
			
			<script id="vwspc-template-field-html" type="text/template">
				<?php
				ob_start();
				wp_editor( '', 'vwspc-wp-editor-id', array(
					'textarea_name' => 'vwspc-wp-editor-field-name',
					'editor_class' => 'vwspc-field',
					'textarea_rows' => '11',
					'wpautop' => 'true',
				) );
				$editor_template = ob_get_clean();
				echo $editor_template;
				?>
			</script>
			<div class="vwspc-dummy-template hidden">
				<?php echo $editor_template; ?><!-- DO NOT REMOVE -->
			</div>
		</div>
		<?php
	}
}

/* -----------------------------------------------------------------------------
 * Save Page Composer
 * -------------------------------------------------------------------------- */
add_action( 'save_post', 'vwspc_save_page' );
if ( ! function_exists( 'vwspc_save_page' ) ) {
	function vwspc_save_page() {
		global $post;

		if ( ! vwspc_is_supported_post_type( get_post_type( $post ) ) || ! isset( $_POST['vwspc_is_enabled'] ) ) return;

		$counter = 1;
		if ( isset( $_POST['vwspc_section_order'] ) && ! empty( $_POST['vwspc_section_order'] ) ) {
			foreach ( $_POST['vwspc_section_order'] as $id ) {
				$field_prefix = 'vwspc_section_'.$counter;

				// Update section
				$existing_section_type = get_post_meta( $post->ID, $field_prefix, true );
				if ( $existing_section_type != $_POST[ 'vwspc_sections' ][ $id ]['_type'] ) {
					vwspc_delete_section( $post->ID, $field_prefix );
				}
				update_post_meta( $post->ID, $field_prefix, $_POST[ 'vwspc_sections' ][ $id ]['_type'] );

				// Update section's fields
				foreach ( array_keys( $_POST[ 'vwspc_sections' ][ $id ] ) as $field ) {
					if ( '_type' == $field ) continue;

					$field_value = $_POST[ 'vwspc_sections' ][ $id ][ $field ];
					if ( is_array( $field_value ) ) {
						$field_value = implode( ',', array_filter( $field_value ) );
					}
					update_post_meta( $post->ID, $field_prefix.'_'.$field, $field_value );
				}

				$counter++;			
			}
		}

		// Delete the next section
		$field_prefix = 'vwspc_section_'.$counter;
		vwspc_delete_section( $post->ID, $field_prefix );
	}
}

/* -----------------------------------------------------------------------------
 * Delete Composer Section
 * -------------------------------------------------------------------------- */
if ( ! function_exists( 'vwspc_delete_section' ) ) {
	function vwspc_delete_section( $post_id, $target_field ) {
		if ( '' == get_post_meta( $post_id, $target_field, true ) ) return;

		$custom_fields = get_post_custom_keys( $post_id );
		foreach ( $custom_fields as $custom_field ) {
			if ( strpos( $custom_field, $target_field ) === 0 ) {
				delete_post_meta( $post_id, $custom_field );
			}
		}
	}
}

/* -----------------------------------------------------------------------------
 * Render Sections
 * -------------------------------------------------------------------------- */
if ( ! function_exists( 'the_simple_page_composer' ) ) {
	function the_simple_page_composer( $args=array() ) {
		$defaults = array(
			'before' => '',
			'after' => '',
			'before_section' => '<div class="vwspc-section vwspc-section-%s" id="vwspc-section-%s">',
			'after_section' => '</div>',
		);
		$args = wp_parse_args( $args, $defaults );
		$page_id = get_queried_object_id();

		echo $args['before'];

		for ( $counter=1; $counter < 50; $counter++ ) { 
			$field_prefix = 'vwspc_section_'.$counter;
			$section_type = get_post_meta( $page_id, $field_prefix, true );

			if ( ! $section_type ) break;

			do_action( 'vwspc_action_render_section_'.$section_type, array(
				'page_id' => $page_id,
				'field_prefix' => $field_prefix,
				'before_section' => $args['before_section'],
				'after_section' => $args['after_section'],
			) );
		}

		echo $args['after'];
	}
}

/* -----------------------------------------------------------------------------
 * Utility functions
 * -------------------------------------------------------------------------- */
if ( ! function_exists( 'vwspc_get_paged' ) ) {
	function vwspc_get_paged() {
		$paged = 1;
		if ( get_query_var('paged') ) $paged = get_query_var('paged');
		if ( get_query_var('page') ) $paged = get_query_var('page');

		return $paged;
	}
}

if ( ! function_exists( 'vwspc_get_next_id' ) ) {
	function vwspc_next_section_id() {
		global $vwspc_section_id;
		if ( empty( $vwspc_section_id ) ) $vwspc_section_id = 0;

		return ++$vwspc_section_id;
	}
}

if ( ! function_exists( 'vwspc_is_supported_post_type' ) ) {
	function vwspc_is_supported_post_type( $post_type ) {
		$supported_post_type = apply_filters( 'vwspc_filter_supported_post_types', array( 'page' ) );
		return in_array( $post_type, $supported_post_type );
	}
}