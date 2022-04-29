<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

// Posts Excerpt
function epa_postsQuery_excerpt( $limit ) {
	$excerpt = explode( ' ', get_the_excerpt(), $limit );
	if ( count( $excerpt ) >= $limit ) {
		array_pop( $excerpt );
		$excerpt = implode( " ", $excerpt ) . '...';
	} else {
		$excerpt = implode( " ", $excerpt );
	}
	$excerpt = preg_replace( '`[[^]]*]`', '', $excerpt );

	return $excerpt;
}

//Query Post Types
function epa_postsgrid_post_type_control() {
	//https://wordpress.stackexchange.com/questions/85165/get-all-custom-post-types-excepted-some

	$epa_cpts         = get_post_types( array( 'public' => true, 'show_in_nav_menus' => true ) );
	$epa_exclude_cpts = array( 'elementor_library', 'attachment', 'product' );

	foreach ( $epa_exclude_cpts as $exclude_cpt ) {
		unset( $epa_cpts[ $exclude_cpt ] );
	}

	$post_types = array_merge( $epa_cpts );

	return $post_types;
}

//Query Authors List
function epa_postsgrid_post_type_author() {
	$user_query = new \WP_User_Query( [
		'who'                 => 'authors',
		'has_published_posts' => true,
		'fields'              => [
			'ID',
			'display_name',
		],
	] );

	$authors = [];

	foreach ( $user_query->get_results() as $result ) {
		$authors[ $result->ID ] = $result->display_name;
	}

	return $authors;
}


//Query Categories List
function epa_postsgrid_post_type_categories() {
	//https://developer.wordpress.org/reference/functions/get_terms/
	$terms = get_terms( array(
		'taxonomy'   => 'category',
		'hide_empty' => true,
	) );

	if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) {
		foreach ( $terms as $term ) {
			$options[ $term->term_id ] = $term->name;
		}
	}

	return $options;
}


//Query Tags List
function epa_postsgrid_post_type_tags() {

	$terms = get_terms( array(
		'taxonomy'   => 'post_tag',
		'hide_empty' => true,
	) );

	if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) {
		foreach ( $terms as $term ) {
			$options[ $term->term_id ] = $term->name;
		}

		return $options;

	}


}

//Query Post Formats
function epa_postsgrid_post_type_format() {

	$terms = get_terms( array(
		'taxonomy'   => 'post_format',
		'hide_empty' => true,
	) );

	if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) {
		foreach ( $terms as $term ) {
			$options[ $term->term_id ] = $term->name;
		}
	}

	return $options;
}

// Getting Post List
function epa_postsgrid_post_list_selection() {
	$pagelist = get_posts( array(
		'post_type' => 'post',
		'showposts' => 999,
	) );
	$posts    = array();

	if ( ! empty( $pagelist ) && ! is_wp_error( $pagelist ) ) {
		foreach ( $pagelist as $post ) {
			$options[ $post->ID ] = $post->post_title;
		}

		return $options;
	}
}
// Post Meta
function epa_post_meta_info() {
	global $metaData;

	?>
    <ul class="epa-post-info">

		<?php if ( in_array( 'author', $metaData ) ) : ?>
            <li><i class="fa fa-user"></i><a href="#"><?php the_author(); ?></a></li>
		<?php endif; ?>

		<?php if ( in_array( 'categories', $metaData ) ) : ?>
            <li><i class="fa fa-tag"></i><?php the_category( ', ' ) ?></li>
		<?php endif; ?>

		<?php if ( in_array( 'date', $metaData ) ) : ?>
            <li><i class="fa fa-calendar"></i><a href="#"><?php the_time( get_option( 'date_format' ) ); ?></a></li>
		<?php endif; ?>

		<?php if ( in_array( 'comments', $metaData ) ) : ?>
            <li><i class="fa fa-comment"></i><a href="<?php comment_link(); ?>"><?php comments_number(); ?></a></li>
		<?php endif; ?>
    </ul>

	<?php
}

/**
 * Get Contact Form 7 [ if exists ]
 */
if ( function_exists( 'wpcf7' ) ) {
	function epa_contact_form7(){
		$wpcf7_form_list = get_posts(array(
			'post_type' => 'wpcf7_contact_form',
			'showposts' => 999,
		));
		$options = array();
		$options[0] = esc_html__( 'Select a Contact Form', 'epa_elementor' );
		if ( ! empty( $wpcf7_form_list ) && ! is_wp_error( $wpcf7_form_list ) ){
			foreach ( $wpcf7_form_list as $post ) {
				$options[ $post->ID ] = $post->post_title;
			}
		} else {
			$options[0] = esc_html__( 'Create a Form First', 'epa_elementor' );
		}
		return $options;
	}
}


// Get elementor page templates
if ( !function_exists('epa_get_templates') ) {
	function epa_get_templates(){
		$page_templates = get_posts( array(
			'post_type'         => 'elementor_library',
			'posts_per_page'    => -1
		));

		$options = array();

		if ( ! empty( $page_templates ) && ! is_wp_error( $page_templates ) ){
			foreach ( $page_templates as $post ) {
				$options[ $post->ID ] = $post->post_title;
			}
		}
		return $options;
	}
}


/*Scroll Notification Animation Type
 * */
function scrnotify_animation(){
	$epaScrollNotify = array(
		esc_html__("random", "mewvc") => 'random',
		esc_html__("fadeIn", "mewvc") => "fadeIn",
		esc_html__("wobble", "mewvc") => "wobble",
		esc_html__("tada", "mewvc") => "tada",
		esc_html__("shake", "mewvc") => "shake",
		esc_html__("swing", "mewvc") => "swing",
		esc_html__("pulse", "mewvc") => "pulse",
		esc_html__("fadeInLeft", "mewvc") => "fadeInLeft",
		esc_html__("fadeInRight", "mewvc") => "fadeInRight",
		esc_html__("fadeInUp", "mewvc") => "fadeInUp",
		esc_html__("fadeInDown", "mewvc") => "fadeInDown",
		esc_html__("fadeInLeftBig", "mewvc") => "fadeInLeftBig",
		esc_html__("fadeInRightBig", "mewvc") => "fadeInRightBig",
		esc_html__("fadeInUpBig", "mewvc") => "fadeInUpBig",
		esc_html__("fadeInDownBig", "mewvc") => "fadeInDownBig",
		esc_html__("bounceInLeft", "mewvc") => "bounceInLeft",
		esc_html__("bounceInRight", "mewvc") => "bounceInRight",
		esc_html__("bounce", "mewvc") => "bounce",
		esc_html__("bounceInUp", "mewvc") => "bounceInUp",
		esc_html__("bounceInDown", "mewvc") => "bounceInDown",
		esc_html__("rollIn", "mewvc") => "rollIn",
		esc_html__("rotateIn", "mewvc") => "rotateIn",
		esc_html__("rotateInDownLeft", "mewvc") => "rotateInDownLeft",
		esc_html__("rotateInDownRight", "mewvc") => "rotateInDownRight",
		esc_html__("rotateInUpLeft", "mewvc") => "rotateInUpLeft",
		esc_html__("rotateInUpRight", "mewvc") => "rotateInUpRight",
		esc_html__("flipInX", "mewvc") => "flipInX",
		esc_html__("flipInY", "mewvc") => "flipInY",
		esc_html__("lightSpeedIn", "mewvc") => "lightSpeedIn");

	return array_flip($epaScrollNotify);
}

