<?php if ( ! defined( 'ABSPATH' ) ) { die( 'Direct access forbidden.' ); }

/**
 * HB Custom Menu Walker admin page
 * 
 * @since 3.4.1
 */
class HB_Custom_Walker_Admin {

	/**
	 * Primary class constructor.
	 *
	 * @since 3.4.1
	 */
	function __construct() {

		add_filter( 'wp_setup_nav_menu_item', array( 
			$this, 
			'add_custom_nav_fields' 
		) );

		add_action( 'wp_update_nav_menu_item', array( 
			$this, 
			'update_custom_nav_fields'
		), 15, 3 );

		add_action( 'wp_nav_menu_item_custom_fields', array(
			$this,
			'output_custom_nav_fields',
		), 10, 5 );
	}

	/**
	 * Custom fields for menu items
	 *
	 * @since 3.4.1
	 */
	function add_custom_nav_fields( $menu_item ) {

		if ( get_post_meta( $menu_item->ID, '_menu_item_subtitle', true ) ) {
			$menu_item->icon = get_post_meta( $menu_item->ID, '_menu_item_subtitle', true );
			update_post_meta( $menu_item->ID, '_menu_item_icon', $menu_item->icon );
			//update_post_meta( $menu_item->ID, '_menu_item_subtitle', '' );
		} else {
			$menu_item->icon = get_post_meta( $menu_item->ID, '_menu_item_icon', true );
		}

		$menu_item->megamenu = get_post_meta( $menu_item->ID, '_menu_item_megamenu', true );
		$menu_item->megamenu_background = get_post_meta( $menu_item->ID, '_menu_item_megamenu_background', true );
		$menu_item->megamenu_widgetarea = get_post_meta( $menu_item->ID, '_menu_item_megamenu_widgetarea', true );
		$menu_item->megamenu_background_position = get_post_meta( $menu_item->ID, '_menu_item_megamenu_background_position', true );
		$menu_item->megamenu_captions = get_post_meta( $menu_item->ID, '_menu_item_megamenu_captions', true );
		$menu_item->megamenu_columns = get_post_meta( $menu_item->ID, '_menu_item_megamenu_columns', true );
		$menu_item->alignment = get_post_meta( $menu_item->ID, '_menu_item_alignment', true );

        return $menu_item;
	}

	/**
	 * Save fields for menu items
	 *
	 * @since 3.4.1
	 */
	function update_custom_nav_fields( $menu_id, $menu_item_db_id, $args ) {

		$fields = array(
			array(
				'name' 	=> 'menu-item-icon',
				'key' 	=> '_menu_item_icon'
			),
			array(
				'name' 	=> 'menu-item-alignment',
				'key' 	=> '_menu_item_alignment'
			),
			array(
				'name' 	=> 'menu-item-megamenu',
				'key' 	=> '_menu_item_megamenu'
			),
			array(
				'name' 	=> 'menu-item-megamenu-background-position',
				'key' 	=> '_menu_item_megamenu_background_position'
			),
			array(
				'name' 	=> 'menu-item-megamenu-background',
				'key' 	=> '_menu_item_megamenu_background'
			),
			array(
				'name' 	=> 'menu-item-megamenu-widget-area',
				'key' 	=> '_menu_item_megamenu_widgetarea'
			),
			array(
				'name' 	=> 'menu-item-megamenu-captions',
				'key' 	=> '_menu_item_megamenu_captions'
			),
			array(
				'name' 	=> 'menu-item-megamenu-columns',
				'key' 	=> '_menu_item_megamenu_columns'
			)
		);

		foreach ( $fields as $field ) {
			if ( ! isset( $_REQUEST[ $field['name'] ][ $menu_item_db_id ] ) ) {
				$_REQUEST[ $field['name'] ][ $menu_item_db_id ] = '';
			}

			$icon_value = $_REQUEST[ $field['name'] ][ $menu_item_db_id ];
			update_post_meta( $menu_item_db_id, $field['key'], $icon_value );


		}
	}

	/**
	 * Custom fields output.
	 * 
	 * @since 3.7.5
	 */
	function output_custom_nav_fields( $item_id, $item, $depth, $args, $id ) {
		
		global $wp_registered_sidebars;
		?>
		<div class="clear"></div>
			<div class="hb-menu-options wp-clearfix">
				<p class="hb-menu-title"><?php esc_html_e( 'Highend Menu Options', 'hbthemes' ); ?><a href="https://hb-themes.com/documentation/highend" class="align-right" target="_blank"><i class="dashicons dashicons-sos"></i><?php esc_html_e('How to use?', 'hbthemes'); ?></a></p>

				<div class="hb-menu-item hb-menu-icon wp-clearfix">
					<div class="hb-left-section">
						<div class="hb-menu-item-title"><?php esc_html_e('Menu Icon', 'hbthemes'); ?></div>
						<div class="hb-menu-item-desc"><?php esc_html_e('Choose an icon that will be shown before the menu item.', 'hbthemes'); ?></div>
					</div>

					<div class="hb-right-section">
						<div>
							<a href="#" class="button button-primary show-icon-modal" data-nonce="<?php echo wp_create_nonce( 'icon-picker-nonce' ); ?>" data-current="<?php echo $item->icon; ?>"><?php  esc_html_e ('Icon Picker', 'hbthemes'); ?></a>

							<?php $class = $item->icon ? '' : ' hidden'; ?>

							<a href="#" class="remove-selected-icon<?php echo $class; ?>"><i class="dashicons dashicons-no-alt"></i></a>

							<?php if ( $item->icon ) { ?>
								<span class="selected-icon"><?php echo $item->icon; ?></span>
							<?php } else { ?>
								<span class="selected-icon"><em><?php __('No icon selected', 'hbthemes'); ?></em></span>
							<?php } ?>

							<input type="hidden" id="edit-menu-item-icon-<?php echo $item_id; ?>" name="menu-item-icon[<?php echo $item_id; ?>]" value="<?php echo $item->icon; ?>" />
						</div>
					</div>
				</div><!-- // .hb-menu-item -->

				
				<div class="hb-menu-item hb-alignment wp-clearfix">
					<div class="hb-left-section">
						<div class="hb-menu-item-title"><?php esc_html_e('Sub Menu Alignment', 'hbthemes'); ?></div>
						<div class="hb-menu-item-desc"><?php esc_html_e('Align sub-menus to the right if they overflow the right border.', 'hbthemes'); ?></div>
					</div>

					<div class="hb-right-section">
						<div>
							<select id="menu-item-alignment-<?php echo $item_id; ?>" name="menu-item-alignment[<?php echo $item_id; ?>]">
								<option value="left" <?php selected( $item->alignment, 'left', true ); ?>><?php esc_html_e( 'Left', 'hbthemes' ); ?></option>
								<option value="right" <?php selected( $item->alignment, 'right', true ); ?>><?php esc_html_e( 'Right', 'hbthemes' ); ?></option>
							</select>
						</div>
					</div>
				</div><!-- // .hb-menu-item -->
				

				<div class="hb-menu-item hb-mega-menu wp-clearfix">
					<div class="hb-left-section">
						<div class="hb-menu-item-title"><?php esc_html_e('Mega Menu', 'hbthemes'); ?></div>
						<div class="hb-menu-item-desc"><?php esc_html_e('Check this box if you want to turn this item into Mega Menu.', 'hbthemes'); ?></div>
					</div>

					<div class="hb-right-section">
						<div>
							<?php $checked = $item->megamenu ? "checked='checked'" : ''; ?>
							<input type="checkbox" value="enabled" class="edit-menu-item-hb-megamenu-check" id="menu-item-megamenu-<?php echo $item_id; ?>" name="menu-item-megamenu[<?php echo $item_id; ?>]" <?php echo $checked; ?> />
						</div>
					</div>
				</div><!-- // .hb-menu-item -->

				<div class="hb-menu-item hb-caption wp-clearfix">
					<div class="hb-left-section">
						<div class="hb-menu-item-title"><?php esc_html_e('Show Captions', 'hbthemes'); ?></div>
						<div class="hb-menu-item-desc"><?php esc_html_e('Check this box if you want to show Mega Menu column captions.', 'hbthemes'); ?></div>
					</div>

					<div class="hb-right-section">
						<div>
							<?php $checked = $item->megamenu_captions ? "checked='checked'" : ''; ?>
							<input type="checkbox" value="enabled" id="menu-item-megamenu-captions-<?php echo $item_id; ?>" name="menu-item-megamenu-captions[<?php echo $item_id; ?>]" <?php echo $checked; ?> />
						</div>
					</div>
				</div><!-- // .hb-menu-item -->

				<div class="hb-menu-item hb-columns wp-clearfix">
					<div class="hb-left-section">
						<div class="hb-menu-item-title"><?php esc_html_e('Columns', 'hbthemes'); ?></div>
						<div class="hb-menu-item-desc"><?php esc_html_e('Choose number of rows to display in Megamenu.', 'hbthemes'); ?></div>
					</div>

					<div class="hb-right-section">
						<div>
							<select id="menu-item-megamenu-columns-<?php echo $item_id; ?>" name="menu-item-megamenu-columns[<?php echo $item_id; ?>]">

								<?php for ( $i = 2; $i <= 6; $i ++ ) { ?>
									<option value="columns-<?php echo $i; ?>" <?php selected( $item->megamenu_columns, 'columns-' . $i, true ); ?>><?php echo $i; ?></option>
								<?php } ?>
							</select>
							
						</div>
					</div>
				</div><!-- // .hb-menu-item -->

				<div class="hb-menu-item hb-background wp-clearfix">
					<div class="hb-left-section">
						<div class="hb-menu-item-title"><?php esc_html_e('Background Image', 'hbthemes'); ?></div>
						<div class="hb-menu-item-desc"><?php esc_html_e('Choose a background image for the Mega Menu. Leave empty if you are not going to use a background image.', 'hbthemes'); ?></div>
					</div>

					<div class="hb-right-section hb-menu-upload-image">
						<div>
							<div class="hb-upload-wrapper">
								<input class="hb-upload-url widefat" readonly="readonly" type="hidden" id="menu_item_megamenu_background_<?php echo $item_id; ?>" name="menu-item-megamenu-background[<?php echo $item_id; ?>]" value="<?php echo $item->megamenu_background; ?>">

								<a class="button button-primary hb-upload-button" id="menu_item_megamenu_background_button_<?php echo $item_id; ?>" href="#" data-title="<?php esc_html_e( 'Choose or upload a file', 'hbthemes' ); ?>" data-button="<?php esc_html_e( 'Use this image', 'hbthemes' ); ?>"><?php esc_html_e('Choose File', 'hbthemes'); ?></a>

								<?php $class = $item->megamenu_background ? '' : ' hidden'; ?>

								<a href="#" class="hb-remove-image<?php echo $class; ?>" id="menu_item_megamenu_background_<?php echo $item_id; ?>_remove"><i class="dashicons dashicons-no-alt"></i></a>
							</div>

							<div id="menu_item_megamenu_background_<?php echo $item_id; ?>-preview" class="show-upload-image">
								
								<img src="<?php echo $item->megamenu_background; ?>"/>

							</div>
						</div>
					</div>
				</div><!-- // .hb-menu-item -->

				<div class="hb-menu-item hb-image-position wp-clearfix">
					<div class="hb-left-section">
						<div class="hb-menu-item-title"><?php esc_html_e('Image Position', 'hbthemes'); ?></div>
						<div class="hb-menu-item-desc"><?php esc_html_e('Select image position.', 'hbthemes'); ?></div>
					</div>

					<div class="hb-right-section">
						<div>
							<select id="menu-item-megamenu-background-position-<?php echo $item_id; ?>" name="menu-item-megamenu-background-position[<?php echo $item_id; ?>]">
								<option value="stretched" <?php selected( $item->megamenu_background_position, 'stretched', true ); ?>><?php esc_html_e( 'Stretched Centered', 'hbthemes' ); ?></option>
								<option value="left top" <?php selected( $item->megamenu_background_position, 'left top', true ); ?>><?php esc_html_e( 'Left Top', 'hbthemes' ); ?></option>
								<option value="left center" <?php selected( $item->megamenu_background_position, 'left center', true ); ?>><?php esc_html_e( 'Left Center', 'hbthemes' ); ?></option>
								<option value="left bottom" <?php selected( $item->megamenu_background_position, 'left bottom', true ); ?>><?php esc_html_e( 'Left Bottom', 'hbthemes' ); ?></option>
								<option value="center top" <?php selected( $item->megamenu_background_position, 'center top', true ); ?>><?php esc_html_e( 'Center Top', 'hbthemes' ); ?></option>
								<option value="center center" <?php selected( $item->megamenu_background_position, 'center center', true ); ?>><?php esc_html_e( 'Center Center', 'hbthemes' ); ?></option>
								<option value="center bottom" <?php selected( $item->megamenu_background_position, 'center bottom', true ); ?>><?php esc_html_e( 'Center Bottom', 'hbthemes' ); ?></option>
								<option value="right top" <?php selected( $item->megamenu_background_position, 'right top', true ); ?>><?php esc_html_e( 'Right Top', 'hbthemes' ); ?></option>
								<option value="right center" <?php selected( $item->megamenu_background_position, 'right center', true ); ?>><?php esc_html_e( 'Right Center', 'hbthemes' ); ?></option>
								<option value="right bottom" <?php selected( $item->megamenu_background_position, 'right bottom', true ); ?>><?php esc_html_e( 'Right Bottom', 'hbthemes' ); ?></option>
							</select>
						</div>
					</div>
				</div><!-- // .hb-menu-item -->
			
			
				<div class="hb-menu-item hb-widgets wp-clearfix">
					<div class="hb-left-section">
						<div class="hb-menu-item-title"><?php esc_html_e('Show Widget', 'hbthemes'); ?></div>
						<div class="hb-menu-item-desc"><?php esc_html_e('If you want to show widgets inside your Mega Menu, you can choose which widgetized section will be shown inside this menu item.', 'hbthemes'); ?></div>
					</div>

					<div class="hb-right-section">
						<div>
							<select id="menu-item-megamenu-widget-area-<?php echo $item_id; ?>" name="menu-item-megamenu-widget-area[<?php echo $item_id; ?>]" class="hb-menu-item-megamenu-widget">
								<option value="0"><?php _e( 'Select Widget Area', 'hbthemes' ); ?></option>
								<?php
								if( ! empty( $wp_registered_sidebars ) && is_array( $wp_registered_sidebars ) ) {
									foreach ( $wp_registered_sidebars as $sidebar ) { ?>
										<option value="<?php echo $sidebar['id']; ?>" <?php selected( $item->megamenu_widgetarea, $sidebar['id'] ); ?>><?php echo $sidebar['name']; ?></option>
								<?php } 
								} ?>
							</select>
						</div>
					</div>
				</div><!-- // .hb-menu-item -->

			</div>
			<?php
	}
}

new HB_Custom_Walker_Admin();
