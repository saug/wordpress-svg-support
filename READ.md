This code will add SVG support for WordPress.
If you would only like to enable SVG support then adding the following code should be enough:

function svg_mime_types( $mimes ) {
    $mimes['svg'] = 'image/svg+xml';

    return $mimes;
}
add_filter( 'upload_mimes', 'svg_mime_types' );

But if you would like to display the SVG on the WordPress media uploader you would need to add the CSS and js along with the code.