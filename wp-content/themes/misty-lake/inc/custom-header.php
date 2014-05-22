<?php
/**
 * Sample implementation of the Custom Header feature
 * http://codex.wordpress.org/Custom_Headers
 *
 * @package Misty Lake
 * @since Misty Lake 1.0
 */

/**
 * Setup the WordPress core custom header feature.
 *
 * @uses mistylake_admin_header_style()
 * @uses mistylake_admin_header_image()
 *
 * @package Misty Lake
 */
function mistylake_custom_header_setup() {
	add_theme_support( 'custom-header', apply_filters( 'mistylake_custom_header_args', array(
		'default-image'          => '%s/images/header.jpg',
		'width'                  => 1015,
		'height'                 => 276,
		'flex-height'            => true,
		'header-text'            => false,
		'admin-head-callback'    => 'mistylake_admin_header_style',
		'admin-preview-callback' => 'mistylake_admin_header_image',
	) ) );

	// Default custom headers packaged with the theme. %s is a placeholder for the theme template directory URI.
	register_default_headers( array(
		'lake' => array(
			'url'           => '%s/images/header.jpg',
			'thumbnail_url' => '%s/images/header-thumbnail.jpg',
			'description'   => _x( 'Lake', 'Header image description', 'mistylake' )
		),
	) );
}
add_action( 'after_setup_theme', 'mistylake_custom_header_setup' );

if ( ! function_exists( 'mistylake_admin_header_style' ) ) :
/**
 * Styles the header image displayed on the Appearance > Header admin panel.
 *
 * @see mistylake_custom_header_setup().
 *
 * @since Misty Lake 1.0
 */
function mistylake_admin_header_style() {
?>
	<style type="text/css">
	.appearance_page_custom-header #headimg {
		background: #fff;
		border: none;
		padding: 10px;
	}
	#headimg img {
		margin-top: 1.5em;
	}
	</style>
<?php
}
endif; // mistylake_admin_header_style

if ( ! function_exists( 'mistylake_admin_header_image' ) ) :
/**
 * Custom header image markup displayed on the Appearance > Header admin panel.
 *
 * @see mistylake_custom_header_setup().
 *
 * @since Misty Lake 1.0
 */
function mistylake_admin_header_image() {
	$header_image = get_header_image();
?>
	<div id="headimg">
		<?php if ( ! empty( $header_image ) ) : ?>
		<img src="<?php echo esc_url( $header_image ); ?>" alt="" />
		<?php endif; ?>
	</div>
<?php
}
endif; // mistylake_admin_header_image
