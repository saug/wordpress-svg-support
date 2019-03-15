<?php 
/**
 *  Functions to support svg format
*/

/**
*
* Allow SVG files to be uploaded in WordPress Media library
* Also allows the image preview to be seen in WordPress Media Uploader.
*/
/**
 * Add svg MIME type support
 *
*/
function svg_mime_types( $mimes ) {
    $mimes['svg'] = 'image/svg+xml';

    return $mimes;
}

add_filter( 'upload_mimes', 'svg_mime_types' );


/**
 * 
 * Enqueue SVG javascript and stylesheet in admin
 *
 */
function svg_enqueue_scripts( $hook ) {
	$current_screen = get_current_screen();
	if( $current_screen->base != 'plugin-install' ):
	    wp_enqueue_style( 'svg-style', get_theme_file_uri( '/admin/css/svg.css' ) );
	    wp_enqueue_script('jquery');
	    wp_enqueue_script( 'svg-script', get_theme_file_uri( '/admin/js/svg.js' ), 'jquery' );
	    wp_localize_script( 'svg-script', 'script_vars',
	        array( 'AJAXurl' => admin_url( 'admin-ajax.php' ) ) );
	endif;
}

add_action( 'admin_enqueue_scripts', 'svg_enqueue_scripts' );


/**
 * Ajax get_attachment_url_media_library
 * 
 */
function get_attachment_url_media_library() {

    $url          = '';
    $attachmentID = isset( $_REQUEST['attachmentID'] ) ? $_REQUEST['attachmentID'] : '';
    if ( $attachmentID ) {
        $url = wp_get_attachment_url( $attachmentID );
    }
    echo $url;
    die();
}

add_action( 'wp_ajax_svg_get_attachment_url', 'get_attachment_url_media_library' );

?>