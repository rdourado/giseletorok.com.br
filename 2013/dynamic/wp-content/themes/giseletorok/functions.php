<?php 

$t_url = get_stylesheet_directory_uri();

function t_url() {
	global $t_url;
	echo $t_url;
}

/* Setup */

remove_action( 'wp_head', 'wp_generator' );
remove_action( 'wp_head', 'wlwmanifest_link' );
remove_action( 'wp_head', 'rsd_link' );
remove_action( 'wp_head', 'feed_links', 2 );
remove_action( 'wp_head', 'feed_links_extra', 3 );

add_action( 'after_setup_theme', 'my_setup' );

function my_setup() {
	add_image_size( 'equipe', 244, 255, true );
	add_image_size( 'clipping', 230, 225, true );
	add_image_size( 'tratamento', 230, 152, true );
	add_image_size( 'galeria', 193, 212, true );

	register_nav_menu( 'primary', 'Menu' );
}


/* Admin */

add_action( 'login_enqueue_scripts', 'my_login_logo' );
add_filter( 'login_errors', 'no_errors_please' );
add_filter( 'login_headerurl', 'my_login_logo_url' );
add_filter( 'login_headertitle', 'my_login_logo_url_title' );

function my_login_logo() { ?>
<style type="text/css">
body.login { background: #00a1a1 }
body.login div#login h1 a {
	background-image: url(<?php echo get_bloginfo( 'template_directory' ) ?>/img/logo.png);
	background-size: auto;
	height: 160px;
	margin-left: auto;
	margin-right: auto;
	width: 210px;
}
.login #nav a,
.login #backtoblog a {
	color: #fff !important;
	text-shadow: none;
}
.login #nav a:hover,
.login #backtoblog a:hover { color: #ccc !important }
.wp-core-ui .button-primary {
	background: #00a1a1;
	border-color: #00a1a1;
}
.wp-core-ui .button-primary:hover {
	background: #929292;
	border-color: #929292;
}

</style>
<?php }

function no_errors_please() {
	return '<strong>ERRO:</strong> A senha ou usuário fornecidos estão incorretos. <a href="' . home_url( '/wp-login.php?action=lostpassword' ) . '">Esqueceu sua senha</a>?';
}
function my_login_logo_url() {
	return get_bloginfo( 'url' );
}
function my_login_logo_url_title() {
	return 'Ir para o início';
}



/* Actions */

add_action( 'wp_enqueue_scripts', 'my_scripts' );
add_action( 'wp_footer', 'minified_scripts', 30 );

function my_scripts() {
	wp_deregister_script( 'jquery' );
	wp_register_script( 'jquery', 'http://code.jquery.com/jquery-1.9.1.min.js"', array(), null, true );
	wp_register_script( 'jquery-migrate', 'http://code.jquery.com/jquery-migrate-1.1.1.min.js"', array( 'jquery' ), null, true );
	wp_enqueue_script( 'jquery' );
	wp_enqueue_script( 'jquery-migrate' );

	//wp_enqueue_script( 'fancybox', "{$t_url}/js/fancybox/jquery.fancybox.pack.js", array( 'jquery' ), null, true );
	//wp_enqueue_script( 'interface', "{$t_url}/js/interface.js", array( 'jquery' ), filemtime( TEMPLATEPATH . '/js/interface.js' ), true );
}

function minified_scripts() {
	?><script src="/min/g=giselejs"></script><?php
}

/* Filters */

add_filter( 'the_title', 'abbr_dra' );

function abbr_dra( $title ) {
	if ( !is_admin() )
		return str_replace( 'Dra. ', '<abbr title="Doutora">Dra.</abbr> ', $title );
	return $title;
}

/* Shortcodes */

remove_shortcode( 'gallery' );
add_shortcode( 'gallery', 'my_gallery_shortcode' );

function my_gallery_shortcode( $attr ) {
	$post = get_post();

	static $instance = 0;
	$instance++;

	if ( ! empty( $attr['ids'] ) ) {
		// 'ids' is explicitly ordered, unless you specify otherwise.
		if ( empty( $attr['orderby'] ) )
			$attr['orderby'] = 'post__in';
		$attr['include'] = $attr['ids'];
	}

	// Allow plugins/themes to override the default gallery template.
	$output = apply_filters('post_gallery', '', $attr);
	if ( $output != '' )
		return $output;

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
		'columns'    => 3,
		'size'       => 'thumbnail',
		'include'    => '',
		'exclude'    => ''
	), $attr));

	$itemtag = 'li';
	$size = 'galeria';

	$id = intval($id);
	if ( 'RAND' == $order )
		$orderby = 'none';

	if ( !empty($include) ) {
		$_attachments = get_posts( array('include' => $include, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );

		$attachments = array();
		foreach ( $_attachments as $key => $val ) {
			$attachments[$val->ID] = $_attachments[$key];
		}
	} elseif ( !empty($exclude) ) {
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
	$icontag = tag_escape($icontag);
	$valid_tags = wp_kses_allowed_html( 'post' );
	if ( ! isset( $valid_tags[ $itemtag ] ) )
		$itemtag = 'dl';
	if ( ! isset( $valid_tags[ $captiontag ] ) )
		$captiontag = 'dd';
	if ( ! isset( $valid_tags[ $icontag ] ) )
		$icontag = 'dt';

	$float = is_rtl() ? 'right' : 'left';

	$selector = "gallery-{$instance}";

	$gallery_style = $gallery_div = '';
	$size_class = sanitize_html_class( $size );
	$gallery_div = '<div id="slider-code"><a href="#" class="buttons prev"></a><div class="viewport"><ul class="overview">';
	$output = apply_filters( 'gallery_style', $gallery_style . "\n\t\t" . $gallery_div );

	$i = 0;
	foreach ( $attachments as $id => $attachment ) {
		$link = wp_get_attachment_link( $id, $size, false, false );
		$link = str_replace( '<img', '<span></span><img', $link );
		$link = str_replace( '<a', '<a class="fancybox"', $link );
		$output .= "<{$itemtag} class='gallery-item'>{$link}</{$itemtag}>";
	}

	$output .= '</ul></div><a href="#" class="buttons next"></a></div>' . "\n";

	return $output;
}