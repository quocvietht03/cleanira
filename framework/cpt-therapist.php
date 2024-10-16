<?php
/*
 * Therapist CPT
 */

function cleanira_therapist_register() {

	$cpt_slug = get_theme_mod('cleanira_therapist_slug');

	if(isset($cpt_slug) && $cpt_slug != ''){
		$cpt_slug = $cpt_slug;
	} else {
		$cpt_slug = 'therapist';
	}

	$labels = array(
		'name'               => esc_html__( 'Therapists', 'cleanira' ),
		'singular_name'      => esc_html__( 'Therapist', 'cleanira' ),
		'add_new'            => esc_html__( 'Add New', 'cleanira' ),
		'add_new_item'       => esc_html__( 'Add New Therapist', 'cleanira' ),
		'all_items'          => esc_html__( 'All Therapist', 'cleanira' ),
		'edit_item'          => esc_html__( 'Edit Therapist', 'cleanira' ),
		'new_item'           => esc_html__( 'Add New Therapist', 'cleanira' ),
		'view_item'          => esc_html__( 'View Item', 'cleanira' ),
		'search_items'       => esc_html__( 'Search Therapist', 'cleanira' ),
		'not_found'          => esc_html__( 'No therapist(s) found', 'cleanira' ),
		'not_found_in_trash' => esc_html__( 'No therapist(s) found in trash', 'cleanira' )
	);

  $args = array(
		'labels'          => $labels,
		'public'          => true,
		'show_ui'         => true,
		'capability_type' => 'post',
		'hierarchical'    => false,
		'has_archive'     => true,
		'menu_icon'       => 'dashicons-admin-post',
		'rewrite'         => array('slug' => $cpt_slug), // Permalinks format
		'show_in_rest' 		=> true,
		'supports'        => array('title', 'editor', 'thumbnail', 'comments')
  );

  add_filter( 'enter_title_here',  'cleanira_therapist_change_default_title');

  register_post_type( 'therapist' , $args );
}
add_action('init', 'cleanira_therapist_register', 1);


function cleanira_therapist_taxonomy() {

	register_taxonomy(
		"therapist_categories",
		array("therapist"),
		array(
			"hierarchical"   => true,
			"label"          => "Categories",
			"singular_label" => "Category",
			"rewrite"        => true
		)
	);

	register_taxonomy(
        'therapist_tag',
        'therapist',
        array(
            'hierarchical'  => false,
            'label'         => __( 'Tags', 'cleanira' ),
            'singular_name' => __( 'Tag', 'cleanira' ),
            'rewrite'       => true,
            'query_var'     => true
        )
    );

}
add_action('init', 'cleanira_therapist_taxonomy', 1);


function cleanira_therapist_change_default_title( $title ) {
	$screen = get_current_screen();

	if ( 'therapist' == $screen->post_type )
		$title = esc_html__( "Enter the therapist's name here", 'cleanira' );

	return $title;
}


function cleanira_therapist_edit_columns( $therapist_columns ) {
	$therapist_columns = array(
		"cb"                     => "<input type=\"checkbox\" />",
		"title"                  => esc_html__('Title', 'cleanira'),
		"thumbnail"              => esc_html__('Thumbnail', 'cleanira'),
		"therapist_categories" 			 => esc_html__('Categories', 'cleanira'),
		"date"                   => esc_html__('Date', 'cleanira'),
	);
	return $therapist_columns;
}
add_filter( 'manage_edit-therapist_columns', 'cleanira_therapist_edit_columns' );

function cleanira_therapist_column_display( $therapist_columns, $post_id ) {

	switch ( $therapist_columns ) {

		// Display the thumbnail in the column view
		case "thumbnail":
			$width = (int) 64;
			$height = (int) 64;
			$thumbnail_id = get_post_meta( $post_id, '_thumbnail_id', true );

			// Display the featured image in the column view if possible
			if ( $thumbnail_id ) {
				$thumb = wp_get_attachment_image( $thumbnail_id, array($width, $height), true );
			}
			if ( isset( $thumb ) ) {
				echo wp_kses_post( $thumb );
			} else {
				echo esc_html__('None', 'cleanira');
			}
			break;

		// Display the therapist tags in the column view
		case "therapist_categories":

		if ( $category_list = get_the_term_list( $post_id, 'therapist_categories', '', ', ', '' ) ) {
			echo wp_kses_post( $category_list );
		} else {
			echo esc_html__('None', 'cleanira');
		}
		break;
	}
}
add_action( 'manage_therapist_posts_custom_column', 'cleanira_therapist_column_display', 10, 2 );
